$(document).ready(function () {
    console.log("Edit Job Card Script Loaded");

    // ==========================================
    // 1. GLOBAL HELPER
    // ==========================================
    window.showStepContent = function (stepIndex) {
        $('.bs-stepper-content .content').removeClass('active dstepper-block').hide();
        var targetContent = $('.bs-stepper-content .content').eq(stepIndex - 1);
        if (targetContent.length) {
            targetContent.addClass('active dstepper-block').show().css('display', 'block');
        }
    };

    // ==========================================
    // 2. INITIALIZE STEPPER
    // ==========================================
    var stepperElement = document.querySelector('.bs-stepper');
    if (stepperElement) {
        window.stepper = new Stepper(stepperElement, { linear: false, animation: false });
        setTimeout(function () {
            if (window.stepper) window.stepper.to(1);
            window.showStepContent(1);
            var firstStep = document.querySelector('.step[data-target="#search-vehicle-part"]');
            if (firstStep) firstStep.classList.add('active');
        }, 200);
    }

    // ==========================================
    // 3. GLOBALS
    // ==========================================
    var urlParams   = new URLSearchParams(window.location.search);
    var jobCardCode = urlParams.get('code');

    var vehicle            = null;
    var serviceStationInfo = null;
    var current_mileage    = 0;
    var new_mileage        = 0;
    var paid_status        = '';
    var job_card_type      = '';
    var status             = '';
    var notify             = '';
    var jobCardId          = 0;
    var invoiceCode        = '';
    var vehicleClassId     = null;
    var vat                = 0;

    var rowVehicleReportData = [];

    // Washer
    var items        = [];
    var WasherValues = [];

    // Service Packages
    var tableBodyServicePackage       = $('#table-jobcard-service-packages');
    var service_packages_items        = [];
    var selected_service_packages     = [];
    var service_packages_items_fuel   = [];
    var service_packages_items_filter = [];
    var counterId    = 0;
    var selected_fuel   = [];
    var selected_filter = [];

    // Repairs
    var tableBodyRepair  = $('#table-jobcard-repair');
    var repair_items     = [];
    var selected_repairs = [];

    // Products
    var tableBodyProducts = $('#table-jobcard-products');
    var products_items    = [];
    var selected_products = [];

    if (!jobCardCode) {
        Swal.fire({ icon: 'warning', title: 'No Job Card Code', text: 'Please provide a job card code in the URL' })
            .then(function () { window.location.href = '../job-cards/'; });
        return;
    }

    // ==========================================
    // 4. LOAD JOB CARD DATA
    // ==========================================
    function loadJobCardData(code) {
        $.ajax({
            type: 'POST',
            url: '../api/get-jobcard-data.php',
            data: { code: code },
            dataType: 'json',
            beforeSend: function () {
                $('#search-vehicle-content').html(
                    '<div class="d-flex justify-content-center my-4"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>'
                );
            },
            success: function (data) {
                if (data.success) {
                    setTimeout(function () { populateExistingData(data); }, 100);
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Job card not found' })
                        .then(function () { window.location.href = '../job-cards/'; });
                }
            },
            error: function () {
                Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to load job card data' });
            }
        });
    }

    loadJobCardData(jobCardCode);

    function populateExistingData(data) {
        var jc = data.job_card;

        jobCardId       = jc.id;
        invoiceCode     = jc.invoice_code || generateUUID();
        vehicleClassId  = jc.vehicle_class_id;
        job_card_type   = String(jc.job_card_type_id);
        paid_status     = jc.paid_status_id;
        status          = jc.status_id;
        notify          = jc.notify_month || 2;
        current_mileage = jc.job_mileage  || 0;
        new_mileage     = jc.next_mileage || 0;
        vat             = parseFloat(jc.vat) || 0;

        vehicle = [{
            vehicle_id         : jc.vehicle_id,
            vehicle_number     : jc.vehicle_number,
            chassis_number     : jc.chassis_number,
            engine_number      : jc.engine_number,
            vehicle_class_id   : jc.vehicle_class_id,
            vehicle_color      : jc.vehicle_color,
            vehicle_model_id   : jc.vehicle_model_id,
            vehicle_owner_id   : jc.vehicle_owner_id,
            first_name         : jc.first_name,
            last_name          : jc.last_name,
            phone              : jc.phone,
            address            : jc.address,
            vehicle_model_name : jc.vehicle_model_name,
            vehicle_make_name  : jc.vehicle_make_name,
            current_mileage    : jc.current_mileage
        }];

        serviceStationInfo = data.station;

        populateVehicleInfo(data);
        populateVehicleReports(data.reports);
        populateWasherStep(data.washers);
        loadServicePackageDropdown(data.fuels, data.filters);
        loadRepairDropdown(data.repairs);
        loadProductDropdown(data.products);

        setTimeout(function () {
            getInvoiceDetails(vehicle, serviceStationInfo);
        }, 500);
    }

    // ==========================================
    // 5. STEP 1 — VEHICLE INFO
    // ==========================================
    function populateVehicleInfo(data) {
        var jc = data.job_card;
        var vehicleImages = {
            1: '../assets/img/vehicle-img/light_motor_cycle.jpg',
            2: '../assets/img/vehicle-img/motor_cycles.jpg',
            3: '../assets/img/vehicle-img/three_wheeler.jpg',
            4: '../assets/img/vehicle-img/van.jpg',
            5: '../assets/img/vehicle-img/car.jpg',
            6: '../assets/img/vehicle-img/Light_Motor_Lorry.jpg',
            7: '../assets/img/vehicle-img/motor_lorry.jpg',
            8: '../assets/img/vehicle-img/Heavy_Motor_Lorry.jpg',
            9: '../assets/img/vehicle-img/light_bus.jpg',
            10: '../assets/img/vehicle-img/Hand_Tractors.jpg',
            11: '../assets/img/vehicle-img/Land_Vehicle.jpg',
            12: '../assets/img/vehicle-img/Special_purpose_Vehicle.jpg'
        };
        var vehicleImage = vehicleImages[jc.vehicle_class_id] || '../assets/img/vehicle-img/car.jpg';

        var html =
            '<div class="row my-4"><div class="col-md-5 mx-auto">' +
            '<div class="card p-3 py-4 border border-dark text-center"><div class="mx-auto my-2">' +
            '<img src="' + vehicleImage + '" style="width:80px;height:80px;border-radius:50%;object-fit:cover;" alt="Vehicle"/>' +
            '<div class="d-flex align-items-center justify-content-center mt-2">' +
            '<span class="m-0 p-0 d-flex align-items-center text-secondary mr-2"><span class="mr-1">Color:</span>' +
            '<div class="border" style="width:15px;height:15px;background-color:' + jc.vehicle_color + ';border-radius:50%;"></div></span>' +
            '<span class="h4 m-0 p-0"><b>' + jc.vehicle_number + '</b></span></div>' +
            '<p class="m-0 p-0 text-secondary mt-2">' + jc.first_name + ' ' + jc.last_name + '</p>' +
            '<p class="m-0 p-0 text-secondary">+94 ' + removeLeadingZeros(jc.phone) + '</p>' +
            '<p class="m-0 p-0 text-secondary">Prev Mileage: ' + (jc.current_mileage || 0) + ' KM</p>' +
            '</div></div></div></div>' +

            '<div class="row">' +
            '<div class="col-md-4 mx-auto"><div class="form-group">' +
            '<label>Current Mileage (KM) <span class="text-danger">*</span></label>' +
            '<input type="number" class="form-control" id="current-mileage" value="' + current_mileage + '"></div></div>' +
            '<div class="col-md-4 mx-auto"><div class="form-group">' +
            '<label>Next Mileage (KM) <span class="text-danger">*</span></label>' +
            '<input type="number" class="form-control" id="new-mileage" value="' + new_mileage + '"></div></div></div>' +

            '<div class="row">' +
            '<div class="col-sm-4"><div class="form-group"><label>Paid Status <span class="text-danger">*</span></label>' +
            '<select id="cmbpaidstatus" class="custom-select"><option value="" disabled>Please Select</option>' +
            data.cmbpaidstatus.map(function (s) { return '<option value="' + s.id + '"' + (s.id == paid_status ? ' selected' : '') + '>' + s.status + '</option>'; }).join('') +
            '</select></div></div>' +
            '<div class="col-sm-4"><div class="form-group"><label>Job Card Type <span class="text-danger">*</span></label>' +
            '<select id="cmbjobcardtype" class="custom-select" disabled><option value="" disabled>Please Select</option>' +
            data.cmbjobtypes.map(function (s) { return '<option value="' + s.id + '"' + (s.id == job_card_type ? ' selected' : '') + '>' + s.type + '</option>'; }).join('') +
            '</select></div></div>' +
            '<div class="col-sm-4"><div class="form-group"><label>Status <span class="text-danger">*</span></label>' +
            '<select id="cmbstatus" class="custom-select"><option value="" disabled>Please Select</option>' +
            data.cmbstatus.map(function (s) { return '<option value="' + s.id + '"' + (s.id == status ? ' selected' : '') + '>' + s.status + '</option>'; }).join('') +
            '</select></div></div></div>' +

            '<div class="row"><div class="col-md-6 mx-auto"><label>Notify Me <span class="text-danger">*</span></label></div></div>' +
            '<div class="row"><div class="col-md-6 mx-auto"><div class="row">' +
            '<div class="col-md-4 mx-auto"><div class="custom-control custom-radio">' +
            '<input value="2" class="custom-control-input" type="radio" id="customRadio2" name="customRadio"' + (notify == 2 ? ' checked' : '') + '>' +
            '<label for="customRadio2" class="custom-control-label">In 2 Months</label></div></div>' +
            '<div class="col-md-4 mx-auto"><div class="custom-control custom-radio">' +
            '<input value="4" class="custom-control-input" type="radio" id="customRadio4" name="customRadio"' + (notify == 4 ? ' checked' : '') + '>' +
            '<label for="customRadio4" class="custom-control-label">In 4 Months</label></div></div>' +
            '<div class="col-md-4 mx-auto"><div class="custom-control custom-radio">' +
            '<input value="6" class="custom-control-input" type="radio" id="customRadio6" name="customRadio"' + (notify == 6 ? ' checked' : '') + '>' +
            '<label for="customRadio6" class="custom-control-label">In 6 Months</label></div></div>' +
            '</div></div></div>';

        $('#search-vehicle-content').html(html).show().css('display', 'block');
    }

    // ==========================================
    // 6. STEP 2 — VEHICLE REPORT
    // ==========================================
    function populateVehicleReports(reports) {
        if (!reports || reports.length === 0) {
            if (job_card_type == '6' || job_card_type == '3' || job_card_type == '5') {
                $.ajax({
                    type: 'POST', url: '../api/getvehiclereport.php', dataType: 'json',
                    success: function (data) { renderVehicleReportTables(data, []); },
                    error: function () { $('#vehicle-report-container').html('<p class="text-center text-danger">Failed to load vehicle report</p>'); }
                });
            } else {
                $('#vehicle-report-container').html('<p class="text-center text-muted">Vehicle reports not applicable for this job card type.</p>');
            }
            return;
        }
        $.ajax({
            type: 'POST', url: '../api/getvehiclereport.php', dataType: 'json',
            success: function (data) { renderVehicleReportTables(data, reports); }
        });
    }

    function renderVehicleReportTables(data, existingReports) {
        var html = data.vehicle_category.map(function (category) {
            var rows = data.vehicle_subcategory
                .filter(function (sub) { return sub.vehicle_condition_category_id === category.id; })
                .map(function (sub) {
                    var existing = existingReports.find(function (r) { return r.sub_category_id == sub.id; });
                    var sel = existing ? existing.value_id : null;
                    var labels = ['Worse', 'Bad', 'Ok', 'Good', 'Perfect'];
                    var radios = [1,2,3,4,5].map(function (v) {
                        return '<td><div class="form-check">' +
                               '<input value="' + v + '" class="form-check-input" type="radio" name="radio' + sub.id + '"' + (sel == v ? ' checked' : '') + '>' +
                               '<label class="form-check-label">' + labels[v-1] + '</label></div></td>';
                    }).join('');
                    return '<tr data-category-id="' + category.id + '" data-subcategory-id="' + sub.id + '">' +
                           '<td>' + sub.sub_category + '</td>' + radios + '</tr>';
                }).join('');
            return '<div class="col-md-10 table-responsive p-0 mx-auto my-2">' +
                   '<table class="table table-striped table-bordered table-hover"><thead><tr>' +
                   '<th>' + category.category + '</th><th></th><th></th><th></th><th></th><th></th>' +
                   '</tr></thead><tbody>' + rows + '</tbody></table></div>';
        }).join('');

        $('#vehicle-report-container').html(html);
        collectVehicleReportData();
        $('#vehicle-report-container input[type="radio"]').on('change', collectVehicleReportData);
    }

    function collectVehicleReportData() {
        rowVehicleReportData = [];
        $('#vehicle-report-container tr[data-category-id]').each(function () {
            var sel = $(this).find('input[type="radio"]:checked');
            if (sel.length > 0) {
                rowVehicleReportData.push({
                    categoryId    : $(this).data('category-id'),
                    subcategoryId : $(this).data('subcategory-id'),
                    value         : parseInt(sel.val())
                });
            }
        });
    }

    // ==========================================
    // 7. STEP 3 — WASHER
    // ==========================================
    function populateWasherStep(savedWashers) {
        items        = [];
        WasherValues = [];

        if (savedWashers && savedWashers.length > 0) {
            var w = savedWashers[0];
            renderWasherTable({ id: w.washer_id, code: w.code, price: w.price }, w.qty, w.price, w.discount);
        } else if (vehicleClassId) {
            $.ajax({
                type: 'POST', url: '../api/getwasherbyvehicleclassid.php',
                data: { vehicle_class_id: vehicleClassId }, dataType: 'json',
                success: function (data) {
                    if (data && data[0]) {
                        renderWasherTable(data[0], 1, data[0].price, 0);
                    } else {
                        $('#washer-part-container').html('<p class="text-danger">No washer package found for this vehicle class.</p>');
                    }
                }
            });
        } else {
            $('#washer-part-container').html('<p class="text-muted">No washer data available.</p>');
        }
    }

    function renderWasherTable(data, displayQty, displayPrice, displayDiscount) {
        displayQty      = parseFloat(displayQty)      || 1;
        displayPrice    = parseFloat(displayPrice)    || parseFloat(data.price) || 0;
        displayDiscount = parseFloat(displayDiscount) || 0;

        $('#washer-part-container').html(
            '<div class="col-md-12">' +
            '<table class="table table-striped">' +
            '<thead><tr><th>Washer Package Name</th><th>QTY</th><th>Unit Price (LKR)</th><th>Discount (LKR)</th><th>Total (LKR)</th></tr></thead>' +
            '<tbody>' +
            '<tr class="rowBody">' +
            '<td style="display:none;" class="rowID">'   + data.id   + '</td>' +
            '<td style="display:none;" class="rowCode">' + data.code + '</td>' +
            '<td>Wash (' + data.code + ')</td>' +
            '<td><input value="' + displayQty      + '" type="number" class="form-control wash-qty"></td>' +
            '<td><input value="' + displayPrice    + '" type="number" class="form-control wash-unit-price"></td>' +
            '<td><input value="' + displayDiscount + '" type="number" class="form-control wash-discount"></td>' +
            '<td><p class="h6 font-weight-bold wash-total">0.00</p></td>' +
            '</tr>' +
            '</tbody></table>' +
            '<h4><b>Total - LKR <span id="wash-final-total">0.00</span>/=</b></h4>' +
            '</div>'
        );

        var row  = $('.rowBody');
        var item = {
            rowCode       : row.find('.rowCode')[0],
            rowID         : row.find('.rowID')[0],
            quantityInput : row.find('.wash-qty')[0],
            priceInput    : row.find('.wash-unit-price')[0],
            discountInput : row.find('.wash-discount')[0],
            totalCell     : row.find('.wash-total')[0]
        };
        items = [item];

        [item.quantityInput, item.priceInput, item.discountInput].forEach(function (inp) {
            inp.addEventListener('input', calculateWasherTotal);
        });
        calculateWasherTotal();
    }

    function calculateWasherTotal() {
        var grandTotal = 0;
        WasherValues   = [];
        items.forEach(function (item) {
            var quantity = parseFloat(item.quantityInput.value) || 0;
            var price    = parseFloat(item.priceInput.value)    || 0;
            var discount = parseFloat(item.discountInput.value) || 0;
            var total    = (quantity * price) - discount;
            item.totalCell.textContent = total.toFixed(2);
            grandTotal += total;
            WasherValues.push({ washerID: item.rowID.innerText, price: price, quantity: quantity, discount: discount });
        });
        $('#wash-final-total').text(grandTotal.toFixed(2));
    }

    // ==========================================
    // 8. STEP 4 — SERVICE PACKAGES
    // ==========================================
    function loadServicePackageDropdown(savedFuels, savedFilters) {
        $.ajax({
            type: 'POST',
            url: '../api/cmb/servicepackages.php',
            dataType: 'json',
            success: function (packages) {
                var $cmb = $('#cmbservicepackages');
                $cmb.find('option:not(:first)').remove();
                if (packages && packages.length > 0) {
                    packages.forEach(function (pkg) {
                        var pkgName = pkg.package_name || pkg.name || 'Package #' + pkg.id;
                        $cmb.append('<option value="' + pkg.id + '">' + pkgName + '</option>');
                    });
                }
                if (savedFuels && savedFuels.length > 0) {
                    preLoadSavedServicePackages(savedFuels, savedFilters || []);
                }
            },
            error: function () {
                if (savedFuels && savedFuels.length > 0) {
                    preLoadSavedServicePackages(savedFuels, savedFilters || []);
                }
            }
        });
    }

    function preLoadSavedServicePackages(savedFuels, savedFilters) {
        var pkgIds = [];
        savedFuels.forEach(function (f) {
            if (pkgIds.indexOf(String(f.service_package_id)) === -1) pkgIds.push(String(f.service_package_id));
        });
        savedFilters.forEach(function (f) {
            if (pkgIds.indexOf(String(f.service_package_id)) === -1) pkgIds.push(String(f.service_package_id));
        });

        pkgIds.forEach(function (pkgId) {
            $.ajax({
                type: 'POST',
                url: '../api/checkservicepackage.php',
                data: { servicePackageId: pkgId },
                dataType: 'json',
                success: function (data) {
                    if (!data || !data.servicePackage || data.servicePackage.length === 0) return;
                    var pkgSavedFuels   = savedFuels.filter(function (f) { return String(f.service_package_id) === pkgId; });
                    var pkgSavedFilters = savedFilters.filter(function (f) { return String(f.service_package_id) === pkgId; });
                    var alreadyAdded = selected_service_packages.some(function (sp) { return String(sp.id) === pkgId; });
                    if (!alreadyAdded) {
                        counterId += 1;
                        populateTableServicePackage(data, counterId, pkgSavedFuels, pkgSavedFilters);
                        selected_service_packages.push(data.servicePackage[0]);
                    }
                }
            });
        });
    }

    $(document).on('change', '#cmbservicepackages', function () {
        var servicePackageId = $(this).val();
        $.ajax({
            type: 'POST',
            url: '../api/checkservicepackage.php',
            data: { servicePackageId: servicePackageId },
            dataType: 'json',
            success: function (data) {
                var found = selected_service_packages.some(function (sp) { return String(sp.id) === String(servicePackageId); });
                if (found) { Swal.fire({ icon: 'error', title: 'Error', text: 'Service Package Already Exist' }); return; }
                counterId += 1;
                populateTableServicePackage(data, counterId, [], []);
                selected_service_packages.push(data.servicePackage[0]);
            }
        });
    });

    function populateTableServicePackage(data, cid, preFuels, preFilters) {
        data.servicePackage.forEach(function (plist) {
            var row = $([
                '<tr data-widget="expandable-table" aria-expanded="false">',
                    '<td class="rowServicePackageID"   style="display:none;">' + plist.id           + '</td>',
                    '<td class="rowServicePackageCode" style="display:none;">' + plist.code         + '</td>',
                    '<td class="rowServicePackageName" style="display:none;">' + plist.package_name + '</td>',
                    '<td>' + cid + '</td>',
                    '<td>' + plist.package_name + '</td>',
                    '<td><button data-id="' + plist.id + '" type="button" class="btn bg-gradient-danger deleteServicePackageItem"><i class="fas fa-trash"></i></button></td>',
                '</tr>',
                '<tr class="expandable-body">',
                    '<td colspan="5"><p class="m-0 p-0"><div class="row">',
                    '<div class="col-md-6">',
                    '<table class="table table-sm table-striped"><thead><tr><th>#</th><th>Lubricant Type</th><th>Price</th><th>Select</th></tr></thead><tbody>',
                    data.fuelArry.map(function (fuel, fuelIndex) {
                        var savedFuel = preFuels.find(function (pf) { return String(pf.fuel_type_id) === String(fuel.id); });
                        var fuelPrice = savedFuel ? savedFuel.price : fuel.price;
                        var isChecked = !!savedFuel;
                        return '<tr>' +
                            '<td class="rowFuelID"             style="display:none;">' + fuel.id           + '</td>' +
                            '<td class="rowServicePackageID"   style="display:none;">' + plist.id          + '</td>' +
                            '<td class="rowServicePackageCode" style="display:none;">' + plist.code        + '</td>' +
                            '<td class="rowServicePackageName" style="display:none;">' + plist.package_name + '</td>' +
                            '<td>' + (fuelIndex + 1) + '</td>' +
                            '<td>' + fuel.name + '</td>' +
                            '<td><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">LKR</span></div>' +
                            '<input value="' + fuelPrice + '" type="text" class="form-control FuelPrice">' +
                            '<div class="input-group-append"><span class="input-group-text">.00</span></div></div></td>' +
                            '<td><div class="custom-control custom-radio">' +
                            '<input class="custom-control-input fuel-radio" type="radio"' +
                            ' id="fuelRadio' + cid + '_' + (fuelIndex + 1) + '"' +
                            ' name="fuelRadio' + cid + '"' +
                            (isChecked ? ' checked' : '') + '>' +
                            '<label for="fuelRadio' + cid + '_' + (fuelIndex + 1) + '" class="custom-control-label"></label>' +
                            '</div></td></tr>';
                    }).join(''),
                    '</tbody></table></div>',
                    '<div class="col-md-6">',
                    '<table class="table table-sm table-striped"><thead><tr><th>#</th><th>Filter Type</th><th>Price</th><th>Select</th></tr></thead><tbody>',
                    data.filterArry.map(function (filter, filterIndex) {
                        var savedFilter = preFilters.find(function (pf) { return String(pf.filter_type_id) === String(filter.id); });
                        var filterPrice = savedFilter ? savedFilter.price : filter.price;
                        var isChecked   = !!savedFilter;
                        return '<tr>' +
                            '<td class="rowFilterID"           style="display:none;">' + filter.id         + '</td>' +
                            '<td class="rowServicePackageID"   style="display:none;">' + plist.id          + '</td>' +
                            '<td class="rowServicePackageCode" style="display:none;">' + plist.code        + '</td>' +
                            '<td class="rowServicePackageName" style="display:none;">' + plist.package_name + '</td>' +
                            '<td>' + (filterIndex + 1) + '</td>' +
                            '<td>' + filter.name + '</td>' +
                            '<td><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">LKR</span></div>' +
                            '<input value="' + filterPrice + '" type="text" class="form-control FilterPrice">' +
                            '<div class="input-group-append"><span class="input-group-text">.00</span></div></div></td>' +
                            '<td><div class="custom-control custom-radio">' +
                            '<input class="custom-control-input filter-radio" type="radio"' +
                            ' id="filterRadio' + cid + '_' + (filterIndex + 1) + '"' +
                            ' name="filterRadio' + cid + '"' +
                            (isChecked ? ' checked' : '') + '>' +
                            '<label for="filterRadio' + cid + '_' + (filterIndex + 1) + '" class="custom-control-label"></label>' +
                            '</div></td></tr>';
                    }).join(''),
                    '</tbody></table></div>',
                    '</div></p></td>',
                '</tr>'
            ].join(''));

            tableBodyServicePackage.append(row);

            service_packages_items.push({
                rowServicePackageID   : row.find('.rowServicePackageID')[0],
                rowServicePackageCode : row.find('.rowServicePackageCode')[0],
                rowServicePackageName : row.find('.rowServicePackageName')[0]
            });
            service_packages_items_fuel.push({
                rowServicePackageID   : row.find('.rowServicePackageID')[0],
                rowServicePackageCode : row.find('.rowServicePackageCode')[0],
                rowServicePackageName : row.find('.rowServicePackageName')[0],
                rowFuelID             : row.find('.rowFuelID')[0],
                FuelPrice             : row.find('.FuelPrice')[0]
            });
            service_packages_items_filter.push({
                rowServicePackageID   : row.find('.rowServicePackageID')[0],
                rowServicePackageCode : row.find('.rowServicePackageCode')[0],
                rowServicePackageName : row.find('.rowServicePackageName')[0],
                rowFilterID           : row.find('.rowFilterID')[0],
                FilterPrice           : row.find('.FilterPrice')[0]
            });

            row.find('.fuel-radio:checked').trigger('change');
            row.find('.filter-radio:checked').trigger('change');
        });
    }

    $(document).on('change', '.fuel-radio', function () {
        if ($(this).is(':checked')) {
            var ServicePackageId   = $(this).closest('tr').find('.rowServicePackageID').text();
            var selectedPrice      = $(this).closest('tr').find('.FuelPrice').val();
            var ServicePackageName = $(this).closest('tr').find('.rowServicePackageName').text();
            var ServicePackageCode = $(this).closest('tr').find('.rowServicePackageCode').text();
            var selectedId         = $(this).closest('tr').find('.rowFuelID').text();
            selected_fuel = selected_fuel.filter(function (item) { return item.ServicePackageId !== ServicePackageId; });
            selected_fuel.push({ ServicePackageId: ServicePackageId, ServicePackageName: ServicePackageName, ServicePackageCode: ServicePackageCode, price: selectedPrice, typeId: selectedId });
            calculateServicePackageTotal();
        }
    });

    $(document).on('change', '.filter-radio', function () {
        if ($(this).is(':checked')) {
            var ServicePackageId   = $(this).closest('tr').find('.rowServicePackageID').text();
            var selectedPrice      = $(this).closest('tr').find('.FilterPrice').val();
            var selectedId         = $(this).closest('tr').find('.rowFilterID').text();
            var ServicePackageCode = $(this).closest('tr').find('.rowServicePackageCode').text();
            var ServicePackageName = $(this).closest('tr').find('.rowServicePackageName').text();
            selected_filter = selected_filter.filter(function (item) { return item.ServicePackageId !== ServicePackageId; });
            selected_filter.push({ ServicePackageId: ServicePackageId, ServicePackageName: ServicePackageName, ServicePackageCode: ServicePackageCode, price: selectedPrice, typeId: selectedId });
            calculateServicePackageTotal();
        }
    });

    $(document).on('input', '.FuelPrice', function () {
        var ServicePackageId = $(this).closest('tr').find('.rowServicePackageID').text();
        var newPrice = $(this).val();
        var idx = selected_fuel.findIndex(function (item) { return item.ServicePackageId === ServicePackageId; });
        if (idx !== -1) selected_fuel[idx].price = newPrice;
        calculateServicePackageTotal();
    });

    $(document).on('input', '.FilterPrice', function () {
        var ServicePackageId = $(this).closest('tr').find('.rowServicePackageID').text();
        var newPrice = $(this).val();
        var idx = selected_filter.findIndex(function (item) { return item.ServicePackageId === ServicePackageId; });
        if (idx !== -1) selected_filter[idx].price = newPrice;
        calculateServicePackageTotal();
    });

    $('#tableServicePackage').on('click', '.deleteServicePackageItem', function () {
        var listItem = String($(this).data('id'));
        var idx = selected_service_packages.findIndex(function (i) { return String(i.id) === listItem; });
        if (idx !== -1) selected_service_packages.splice(idx, 1);
        selected_fuel   = selected_fuel.filter(function (i)   { return String(i.ServicePackageId) !== listItem; });
        selected_filter = selected_filter.filter(function (i) { return String(i.ServicePackageId) !== listItem; });
        $(this).closest('tr').next('.expandable-body').remove();
        $(this).closest('tr').remove();
        calculateServicePackageTotal();
    });

    function calculateServicePackageTotal() {
        var totalAmount = 0;
        $('#table-jobcard-service-packages .fuel-radio:checked').each(function () {
            totalAmount += parseFloat($(this).closest('tr').find('.FuelPrice').val()) || 0;
        });
        $('#table-jobcard-service-packages .filter-radio:checked').each(function () {
            totalAmount += parseFloat($(this).closest('tr').find('.FilterPrice').val()) || 0;
        });
        $('#service-package-total').text(totalAmount.toFixed(2));
    }

    // ==========================================
    // 9. STEP 5 — REPAIRS
    // ==========================================
    function loadRepairDropdown(savedRepairs) {
        $.ajax({
            type: 'POST',
            url: '../api/cmb/repairlist.php',
            data: { vehicleClassId: vehicleClassId },
            dataType: 'json',
            success: function (repairs) {
                var $cmb = $('#cmbrepair');
                $cmb.find('option:not(:first)').remove();
                if (repairs && repairs.length > 0) {
                    repairs.forEach(function (r) {
                        $cmb.append('<option value="' + r.id + '">' + (r.name || r.repair_name || 'Repair #' + r.id) + '</option>');
                    });
                }
                preLoadSavedRepairs(savedRepairs);
            },
            error: function () { preLoadSavedRepairs(savedRepairs); }
        });
    }

    function preLoadSavedRepairs(savedRepairs) {
        if (!savedRepairs || savedRepairs.length === 0) return;
        savedRepairs.forEach(function (repair) {
            var fakeData = [{ id: repair.repair_id, code: repair.code, name: repair.name, price: repair.unit_price }];
            var alreadyAdded = selected_repairs.some(function (r) { return String(r.id) === String(repair.repair_id); });
            if (!alreadyAdded) {
                populateTableRepairs(fakeData, repair.hours, repair.discount);
                selected_repairs.push(fakeData[0]);
            }
        });
        calculateRepairTotal();
    }

    $(document).on('change', '#cmbrepair', function () {
        var repairId = $(this).val();
        $.ajax({
            type: 'POST', url: '../api/checkrepair.php',
            data: { repairId: repairId, vehicleClassId: vehicleClassId }, dataType: 'json',
            success: function (data) {
                if (!data || data.length === 0) return;
                var found = selected_repairs.some(function (r) { return String(r.id) === String(repairId); });
                if (found) { Swal.fire({ icon: 'error', title: 'Error', text: 'Repair Already Exist' }); return; }
                populateTableRepairs(data, 1, 0);
                selected_repairs.push(data[0]);
            }
        });
    });

    function populateTableRepairs(data, defaultHours, defaultDiscount) {
        defaultHours    = (defaultHours    != null) ? defaultHours    : 1;
        defaultDiscount = (defaultDiscount != null) ? defaultDiscount : 0;
        data.forEach(function (plist) {
            var row = $('<tr>');
            row.append('<td class="rowID"   style="display:none;">' + plist.id              + '</td>');
            row.append('<td class="rowCode" style="display:none;">' + (plist.code || '')    + '</td>');
            row.append('<td class="rowName" style="display:none;">' + plist.name            + '</td>');
            row.append('<td>' + (repair_items.length + 1) + '.</td>');
            row.append('<td>' + plist.name + '</td>');
            row.append('<td><div class="input-group"><input value="' + defaultHours + '" type="text" class="form-control hours"><div class="input-group-append"><span class="input-group-text">.00</span></div></div></td>');
            row.append('<td><div class="input-group"><input value="' + (plist.price || 0) + '" type="text" class="form-control unit-price"><div class="input-group-append"><span class="input-group-text">.00</span></div></div></td>');
            row.append('<td><div class="input-group"><input value="' + defaultDiscount + '" type="text" class="form-control discount"><div class="input-group-append"><span class="input-group-text">.00</span></div></div></td>');
            row.append('<td><p class="h6 repair-total">0.00</p></td>');
            row.append('<td><button data-id="' + plist.id + '" type="button" class="btn bg-gradient-danger deleteRepairItem"><i class="fas fa-trash"></i></button></td>');
            tableBodyRepair.append(row);
            var item = {
                rowCode: row.find('.rowCode')[0], rowName: row.find('.rowName')[0], rowID: row.find('.rowID')[0],
                HoursInput: row.find('.hours')[0], UnitPriceInput: row.find('.unit-price')[0],
                discountInput: row.find('.discount')[0], totalCell: row.find('.repair-total')[0]
            };
            repair_items.push(item);
            item.HoursInput.addEventListener('input',     calculateRepairTotal);
            item.UnitPriceInput.addEventListener('input', calculateRepairTotal);
            item.discountInput.addEventListener('input',  calculateRepairTotal);
            calculateRepairTotal();
        });
    }

    function calculateRepairTotal() {
        var totalAmount = 0;
        repair_items.forEach(function (item) {
            var hours = parseFloat(item.HoursInput.value) || 0;
            var price = parseFloat(item.UnitPriceInput.value) || 0;
            var disc  = parseFloat(item.discountInput.value)  || 0;
            var total = (hours * price) - disc;
            item.totalCell.textContent = total.toFixed(2);
            totalAmount += total;
        });
        $('#repair-final-total').text(totalAmount.toFixed(2));
    }

    $('table.repairTable').on('click', '.deleteRepairItem', function () {
        var listItem = String($(this).data('id'));
        var idx = selected_repairs.findIndex(function (i) { return String(i.id) === listItem; });
        if (idx !== -1) selected_repairs.splice(idx, 1);
        var itemIdx = repair_items.findIndex(function (i) { return String(i.rowID.innerText) === listItem; });
        if (itemIdx !== -1) repair_items.splice(itemIdx, 1);
        $(this).closest('tr').remove();
        calculateRepairTotal();
    });

    // ==========================================
    // 10. STEP 6 — PRODUCTS
    // ==========================================
    function loadProductDropdown(savedProducts) {
        $.ajax({
            type: 'POST', url: '../api/cmb/productslist.php', dataType: 'json',
            success: function (products) {
                var $cmb = $('#cmbproducts');
                $cmb.find('option:not(:first)').remove();
                if (products && products.length > 0) {
                    products.forEach(function (p) {
                        $cmb.append('<option value="' + p.id + '">' + (p.product_name || p.name || 'Product #' + p.id) + '</option>');
                    });
                }
                preLoadSavedProducts(savedProducts);
            },
            error: function () { preLoadSavedProducts(savedProducts); }
        });
    }

    function preLoadSavedProducts(savedProducts) {
        if (!savedProducts || savedProducts.length === 0) return;
        savedProducts.forEach(function (product) {
            var fakeData = [{ id: product.product_id, code: product.code, product_name: product.product_name, quantity: product.qty, selling_price: product.price }];
            var alreadyAdded = selected_products.some(function (p) { return String(p.id) === String(product.product_id); });
            if (!alreadyAdded) {
                populateTableProducts(fakeData, product.qty, product.discount);
                selected_products.push(fakeData[0]);
            }
        });
        calculateProductTotal();
    }

    $(document).on('change', '#cmbproducts', function () {
        var productId = $(this).val();
        $.ajax({
            type: 'POST', url: '../api/checkproduct.php',
            data: { productId: productId }, dataType: 'json',
            success: function (data) {
                if (!data || data.length === 0) return;
                var found = selected_products.some(function (p) { return String(p.id) === String(productId); });
                if (found) { Swal.fire({ icon: 'error', title: 'Error', text: 'Product Already Exist' }); return; }
                populateTableProducts(data, data[0].quantity, 0);
                selected_products.push(data[0]);
            }
        });
    });

    function populateTableProducts(data, defaultQty, defaultDiscount) {
        defaultQty      = (defaultQty      != null) ? defaultQty      : 1;
        defaultDiscount = (defaultDiscount != null) ? defaultDiscount : 0;
        data.forEach(function (plist) {
            var row = $('<tr>');
            row.append('<td class="rowProductID"   style="display:none;">' + plist.id              + '</td>');
            row.append('<td class="rowProductCode" style="display:none;">' + (plist.code || '')    + '</td>');
            row.append('<td class="rowProductName" style="display:none;">' + plist.product_name    + '</td>');
            row.append('<td>' + (products_items.length + 1) + '.</td>');
            row.append('<td>' + plist.product_name + '</td>');
            row.append('<td><div class="input-group"><input value="' + defaultQty + '" type="text" class="form-control quantityQty"><div class="input-group-append"><span class="input-group-text">.00</span></div></div></td>');
            row.append('<td><div class="input-group"><input value="' + (plist.selling_price || 0) + '" type="text" class="form-control unitPriceProduct"><div class="input-group-append"><span class="input-group-text">.00</span></div></div></td>');
            row.append('<td><div class="input-group"><input value="' + defaultDiscount + '" type="text" class="form-control discountProduct"><div class="input-group-append"><span class="input-group-text">.00</span></div></div></td>');
            row.append('<td><p class="h6 totalProduct">0.00</p></td>');
            row.append('<td><button data-id="' + plist.id + '" type="button" class="btn bg-gradient-danger deleteProductsItem"><i class="fas fa-trash"></i></button></td>');
            tableBodyProducts.append(row);
            var item = {
                rowID: row.find('.rowProductID')[0], rowCode: row.find('.rowProductCode')[0], rowName: row.find('.rowProductName')[0],
                quantityInput: row.find('.quantityQty')[0], priceInput: row.find('.unitPriceProduct')[0],
                discountInput: row.find('.discountProduct')[0], totalCell: row.find('.totalProduct')[0]
            };
            products_items.push(item);
            item.quantityInput.addEventListener('input', calculateProductTotal);
            item.priceInput.addEventListener('input',    calculateProductTotal);
            item.discountInput.addEventListener('input', calculateProductTotal);
            calculateProductTotal();
        });
    }

    function calculateProductTotal() {
        var totalAmount = 0;
        products_items.forEach(function (item) {
            var qty   = parseFloat(item.quantityInput.value) || 0;
            var price = parseFloat(item.priceInput.value)    || 0;
            var disc  = parseFloat(item.discountInput.value) || 0;
            var total = (qty * price) - disc;
            item.totalCell.textContent = total.toFixed(2);
            totalAmount += total;
        });
        $('#total-final-product').text(totalAmount.toFixed(2));
    }

    $('table.productsTable').on('click', '.deleteProductsItem', function () {
        var listItem = String($(this).data('id'));
        var idx = selected_products.findIndex(function (i) { return String(i.id) === listItem; });
        if (idx !== -1) selected_products.splice(idx, 1);
        var itemIdx = products_items.findIndex(function (i) { return String(i.rowID.innerText) === listItem; });
        if (itemIdx !== -1) products_items.splice(itemIdx, 1);
        $(this).closest('tr').remove();
        calculateProductTotal();
    });

    // ==========================================
    // 11. STEP 7 — INVOICE  ← FIXED
    // ==========================================
    function getInvoiceDetails(vehicleData, stationData) {
        if (!vehicleData || !vehicleData.length || !stationData || !stationData.length) return;
        var jc      = vehicleData[0];
        var station = stationData[0];

        $('#invoice-code').text(invoiceCode);
        $('#invoice-date').text(new Date().toLocaleDateString());
        $('#in_vat_input').val(vat);
        $('#invoice-mileage').text(current_mileage + ' KM');

        $('#invoice-customer-info').html(
            '<p class="mb-1"><strong>Customer:</strong> ' + jc.first_name + ' ' + jc.last_name + '</p>' +
            '<p class="mb-1"><strong>Phone:</strong> +94 ' + removeLeadingZeros(jc.phone) + '</p>' +
            '<p class="mb-1"><strong>Address:</strong> ' + (jc.address || 'N/A') + '</p>'
        );
        $('#invoice-vehicle-info').html(
            '<p class="mb-1"><strong>Vehicle:</strong> ' + jc.vehicle_number + '</p>' +
            '<p class="mb-1"><strong>Make/Model:</strong> ' + jc.vehicle_make_name + ' ' + jc.vehicle_model_name + '</p>' +
            '<p class="mb-1"><strong>Chassis:</strong> ' + (jc.chassis_number || 'N/A') + '</p>' +
            '<p class="mb-1"><strong>Engine:</strong> ' + (jc.engine_number || 'N/A') + '</p>'
        );

        $('#station-logo').attr('src', station.logo ? '../uploads/stations/' + station.logo : '../dist/img/system/logo_pistona.png');
        $('#station-name').text(station.service_name || '');
        $('#station-address').text([station.address, station.street, station.city].filter(Boolean).join(' ') || 'N/A');
        $('#station-contact').text('Tel: ' + (station.phone || 'N/A') + ' | Fax: ' + (station.other_phone || 'N/A'));
        $('#station-email').text('Email: ' + (station.email || 'N/A'));

        generateInvoiceItems();
        calculateSubtotal();
        displayCalculation();
    }

    // ── FIXED: matches the 7-column table header in the HTML ──────────────
    // Columns: Code | Item Description | QTY/Labour Hr | Unit Price | Amount | Discount | Total
    function generateInvoiceItems() {
        var html = '';

        // Washers
        items.forEach(function (wash) {
            var qty       = parseFloat(wash.quantityInput.value) || 0;
            var unitPrice = parseFloat(wash.priceInput.value)    || 0;
            var discount  = parseFloat(wash.discountInput.value) || 0;
            var amount    = qty * unitPrice;
            var total     = amount - discount;
            html += '<tr>' +
                '<td>' + wash.rowCode.innerText + '</td>' +
                '<td class="text-uppercase">Car Wash</td>' +
                '<td class="text-center">' + qty + '</td>' +
                '<td class="text-right">LKR ' + unitPrice.toFixed(2) + '</td>' +
                '<td class="text-right">LKR ' + amount.toFixed(2) + '</td>' +
                '<td class="text-right">LKR ' + discount.toFixed(2) + '</td>' +
                '<td class="text-right font-weight-bold">LKR ' + total.toFixed(2) + '</td>' +
                '</tr>';
        });

        // Repairs
        repair_items.forEach(function (repair) {
            var hours     = parseFloat(repair.HoursInput.value)     || 0;
            var unitPrice = parseFloat(repair.UnitPriceInput.value) || 0;
            var discount  = parseFloat(repair.discountInput.value)  || 0;
            var amount    = hours * unitPrice;
            var total     = amount - discount;
            html += '<tr>' +
                '<td>' + repair.rowCode.innerText + '</td>' +
                '<td class="text-uppercase">' + repair.rowName.innerText + '</td>' +
                '<td class="text-center">' + hours + ' hrs</td>' +
                '<td class="text-right">LKR ' + unitPrice.toFixed(2) + '</td>' +
                '<td class="text-right">LKR ' + amount.toFixed(2) + '</td>' +
                '<td class="text-right">LKR ' + discount.toFixed(2) + '</td>' +
                '<td class="text-right font-weight-bold">LKR ' + total.toFixed(2) + '</td>' +
                '</tr>';
        });

        // Products
        products_items.forEach(function (product) {
            var qty       = parseFloat(product.quantityInput.value) || 0;
            var unitPrice = parseFloat(product.priceInput.value)    || 0;
            var discount  = parseFloat(product.discountInput.value) || 0;
            var amount    = qty * unitPrice;
            var total     = amount - discount;
            html += '<tr>' +
                '<td>' + product.rowCode.innerText + '</td>' +
                '<td class="text-uppercase">' + product.rowName.innerText + '</td>' +
                '<td class="text-center">' + qty + '</td>' +
                '<td class="text-right">LKR ' + unitPrice.toFixed(2) + '</td>' +
                '<td class="text-right">LKR ' + amount.toFixed(2) + '</td>' +
                '<td class="text-right">LKR ' + discount.toFixed(2) + '</td>' +
                '<td class="text-right font-weight-bold">LKR ' + total.toFixed(2) + '</td>' +
                '</tr>';
        });

        // Service Packages — one row per package, showing selected fuel + filter
        // Group unique package IDs from selected_fuel and selected_filter
        var packageIds = [];
        selected_fuel.forEach(function (f) {
            if (packageIds.indexOf(f.ServicePackageId) === -1) packageIds.push(f.ServicePackageId);
        });
        selected_filter.forEach(function (f) {
            if (packageIds.indexOf(f.ServicePackageId) === -1) packageIds.push(f.ServicePackageId);
        });

        packageIds.forEach(function (pkgId) {
            var fuel   = selected_fuel.find(function (f)   { return f.ServicePackageId === pkgId; });
            var filter = selected_filter.find(function (f) { return f.ServicePackageId === pkgId; });

            var pkgCode = fuel ? fuel.ServicePackageCode : (filter ? filter.ServicePackageCode : '');
            var pkgName = fuel ? fuel.ServicePackageName : (filter ? filter.ServicePackageName : '');

            var fuelAmt   = fuel   ? (parseFloat(fuel.price)   || 0) : 0;
            var filterAmt = filter ? (parseFloat(filter.price) || 0) : 0;
            var total     = fuelAmt + filterAmt;

            html += '<tr>' +
                '<td>' + pkgCode + '</td>' +
                '<td class="text-uppercase">' + pkgName + '</td>' +
                '<td class="text-center">1</td>' +
                '<td class="text-right">LKR ' + total.toFixed(2) + '</td>' +
                '<td class="text-right">LKR ' + total.toFixed(2) + '</td>' +
                '<td class="text-right">LKR 0.00</td>' +
                '<td class="text-right font-weight-bold">LKR ' + total.toFixed(2) + '</td>' +
                '</tr>';
        });

        if (!html) {
            html = '<tr><td colspan="7" class="text-center text-muted">No items added</td></tr>';
        }

        $('#tb_jobcard_items').html(html);
    }

    function calculateSubtotal() {
        var grandTotal = 0;

        // Washers
        items.forEach(function (w) {
            var qty  = parseFloat(w.quantityInput.value) || 0;
            var price = parseFloat(w.priceInput.value)   || 0;
            var disc  = parseFloat(w.discountInput.value)|| 0;
            grandTotal += (qty * price) - disc;
        });

        // Repairs
        repair_items.forEach(function (r) {
            var hrs   = parseFloat(r.HoursInput.value)     || 0;
            var price = parseFloat(r.UnitPriceInput.value) || 0;
            var disc  = parseFloat(r.discountInput.value)  || 0;
            grandTotal += (hrs * price) - disc;
        });

        // Products
        products_items.forEach(function (p) {
            var qty   = parseFloat(p.quantityInput.value) || 0;
            var price = parseFloat(p.priceInput.value)    || 0;
            var disc  = parseFloat(p.discountInput.value) || 0;
            grandTotal += (qty * price) - disc;
        });

        // Service packages — sum checked fuel + filter radio prices from DOM
        $('#table-jobcard-service-packages .fuel-radio:checked').each(function () {
            grandTotal += parseFloat($(this).closest('tr').find('.FuelPrice').val()) || 0;
        });
        $('#table-jobcard-service-packages .filter-radio:checked').each(function () {
            grandTotal += parseFloat($(this).closest('tr').find('.FilterPrice').val()) || 0;
        });

        $('#in_subtotal').text(grandTotal.toFixed(2));
        return grandTotal;
    }

    function displayCalculation() {
        var vatValue = parseFloat($('#in_vat_input').val()) || 0;
        var subtotal = parseFloat($('#in_subtotal').text()) || 0;
        var total    = subtotal + (subtotal * vatValue / 100);
        $('#in_total').text(total.toFixed(2));
    }

    $(document).on('input', '#in_vat_input', function () {
        calculateSubtotal();
        displayCalculation();
    });

    // ==========================================
    // 12. STEP NAVIGATION
    // ==========================================
    $(document).on('click', 'button', function (e) {
        if ($(this).attr('onclick') === 'stepper.previous()') {
            e.preventDefault(); e.stopPropagation();
            var currentStep = 1;
            if ($('#generate-invoice-part').is(':visible'))     currentStep = 7;
            else if ($('#select-products-part').is(':visible')) currentStep = 6;
            else if ($('#maintenance-part').is(':visible'))     currentStep = 5;
            else if ($('#service-package-part').is(':visible')) currentStep = 4;
            else if ($('#washer-part').is(':visible'))          currentStep = 3;
            else if ($('#vehicle-report-part').is(':visible'))  currentStep = 2;
            if (currentStep > 1) { window.stepper.to(currentStep - 1); window.showStepContent(currentStep - 1); }
        }
    });

    $('#job-card-step-1').on('click', function () {
        current_mileage = $('#current-mileage').val();
        new_mileage     = $('#new-mileage').val();
        paid_status     = $('#cmbpaidstatus').val();
        status          = $('#cmbstatus').val();
        notify          = $('input[name="customRadio"]:checked').val();
        if (!current_mileage) { Swal.fire({ icon: 'warning', title: 'Validation Error', text: 'Please enter current mileage' }); return; }
        if (!new_mileage)     { Swal.fire({ icon: 'warning', title: 'Validation Error', text: 'Please enter next mileage' });    return; }
        if (!paid_status)     { Swal.fire({ icon: 'warning', title: 'Validation Error', text: 'Please select paid status' });    return; }
        if (!status)          { Swal.fire({ icon: 'warning', title: 'Validation Error', text: 'Please select status' });         return; }
        window.stepper.to(2); window.showStepContent(2);
    });

    $('#job-card-step-2').on('click', function () { collectVehicleReportData(); window.stepper.to(3); window.showStepContent(3); });
    $('#job-card-step-3').on('click', function () { window.stepper.to(4); window.showStepContent(4); });
    $('#job-card-step-4').on('click', function () { window.stepper.to(5); window.showStepContent(5); });
    $('#job-card-step-5').on('click', function () { window.stepper.to(6); window.showStepContent(6); });
    $('#job-card-step-6').on('click', function () {
        generateInvoiceItems();
        calculateSubtotal();
        displayCalculation();
        window.stepper.to(7);
        window.showStepContent(7);
    });

    // ==========================================
    // 13. SUBMIT
    // ==========================================
    $('#submit_update_jobcard').on('click', function () {
        current_mileage = $('#current-mileage').val();
        if (!current_mileage) {
            Swal.fire({ icon: 'warning', title: 'Validation Error', text: 'Please enter current mileage' });
            window.stepper.to(1); window.showStepContent(1); return;
        }

        var repairArr = repair_items.map(function (repair) {
            return {
                repair_id : repair.rowID.innerText,
                repairCode: repair.rowCode.innerText,
                repairName: repair.rowName.innerText,
                hours     : repair.HoursInput.value,
                price     : repair.UnitPriceInput.value,
                discount  : repair.discountInput.value,
                total     : repair.totalCell.innerText
            };
        });

        var productArr = products_items.map(function (product) {
            return {
                product_id : product.rowID.innerText,
                productCode: product.rowCode.innerText,
                productName: product.rowName.innerText,
                qty        : product.quantityInput.value,
                price      : product.priceInput.value,
                discount   : product.discountInput.value,
                total      : product.totalCell.innerText
            };
        });

        var jobCardData = {
            job_card_id     : jobCardId,
            vehicle_id      : vehicle[0].vehicle_id,
            vehicle_number  : vehicle[0].vehicle_number,
            current_mileage : current_mileage,
            new_mileage     : $('#new-mileage').val(),
            paid_status     : $('#cmbpaidstatus').val(),
            job_card_type   : job_card_type,
            status          : $('#cmbstatus').val(),
            notify          : $('input[name="customRadio"]:checked').val(),
            invoice_code    : invoiceCode,
            vat             : $('#in_vat_input').val() || 0,
            vehicle_reports : JSON.stringify(rowVehicleReportData),
            washers         : JSON.stringify(WasherValues),
            fuels           : JSON.stringify(selected_fuel),
            filters         : JSON.stringify(selected_filter),
            repairs         : JSON.stringify(repairArr),
            products        : JSON.stringify(productArr),
            vehicleDetails  : JSON.stringify(vehicle),
            station         : JSON.stringify(serviceStationInfo)
        };

        $('#submit_update_jobcard').hide();
        $('#btn-loading').show();

        $.ajax({
            type    : 'POST',
            url     : '../api/update-jobcard.php',
            data    : jobCardData,
            success : function (response) {
                $('#btn-loading').hide(); $('#submit_update_jobcard').show();
                if (response === 'success' || (typeof response === 'object' && response.success)) {
                    Swal.fire({ icon: 'success', title: 'Job Card Updated!', text: 'The job card has been updated successfully.', confirmButtonColor: '#007bff' })
                        .then(function (result) { if (result.isConfirmed) window.location.href = '../job-cards/'; });
                } else {
                    Swal.fire({ icon: 'error', title: 'Please Try Again', text: (typeof response === 'object' ? response.message : null) || 'Something Went Wrong' });
                }
            },
            error: function (xhr) {
                $('#btn-loading').hide(); $('#submit_update_jobcard').show();
                Swal.fire({ icon: 'error', title: 'Server Error', text: xhr.responseText ? xhr.responseText.substring(0, 200) : 'Something Went Wrong' });
            }
        });
    });

    // ==========================================
    // 14. UTILITIES
    // ==========================================
    function removeLeadingZeros(phone) { return (phone || '').replace(/^0+/, ''); }
    function generateUUID() { return 'INV-' + Date.now() + '-' + Math.floor(Math.random() * 10000); }
});