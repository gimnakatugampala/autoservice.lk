$(document).ready(function () {
    console.log("Edit Job Card Script Loaded");

    // ==========================================
    // 1. GLOBAL HELPER FUNCTION
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
        window.stepper = new Stepper(stepperElement, {
            linear: false,
            animation: false
        });
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

    var vehicle            = [];
    var serviceStationInfo = [];
    var current_mileage    = 0;
    var new_mileage        = 0;
    var paid_status        = "";
    var job_card_type      = "";
    var status             = "";
    var notify             = "";
    var jobCardId          = 0;
    var invoiceCode        = "";
    var vehicleClassId     = null;

    var rowVehicleReportData = [];

    // Washer (DOM-reference style like add_jobcard)
    var items        = [];
    var WasherValues = [];

    // Service Packages
    var selected_service_packages = [];
    var selected_fuel             = [];
    var selected_filter           = [];

    // Repairs (DOM-reference style)
    var repair_items     = [];
    var selected_repairs = [];

    // Products (DOM-reference style)
    var products_items    = [];
    var selected_products = [];

    if (!jobCardCode) {
        Swal.fire({
            icon: 'warning',
            title: 'No Job Card Code',
            text: 'Please provide a job card code in the URL'
        }).then(function () {
            window.location.href = '../job-cards/';
        });
        return;
    }

    loadJobCardData(jobCardCode);

    // ==========================================
    // 4. LOAD & POPULATE  (STEP 1 — PRESERVED AS-IS)
    // ==========================================
    function loadJobCardData(code) {
        $.ajax({
            type: 'POST',
            url: '../api/get-jobcard-data.php',
            data: { code: code },
            dataType: 'json',
            beforeSend: function () {
                $('#search-vehicle-content').html(
                    '<div class="d-flex justify-content-center my-4">' +
                    '<div class="spinner-border text-primary" role="status">' +
                    '<span class="sr-only">Loading...</span></div></div>'
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

    function populateExistingData(data) {
        var jc = data.job_card;

        jobCardId      = jc.id;
        invoiceCode    = jc.invoice_code || generateUUID();
        vehicleClassId = jc.vehicle_class_id;

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
        current_mileage    = jc.job_mileage  || 0;
        new_mileage        = jc.next_mileage || 0;
        paid_status        = jc.paid_status_id;
        job_card_type      = jc.job_card_type_id;
        status             = jc.status_id;
        notify             = jc.notify_month || 2;

        populateVehicleInfo(data);
        populateVehicleReports(data.reports);
        populateWashers(data.washers);
        populateServicePackages(data.fuels, data.filters);
        populateRepairs(data.repairs);
        populateProducts(data.products);

        setTimeout(function () {
            getInvoiceDetails(vehicle, serviceStationInfo);
        }, 200);
    }

    // ── STEP 1: Vehicle Info (preserved) ─────────────────────────────────────
    function populateVehicleInfo(data) {
        var jc = data.job_card;

        var vehicleImages = {
            1:  '../assets/img/vehicle-img/light_motor_cycle.jpg',
            2:  '../assets/img/vehicle-img/motor_cycles.jpg',
            3:  '../assets/img/vehicle-img/three_wheeler.jpg',
            4:  '../assets/img/vehicle-img/van.jpg',
            5:  '../assets/img/vehicle-img/car.jpg',
            6:  '../assets/img/vehicle-img/Light_Motor_Lorry.jpg',
            7:  '../assets/img/vehicle-img/motor_lorry.jpg',
            8:  '../assets/img/vehicle-img/Heavy_Motor_Lorry.jpg',
            9:  '../assets/img/vehicle-img/light_bus.jpg',
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
            '<span class="m-0 p-0 d-flex align-items-center text-secondary mr-2"><span class="mr-1">Color: </span>' +
            '<div class="border" style="width:15px;height:15px;background-color:' + jc.vehicle_color + ';border-radius:50%"></div></span>' +
            '<span class="h4 m-0 p-0"><b>' + jc.vehicle_number + '</b></span></div>' +
            '<p class="m-0 p-0 text-secondary mt-2">' + jc.first_name + ' ' + jc.last_name + '</p>' +
            '<p class="m-0 p-0 text-secondary">+94 ' + removeLeadingZeros(jc.phone) + '</p>' +
            '<p class="m-0 p-0 text-secondary">Previous Mileage: ' + (jc.current_mileage || 0) + ' KM</p>' +
            '</div></div></div></div>' +

            '<div class="row">' +
            '<div class="col-md-4 mx-auto"><div class="form-group">' +
            '<label for="current-mileage">Current Mileage (KM) <span class="text-danger">*</span></label>' +
            '<input type="number" class="form-control" id="current-mileage" placeholder="Current Mileage" value="' + current_mileage + '"></div></div>' +
            '<div class="col-md-4 mx-auto"><div class="form-group">' +
            '<label for="new-mileage">Next Service Mileage (KM) <span class="text-danger">*</span></label>' +
            '<input type="number" class="form-control" id="new-mileage" placeholder="Next Mileage" value="' + new_mileage + '"></div></div></div>' +

            '<div class="row">' +
            '<div class="col-sm-4"><div class="form-group"><label>Paid Status <span class="text-danger">*</span></label>' +
            '<select id="cmbpaidstatus" class="custom-select"><option value="" disabled>Please Select</option>' +
            data.cmbpaidstatus.map(function (s) {
                return '<option value="' + s.id + '"' + (s.id == paid_status ? ' selected' : '') + '>' + s.status + '</option>';
            }).join('') + '</select></div></div>' +

            '<div class="col-sm-4"><div class="form-group"><label>Job Card Type <span class="text-danger">*</span></label>' +
            '<select id="cmbjobcardtype" class="custom-select" disabled><option value="" disabled>Please Select</option>' +
            data.cmbjobtypes.map(function (s) {
                return '<option value="' + s.id + '"' + (s.id == job_card_type ? ' selected' : '') + '>' + s.type + '</option>';
            }).join('') + '</select></div></div>' +

            '<div class="col-sm-4"><div class="form-group"><label>Status <span class="text-danger">*</span></label>' +
            '<select id="cmbstatus" class="custom-select"><option value="" disabled>Please Select</option>' +
            data.cmbstatus.map(function (s) {
                return '<option value="' + s.id + '"' + (s.id == status ? ' selected' : '') + '>' + s.status + '</option>';
            }).join('') + '</select></div></div></div>' +

            '<div class="row"><div class="col-md-8 mx-auto">' +
            '<label>Notify Customer For Next Service <span class="text-danger">*</span></label>' +
            '<div class="row mt-2">' +
            '<div class="col-md-4"><div class="custom-control custom-radio">' +
            '<input value="2" class="custom-control-input" type="radio" id="customRadio2" name="customRadio"' + (notify == 2 ? ' checked' : '') + '>' +
            '<label for="customRadio2" class="custom-control-label">In 2 Months</label></div></div>' +
            '<div class="col-md-4"><div class="custom-control custom-radio">' +
            '<input value="4" class="custom-control-input" type="radio" id="customRadio4" name="customRadio"' + (notify == 4 ? ' checked' : '') + '>' +
            '<label for="customRadio4" class="custom-control-label">In 4 Months</label></div></div>' +
            '<div class="col-md-4"><div class="custom-control custom-radio">' +
            '<input value="6" class="custom-control-input" type="radio" id="customRadio6" name="customRadio"' + (notify == 6 ? ' checked' : '') + '>' +
            '<label for="customRadio6" class="custom-control-label">In 6 Months</label></div></div>' +
            '</div></div></div>';

        $('#search-vehicle-content').html(html).show().css('display', 'block');
    }

    // ── STEP 2: Vehicle Reports ───────────────────────────────────────────────
    function populateVehicleReports(reports) {
        if (!reports || reports.length === 0) {
            if (job_card_type == '6' || job_card_type == '3' || job_card_type == '5') {
                $.ajax({
                    type: 'POST', url: '../api/getvehiclereport.php', dataType: 'json',
                    success: function (data) { populateVehicleReportContent(data, []); },
                    error: function () {
                        $('#vehicle-report-tables').html('<p class="text-center text-danger">Failed to load vehicle report template</p>');
                    }
                });
            } else {
                $('#vehicle-report-tables').html('<p class="text-center text-muted">Vehicle reports not available for this job card type.</p>');
            }
            return;
        }
        $.ajax({
            type: 'POST', url: '../api/getvehiclereport.php', dataType: 'json',
            success: function (data) { populateVehicleReportContent(data, reports); }
        });
    }

    function populateVehicleReportContent(data, existingReports) {
        var tablesHTML = data.vehicle_category.map(function (category) {
            var rows = data.vehicle_subcategory
                .filter(function (sub) { return sub.vehicle_condition_category_id === category.id; })
                .map(function (sub) {
                    var existing      = existingReports.find(function (r) { return r.sub_category_id == sub.id; });
                    var selectedValue = existing ? existing.value_id : null;
                    var radios = [1, 2, 3, 4, 5].map(function (val) {
                        return '<td class="text-center"><input value="' + val + '" class="form-check-input" type="radio" name="radio' + sub.id + '"' + (selectedValue == val ? ' checked' : '') + '></td>';
                    }).join('');
                    return '<tr data-category-id="' + category.id + '" data-subcategory-id="' + sub.id + '"><td>' + sub.sub_category + '</td>' + radios + '</tr>';
                }).join('');

            return '<div class="col-md-10 table-responsive p-0 mx-auto my-2">' +
                   '<table class="table table-striped table-bordered table-hover"><thead><tr>' +
                   '<th style="width:30%">' + category.category + '</th>' +
                   '<th class="text-center">Worse</th><th class="text-center">Bad</th>' +
                   '<th class="text-center">Ok</th><th class="text-center">Good</th><th class="text-center">Perfect</th>' +
                   '</tr></thead><tbody>' + rows + '</tbody></table></div>';
        }).join('');

        $('#vehicle-report-tables').html(tablesHTML);
        collectVehicleReportData();
        $('#vehicle-report-tables input[type="radio"]').on('change', collectVehicleReportData);
    }

    function collectVehicleReportData() {
        rowVehicleReportData = [];
        $('#vehicle-report-tables tr[data-category-id]').each(function () {
            var categoryId    = $(this).data('category-id');
            var subcategoryId = $(this).data('subcategory-id');
            var selected      = $(this).find('input[type="radio"]:checked');
            if (selected.length > 0) {
                rowVehicleReportData.push({
                    categoryId    : categoryId,
                    subcategoryId : subcategoryId,
                    value         : parseInt(selected.val())
                });
            }
        });
    }

    // ==========================================
    // 5. STEP 3: WASHERS  (add_jobcard style)
    // ==========================================
    function populateWashers(washers) {
        items        = [];
        WasherValues = [];
        $('#table-jobcard-washer tbody').empty();

        if (!washers || washers.length === 0) {
            if (vehicleClassId) {
                $.ajax({
                    type: 'POST', url: '../api/getwasherbyvehicleclassid.php',
                    data: { vehicle_class_id: vehicleClassId }, dataType: 'json',
                    success: function (data) {
                        if (data && data.length > 0) {
                            addWasherRow(data[0].id, data[0].code, 1, parseFloat(data[0].price) || 0, 0);
                        } else {
                            $('#table-jobcard-washer tbody').html('<tr><td colspan="8" class="text-center text-muted">No washers found</td></tr>');
                        }
                    }
                });
            } else {
                $('#table-jobcard-washer tbody').html('<tr><td colspan="8" class="text-center text-muted">No washers added</td></tr>');
            }
            return;
        }

        washers.forEach(function (washer) {
            addWasherRow(washer.washer_id, washer.code, parseFloat(washer.qty) || 1, parseFloat(washer.price) || 0, parseFloat(washer.discount) || 0);
        });
    }

    function addWasherRow(washerId, washerCode, qty, price, discount) {
        var rowIndex = $('#table-jobcard-washer tbody tr.rowBody').length + 1;

        // Remove placeholder row if present
        $('#table-jobcard-washer tbody tr:not(.rowBody)').remove();

        var row = $(
            '<tr class="rowBody">' +
            '<td style="display:none;" class="rowID">' + washerId + '</td>' +
            '<td style="display:none;" class="rowCode">' + washerCode + '</td>' +
            '<td>' + rowIndex + '</td>' +
            '<td>Wash (' + washerCode + ')</td>' +
            '<td><input value="' + qty + '" type="number" class="form-control wash-qty" min="0" step="1"></td>' +
            '<td><input value="' + price + '" type="number" class="form-control wash-unit-price" min="0" step="0.01"></td>' +
            '<td><input value="' + discount + '" type="number" class="form-control wash-discount" min="0" step="0.01"></td>' +
            '<td><p class="h6 font-weight-bold wash-total">0.00</p></td>' +
            '</tr>'
        );

        $('#table-jobcard-washer tbody').append(row);

        var item = {
            rowCode       : row.find('.rowCode')[0],
            rowID         : row.find('.rowID')[0],
            quantityInput : row.find('.wash-qty')[0],
            priceInput    : row.find('.wash-unit-price')[0],
            discountInput : row.find('.wash-discount')[0],
            totalCell     : row.find('.wash-total')[0]
        };
        items.push(item);

        $(item.quantityInput).on('input', calculateWasherTotal);
        $(item.priceInput).on('input', calculateWasherTotal);
        $(item.discountInput).on('input', calculateWasherTotal);
        calculateWasherTotal();
    }

    // Washer search
    $(document).on('click', '#washer-search-btn', function () {
        var q = $('#washer-search-input').val().trim();
        if (!q) return;
        $.ajax({
            url: '../api/getwashers.php', type: 'POST',
            data: { search: q, vehicle_class_id: vehicleClassId }, dataType: 'json',
            success: function (data) {
                var $res = $('#washer-search-results').empty().show();
                if (!data || data.length === 0) { $res.append('<a class="list-group-item disabled">No results found</a>'); return; }
                data.forEach(function (w) {
                    $res.append(
                        '<a class="list-group-item list-group-item-action washer-result-item" href="#" ' +
                        'data-id="' + w.id + '" data-code="' + (w.code || '') + '" data-price="' + (parseFloat(w.price) || 0) + '">' +
                        'Wash (' + (w.code || '') + ') — LKR ' + parseFloat(w.price || 0).toFixed(2) + '</a>'
                    );
                });
            }
        });
    });

    $(document).on('click', '.washer-result-item', function (e) {
        e.preventDefault();
        addWasherRow($(this).data('id'), $(this).data('code'), 1, parseFloat($(this).data('price')) || 0, 0);
        $('#washer-search-results').hide().empty();
        $('#washer-search-input').val('');
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('#washer-search-bar').length) $('#washer-search-results').hide();
    });

    function calculateWasherTotal() {
        WasherValues = [];
        var grandTotal = 0;
        items.forEach(function (item) {
            if (!item.quantityInput) return;
            var qty      = parseFloat($(item.quantityInput).val()) || 0;
            var price    = parseFloat($(item.priceInput).val())    || 0;
            var discount = parseFloat($(item.discountInput).val()) || 0;
            var total    = (qty * price) - discount;
            $(item.totalCell).text(total.toFixed(2));
            grandTotal += total;
            if (qty > 0) {
                WasherValues.push({
                    washerID : $(item.rowID).text(),
                    code     : $(item.rowCode).text(),
                    qty      : qty,
                    price    : price,
                    discount : discount,
                    total    : total
                });
            }
        });
        $('#washer-grand-total').text(grandTotal.toFixed(2));
        calculateInvoiceTotal();
    }

    // ==========================================
    // 6. STEP 4: SERVICE PACKAGES  (add_jobcard style)
    // ==========================================
    function populateServicePackages(fuels, filters) {
        selected_fuel             = [];
        selected_filter           = [];
        selected_service_packages = [];

        if ((!fuels || fuels.length === 0) && (!filters || filters.length === 0)) {
            $('#table-service-packages tbody').html('<tr><td colspan="4" class="text-center text-muted">No service packages added</td></tr>');
            return;
        }

        var packageMap = {};
        (fuels || []).forEach(function (f) {
            if (!packageMap[f.service_package_id]) packageMap[f.service_package_id] = { fuels: [], filters: [] };
            packageMap[f.service_package_id].fuels.push({ id: f.fuel_type_id, name: f.fuel_name, price: parseFloat(f.price) });
            selected_fuel.push({
                ServicePackageId   : f.service_package_id,
                ServicePackageName : 'Service Package',
                ServicePackageCode : 'SP-' + f.service_package_id,
                price  : parseFloat(f.price),
                typeId : f.fuel_type_id
            });
        });
        (filters || []).forEach(function (f) {
            if (!packageMap[f.service_package_id]) packageMap[f.service_package_id] = { fuels: [], filters: [] };
            packageMap[f.service_package_id].filters.push({ id: f.filter_type_id, name: f.filter_name, price: parseFloat(f.price) });
            selected_filter.push({
                ServicePackageId   : f.service_package_id,
                ServicePackageName : 'Service Package',
                ServicePackageCode : 'SP-' + f.service_package_id,
                price  : parseFloat(f.price),
                typeId : f.filter_type_id
            });
        });

        var html = '';
        var index = 1;
        Object.keys(packageMap).forEach(function (pkgId) {
            var pkg = packageMap[pkgId];
            var total = 0; var itemsList = [];
            pkg.fuels.forEach(function (f)   { itemsList.push(f.name); total += f.price; });
            pkg.filters.forEach(function (f) { itemsList.push(f.name); total += f.price; });
            html += '<tr><td>' + index++ + '</td>' +
                    '<td>Service Package #' + pkgId + '<br><small class="text-muted">' + itemsList.join(', ') + '</small></td>' +
                    '<td><strong>LKR ' + total.toFixed(2) + '</strong></td>' +
                    '<td><button type="button" class="btn btn-sm bg-gradient-danger sp-remove-btn" data-pkgid="' + pkgId + '"><i class="fas fa-trash"></i></button></td></tr>';
            selected_service_packages.push({ id: pkgId });
        });

        $('#table-service-packages tbody').html(html);
        calculateServicePackageTotal();
    }

    // Service package search
    $(document).on('click', '#sp-search-btn', function () {
        var q = $('#sp-search-input').val().trim();
        if (!q) return;
        $.ajax({
            url: '../api/getservicepackages.php', type: 'POST', data: { search: q }, dataType: 'json',
            success: function (data) {
                var $res = $('#sp-search-results').empty().show();
                if (!data || data.length === 0) { $res.append('<a class="list-group-item disabled">No results found</a>'); return; }
                data.forEach(function (pkg) {
                    $res.append(
                        '<a class="list-group-item list-group-item-action sp-result-item" href="#" ' +
                        'data-id="' + pkg.id + '" data-code="' + (pkg.code || '') + '" data-name="' + (pkg.name || '') + '">' +
                        '<b>' + (pkg.code || '') + '</b> — ' + (pkg.name || '') + ' (LKR ' + parseFloat(pkg.total_price || 0).toFixed(2) + ')</a>'
                    );
                });
            }
        });
    });

    $(document).on('click', '.sp-result-item', function (e) {
        e.preventDefault();
        var pkgId = $(this).data('id'), pkgCode = $(this).data('code'), pkgName = $(this).data('name');
        $.ajax({
            url: '../api/getservicepackagedetails.php', type: 'POST', data: { package_id: pkgId }, dataType: 'json',
            success: function (data) {
                selected_fuel   = selected_fuel.filter(function (f)   { return f.ServicePackageId != pkgId; });
                selected_filter = selected_filter.filter(function (f) { return f.ServicePackageId != pkgId; });
                (data.fuels || []).forEach(function (f) {
                    selected_fuel.push({ ServicePackageId: pkgId, ServicePackageCode: pkgCode || ('SP-' + pkgId), ServicePackageName: pkgName || 'Service Package', typeId: f.fuel_type_id || f.typeId, price: parseFloat(f.price) || 0 });
                });
                (data.filters || []).forEach(function (f) {
                    selected_filter.push({ ServicePackageId: pkgId, ServicePackageCode: pkgCode || ('SP-' + pkgId), ServicePackageName: pkgName || 'Service Package', typeId: f.filter_type_id || f.typeId, price: parseFloat(f.price) || 0 });
                });
                if (!selected_service_packages.find(function (p) { return p.id == pkgId; })) selected_service_packages.push({ id: pkgId });
                refreshServicePackageTable();
                $('#sp-search-results').hide().empty();
                $('#sp-search-input').val('');
            }
        });
    });

    $(document).on('click', '.sp-remove-btn', function () {
        var pkgId = $(this).data('pkgid');
        selected_fuel             = selected_fuel.filter(function (f)   { return f.ServicePackageId != pkgId; });
        selected_filter           = selected_filter.filter(function (f) { return f.ServicePackageId != pkgId; });
        selected_service_packages = selected_service_packages.filter(function (p) { return p.id != pkgId; });
        refreshServicePackageTable();
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('#sp-search-bar').length) $('#sp-search-results').hide();
    });

    function refreshServicePackageTable() {
        var pkgMap = {};
        selected_fuel.forEach(function (f)   { if (!pkgMap[f.ServicePackageId]) pkgMap[f.ServicePackageId] = { fuels: [], filters: [] }; pkgMap[f.ServicePackageId].fuels.push(f); });
        selected_filter.forEach(function (f) { if (!pkgMap[f.ServicePackageId]) pkgMap[f.ServicePackageId] = { fuels: [], filters: [] }; pkgMap[f.ServicePackageId].filters.push(f); });
        var html = ''; var index = 1;
        Object.keys(pkgMap).forEach(function (pkgId) {
            var pkg = pkgMap[pkgId]; var total = 0; var itemsList = [];
            pkg.fuels.forEach(function (f)   { total += f.price; itemsList.push('Fuel'); });
            pkg.filters.forEach(function (f) { total += f.price; itemsList.push('Filter'); });
            html += '<tr><td>' + index++ + '</td>' +
                    '<td>Service Package #' + pkgId + '<br><small class="text-muted">' + itemsList.join(', ') + '</small></td>' +
                    '<td><strong>LKR ' + total.toFixed(2) + '</strong></td>' +
                    '<td><button type="button" class="btn btn-sm bg-gradient-danger sp-remove-btn" data-pkgid="' + pkgId + '"><i class="fas fa-trash"></i></button></td></tr>';
        });
        if (!html) html = '<tr><td colspan="4" class="text-center text-muted">No service packages. Search to add one.</td></tr>';
        $('#table-service-packages tbody').html(html);
        calculateServicePackageTotal();
    }

    function calculateServicePackageTotal() {
        var grandTotal = 0;
        selected_fuel.forEach(function (f)   { grandTotal += f.price; });
        selected_filter.forEach(function (f) { grandTotal += f.price; });
        $('#service-package-grand-total').text(grandTotal.toFixed(2));
        calculateInvoiceTotal();
    }

    // ==========================================
    // 7. STEP 5: REPAIRS  (add_jobcard style)
    // ==========================================
    function populateRepairs(repairs) {
        repair_items     = [];
        selected_repairs = [];
        $('#table-jobcard-repair tbody').empty();

        if (!repairs || repairs.length === 0) {
            $('#table-jobcard-repair tbody').html('<tr><td colspan="10" class="text-center text-muted">No repairs added</td></tr>');
            return;
        }
        repairs.forEach(function (repair, index) {
            addRepairRow(repair.repair_id, repair.code, repair.name, parseFloat(repair.hours) || 0, parseFloat(repair.unit_price) || 0, parseFloat(repair.discount) || 0, index + 1);
        });
    }

    function addRepairRow(repairId, repairCode, repairName, hours, unitPrice, discount, rowNum) {
        var index = rowNum || ($('#table-jobcard-repair tbody tr[data-repair-row]').length + 1);
        $('#table-jobcard-repair tbody tr:not([data-repair-row])').remove();

        var row = $(
            '<tr data-repair-row="1">' +
            '<td class="rowID" style="display:none;">' + repairId + '</td>' +
            '<td class="rowCode" style="display:none;">' + repairCode + '</td>' +
            '<td class="rowName" style="display:none;">' + repairName + '</td>' +
            '<td>' + index + '</td>' +
            '<td>' + repairName + '</td>' +
            '<td><input value="' + hours + '" type="number" class="form-control hours" min="0" step="0.5"></td>' +
            '<td><input value="' + unitPrice + '" type="number" class="form-control unit-price" min="0" step="0.01"></td>' +
            '<td><input value="' + discount + '" type="number" class="form-control discount" min="0" step="0.01"></td>' +
            '<td><p class="h6 repair-total">0.00</p></td>' +
            '<td><button data-id="' + repairId + '" type="button" class="btn btn-sm bg-gradient-danger deleteRepairItem"><i class="fas fa-trash"></i></button></td>' +
            '</tr>'
        );
        $('#table-jobcard-repair tbody').append(row);

        var item = {
            rowID         : row.find('.rowID')[0],
            rowCode       : row.find('.rowCode')[0],
            rowName       : row.find('.rowName')[0],
            HoursInput    : row.find('.hours')[0],
            UnitPriceInput: row.find('.unit-price')[0],
            discountInput : row.find('.discount')[0],
            totalCell     : row.find('.repair-total')[0]
        };
        repair_items.push(item);
        selected_repairs.push({ id: repairId });

        $(item.HoursInput).on('input', calculateRepairTotal);
        $(item.UnitPriceInput).on('input', calculateRepairTotal);
        $(item.discountInput).on('input', calculateRepairTotal);
        calculateRepairTotal();
    }

    // Repair search
    $(document).on('click', '#repair-search-btn', function () {
        var q = $('#repair-search-input').val().trim();
        if (!q) return;
        $.ajax({
            url: '../api/getrepairs.php', type: 'POST', data: { search: q }, dataType: 'json',
            success: function (data) {
                var $res = $('#repair-search-results').empty().show();
                if (!data || data.length === 0) { $res.append('<a class="list-group-item disabled">No results found</a>'); return; }
                data.forEach(function (r) {
                    $res.append(
                        '<a class="list-group-item list-group-item-action repair-result-item" href="#" ' +
                        'data-id="' + r.id + '" data-code="' + (r.code || '') + '" data-name="' + (r.name || '') + '" data-price="' + (parseFloat(r.price) || 0) + '">' +
                        '<b>' + (r.code || '') + '</b> — ' + (r.name || '') + ' (LKR ' + parseFloat(r.price || 0).toFixed(2) + ')</a>'
                    );
                });
            }
        });
    });

    $(document).on('click', '.repair-result-item', function (e) {
        e.preventDefault();
        var $el = $(this);
        if (selected_repairs.find(function (r) { return r.id == $el.data('id'); })) {
            Swal.fire('Warning', 'This repair is already added.', 'warning');
            $('#repair-search-results').hide().empty(); return;
        }
        var nextIndex = $('#table-jobcard-repair tbody tr[data-repair-row]').length + 1;
        addRepairRow($el.data('id'), $el.data('code'), $el.data('name'), 1, parseFloat($el.data('price')) || 0, 0, nextIndex);
        $('#repair-search-results').hide().empty();
        $('#repair-search-input').val('');
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('#repair-search-bar').length) $('#repair-search-results').hide();
    });

    $(document).on('click', '.deleteRepairItem', function () {
        var repairId = $(this).data('id');
        var $btn = $(this);
        Swal.fire({
            title: 'Are you sure?', text: 'Do you want to remove this repair item?', icon: 'warning',
            showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Yes, remove it!'
        }).then(function (result) {
            if (result.isConfirmed) {
                $btn.closest('tr').remove();
                repair_items     = repair_items.filter(function (item) { return $(item.rowID).text() != repairId; });
                selected_repairs = selected_repairs.filter(function (r) { return r.id != repairId; });
                $('#table-jobcard-repair tbody tr[data-repair-row]').each(function (i) { $(this).find('td:eq(3)').text(i + 1); });
                calculateRepairTotal();
                Swal.fire('Removed!', 'Repair item has been removed.', 'success');
            }
        });
    });

    function calculateRepairTotal() {
        var grandTotal = 0;
        repair_items.forEach(function (item) {
            var hours    = parseFloat($(item.HoursInput).val())     || 0;
            var price    = parseFloat($(item.UnitPriceInput).val()) || 0;
            var discount = parseFloat($(item.discountInput).val())  || 0;
            var total    = (hours * price) - discount;
            $(item.totalCell).text(total.toFixed(2));
            grandTotal += total;
        });
        $('#repair-grand-total').text(grandTotal.toFixed(2));
        calculateInvoiceTotal();
    }

    // ==========================================
    // 8. STEP 6: PRODUCTS  (add_jobcard style)
    // ==========================================
    function populateProducts(products) {
        products_items    = [];
        selected_products = [];
        $('#table-jobcard-products tbody').empty();

        if (!products || products.length === 0) {
            $('#table-jobcard-products tbody').html('<tr><td colspan="10" class="text-center text-muted">No products added</td></tr>');
            return;
        }
        products.forEach(function (product, index) {
            addProductRow(product.product_id, product.code, product.product_name, parseFloat(product.qty) || 1, parseFloat(product.price) || 0, parseFloat(product.discount) || 0, index + 1);
        });
    }

    function addProductRow(productId, productCode, productName, qty, price, discount, rowNum) {
        var index = rowNum || ($('#table-jobcard-products tbody tr[data-product-row]').length + 1);
        $('#table-jobcard-products tbody tr:not([data-product-row])').remove();

        var row = $(
            '<tr data-product-row="1">' +
            '<td class="rowProductID" style="display:none;">' + productId + '</td>' +
            '<td class="rowProductCode" style="display:none;">' + productCode + '</td>' +
            '<td class="rowProductName" style="display:none;">' + productName + '</td>' +
            '<td>' + index + '</td>' +
            '<td>' + productName + '</td>' +
            '<td><input value="' + qty + '" type="number" class="form-control quantityQty" min="0" step="1"></td>' +
            '<td><input value="' + price + '" type="number" class="form-control unitPriceProduct" min="0" step="0.01"></td>' +
            '<td><input value="' + discount + '" type="number" class="form-control discountProduct" min="0" step="0.01"></td>' +
            '<td><p class="h6 totalProduct">0.00</p></td>' +
            '<td><button data-id="' + productId + '" type="button" class="btn btn-sm bg-gradient-danger deleteProductsItem"><i class="fas fa-trash"></i></button></td>' +
            '</tr>'
        );
        $('#table-jobcard-products tbody').append(row);

        var item = {
            rowID         : row.find('.rowProductID')[0],
            rowCode       : row.find('.rowProductCode')[0],
            rowName       : row.find('.rowProductName')[0],
            quantityInput : row.find('.quantityQty')[0],
            priceInput    : row.find('.unitPriceProduct')[0],
            discountInput : row.find('.discountProduct')[0],
            totalCell     : row.find('.totalProduct')[0]
        };
        products_items.push(item);
        selected_products.push({ id: productId });

        $(item.quantityInput).on('input', calculateProductTotal);
        $(item.priceInput).on('input', calculateProductTotal);
        $(item.discountInput).on('input', calculateProductTotal);
        calculateProductTotal();
    }

    // Product search
    $(document).on('click', '#product-search-btn', function () {
        var q = $('#product-search-input').val().trim();
        if (!q) return;
        $.ajax({
            url: '../api/getproducts.php', type: 'POST', data: { search: q }, dataType: 'json',
            success: function (data) {
                var $res = $('#product-search-results').empty().show();
                if (!data || data.length === 0) { $res.append('<a class="list-group-item disabled">No results found</a>'); return; }
                data.forEach(function (p) {
                    $res.append(
                        '<a class="list-group-item list-group-item-action product-result-item" href="#" ' +
                        'data-id="' + p.id + '" data-code="' + (p.code || '') + '" data-name="' + (p.name || p.product_name || '') + '" data-price="' + (parseFloat(p.price) || 0) + '">' +
                        '<b>' + (p.code || '') + '</b> — ' + (p.name || p.product_name || '') + ' (LKR ' + parseFloat(p.price || 0).toFixed(2) + ')</a>'
                    );
                });
            }
        });
    });

    $(document).on('click', '.product-result-item', function (e) {
        e.preventDefault();
        var $el = $(this);
        if (selected_products.find(function (p) { return p.id == $el.data('id'); })) {
            Swal.fire('Warning', 'This product is already added.', 'warning');
            $('#product-search-results').hide().empty(); return;
        }
        var nextIndex = $('#table-jobcard-products tbody tr[data-product-row]').length + 1;
        addProductRow($el.data('id'), $el.data('code'), $el.data('name'), 1, parseFloat($el.data('price')) || 0, 0, nextIndex);
        $('#product-search-results').hide().empty();
        $('#product-search-input').val('');
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('#product-search-bar').length) $('#product-search-results').hide();
    });

    $(document).on('click', '.deleteProductsItem', function () {
        var productId = $(this).data('id');
        var $btn = $(this);
        Swal.fire({
            title: 'Are you sure?', text: 'Do you want to remove this product?', icon: 'warning',
            showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Yes, remove it!'
        }).then(function (result) {
            if (result.isConfirmed) {
                $btn.closest('tr').remove();
                products_items    = products_items.filter(function (item) { return $(item.rowID).text() != productId; });
                selected_products = selected_products.filter(function (p) { return p.id != productId; });
                $('#table-jobcard-products tbody tr[data-product-row]').each(function (i) { $(this).find('td:eq(3)').text(i + 1); });
                calculateProductTotal();
                Swal.fire('Removed!', 'Product has been removed.', 'success');
            }
        });
    });

    function calculateProductTotal() {
        var grandTotal = 0;
        products_items.forEach(function (item) {
            var qty      = parseFloat($(item.quantityInput).val()) || 0;
            var price    = parseFloat($(item.priceInput).val())    || 0;
            var discount = parseFloat($(item.discountInput).val()) || 0;
            var total    = (qty * price) - discount;
            $(item.totalCell).text(total.toFixed(2));
            grandTotal += total;
        });
        $('#product-grand-total').text(grandTotal.toFixed(2));
        calculateInvoiceTotal();
    }

    // ==========================================
    // 9. STEP 7: INVOICE
    // ==========================================
    function getInvoiceDetails(vehicleData, stationData) {
        if (!vehicleData || !vehicleData.length || !stationData || !stationData.length) return;
        var jc = vehicleData[0], station = stationData[0];

        $('#station-logo').attr('src', station.logo ? '../uploads/stations/' + station.logo : '../dist/img/system/logo_pistona.png');
        $('#station-name').text(station.service_name || 'Station Name');
        $('#station-address').text([station.address, station.street, station.city].filter(Boolean).join(', ') || 'Station Address');
        $('#station-contact').text('Tel: ' + (station.phone || 'N/A') + ' | Fax: ' + (station.other_phone || 'N/A'));
        $('#station-email').text('Email: ' + (station.email || 'N/A'));

        $('#invoice-customer-info').html(
            '<p class="mb-1"><strong>Customer Name:</strong> ' + jc.first_name + ' ' + jc.last_name + '</p>' +
            '<p class="mb-1"><strong>Phone:</strong> +94 ' + removeLeadingZeros(jc.phone) + '</p>' +
            '<p class="mb-1"><strong>Address:</strong> ' + (jc.address || 'N/A') + '</p>'
        );
        $('#invoice-vehicle-info').html(
            '<p class="mb-1"><strong>Vehicle Number:</strong> ' + jc.vehicle_number + '</p>' +
            '<p class="mb-1"><strong>Make & Model:</strong> ' + jc.vehicle_make_name + ' ' + jc.vehicle_model_name + '</p>' +
            '<p class="mb-1"><strong>Chassis Number:</strong> ' + (jc.chassis_number || 'N/A') + '</p>' +
            '<p class="mb-1"><strong>Engine Number:</strong> ' + (jc.engine_number || 'N/A') + '</p>'
        );
        $('#invoice-code').text(invoiceCode);
        $('#invoice-date').text(new Date().toLocaleDateString());
        $('#invoice-mileage').text(current_mileage + ' KM');

        generateInvoiceItems();
        calculateInvoiceTotal();
    }

    function generateInvoiceItems() {
        var html = '';

        items.forEach(function (item) {
            if (!item.quantityInput) return;
            var qty = parseFloat($(item.quantityInput).val()) || 0;
            var price = parseFloat($(item.priceInput).val()) || 0;
            var discount = parseFloat($(item.discountInput).val()) || 0;
            if (qty > 0) {
                var amount = qty * price, total = amount - discount;
                html += '<tr><td>' + $(item.rowCode).text() + '</td><td>Wash Service</td><td>' + qty + '</td><td>' + price.toFixed(2) + '</td><td>' + amount.toFixed(2) + '</td><td>' + discount.toFixed(2) + '</td><td>' + total.toFixed(2) + '</td></tr>';
            }
        });

        selected_fuel.forEach(function (fuel) {
            html += '<tr><td>' + fuel.ServicePackageCode + '</td><td>Fuel — Service Package</td><td>1</td><td>' + fuel.price.toFixed(2) + '</td><td>' + fuel.price.toFixed(2) + '</td><td>0.00</td><td>' + fuel.price.toFixed(2) + '</td></tr>';
        });
        selected_filter.forEach(function (filter) {
            html += '<tr><td>' + filter.ServicePackageCode + '</td><td>Filter — Service Package</td><td>1</td><td>' + filter.price.toFixed(2) + '</td><td>' + filter.price.toFixed(2) + '</td><td>0.00</td><td>' + filter.price.toFixed(2) + '</td></tr>';
        });

        repair_items.forEach(function (item) {
            if (!item.HoursInput) return;
            var hours = parseFloat($(item.HoursInput).val()) || 0;
            var price = parseFloat($(item.UnitPriceInput).val()) || 0;
            var discount = parseFloat($(item.discountInput).val()) || 0;
            if (hours > 0) {
                var amount = hours * price, total = amount - discount;
                html += '<tr><td>' + $(item.rowCode).text() + '</td><td>' + $(item.rowName).text() + '</td><td>' + hours + '</td><td>' + price.toFixed(2) + '</td><td>' + amount.toFixed(2) + '</td><td>' + discount.toFixed(2) + '</td><td>' + total.toFixed(2) + '</td></tr>';
            }
        });

        products_items.forEach(function (item) {
            if (!item.quantityInput) return;
            var qty = parseFloat($(item.quantityInput).val()) || 0;
            var price = parseFloat($(item.priceInput).val()) || 0;
            var discount = parseFloat($(item.discountInput).val()) || 0;
            if (qty > 0) {
                var amount = qty * price, total = amount - discount;
                html += '<tr><td>' + $(item.rowCode).text() + '</td><td>' + $(item.rowName).text() + '</td><td>' + qty + '</td><td>' + price.toFixed(2) + '</td><td>' + amount.toFixed(2) + '</td><td>' + discount.toFixed(2) + '</td><td>' + total.toFixed(2) + '</td></tr>';
            }
        });

        if (!html) html = '<tr><td colspan="7" class="text-center text-muted">No items added</td></tr>';
        $('#invoice-items-tbody').html(html);
    }

    function calculateInvoiceTotal() {
        var subtotal = 0;
        items.forEach(function (item) {
            if (!item.quantityInput) return;
            subtotal += (parseFloat($(item.quantityInput).val()) || 0) * (parseFloat($(item.priceInput).val()) || 0) - (parseFloat($(item.discountInput).val()) || 0);
        });
        selected_fuel.forEach(function (f)   { subtotal += f.price; });
        selected_filter.forEach(function (f) { subtotal += f.price; });
        repair_items.forEach(function (item) {
            subtotal += (parseFloat($(item.HoursInput).val()) || 0) * (parseFloat($(item.UnitPriceInput).val()) || 0) - (parseFloat($(item.discountInput).val()) || 0);
        });
        products_items.forEach(function (item) {
            subtotal += (parseFloat($(item.quantityInput).val()) || 0) * (parseFloat($(item.priceInput).val()) || 0) - (parseFloat($(item.discountInput).val()) || 0);
        });
        var vatRate = parseFloat($('#in_vat_input').val()) || 0;
        var grandTotal = subtotal + (subtotal * vatRate / 100);
        $('#invoice-subtotal').text(subtotal.toFixed(2));
        $('#invoice-grand-total').text(grandTotal.toFixed(2));
    }

    $(document).on('input', '#in_vat_input', calculateInvoiceTotal);

    // ==========================================
    // 10. STEP NAVIGATION
    // ==========================================
    $(document).on('click', 'button', function (e) {
        if ($(this).text().trim() === 'Previous' || $(this).attr('onclick') === 'stepper.previous()') {
            e.preventDefault(); e.stopPropagation();
            var currentStep = 1;
            if ($('#generate-invoice-part').is(':visible'))    currentStep = 7;
            else if ($('#select-products-part').is(':visible')) currentStep = 6;
            else if ($('#maintenance-part').is(':visible'))    currentStep = 5;
            else if ($('#service-package-part').is(':visible')) currentStep = 4;
            else if ($('#washer-part').is(':visible'))         currentStep = 3;
            else if ($('#vehicle-report-part').is(':visible')) currentStep = 2;
            if (currentStep > 1) { window.stepper.to(currentStep - 1); window.showStepContent(currentStep - 1); }
        }
    });

    $('#job-card-step-1').on('click', function () {
        current_mileage = parseInt($('#current-mileage').val());
        new_mileage     = parseInt($('#new-mileage').val());
        paid_status     = $('#cmbpaidstatus').val();
        status          = $('#cmbstatus').val();
        notify          = $('input[name="customRadio"]:checked').val();

        if (!current_mileage || current_mileage <= 0) { Swal.fire({ icon: 'warning', title: 'Validation Error', text: 'Please enter current mileage' }); return; }
        if (!new_mileage || new_mileage <= 0)         { Swal.fire({ icon: 'warning', title: 'Validation Error', text: 'Please enter next service mileage' }); return; }
        if (!paid_status)                              { Swal.fire({ icon: 'warning', title: 'Validation Error', text: 'Please select paid status' }); return; }
        if (!status)                                   { Swal.fire({ icon: 'warning', title: 'Validation Error', text: 'Please select status' }); return; }

        window.stepper.to(2); window.showStepContent(2);
    });

    $('#job-card-step-2').on('click', function () { collectVehicleReportData(); window.stepper.to(3); window.showStepContent(3); });
    $('#job-card-step-3').on('click', function () { window.stepper.to(4); window.showStepContent(4); });
    $('#job-card-step-4').on('click', function () { window.stepper.to(5); window.showStepContent(5); });
    $('#job-card-step-5').on('click', function () { window.stepper.to(6); window.showStepContent(6); });
    $('#job-card-step-6').on('click', function () {
        try { generateInvoiceItems(); calculateInvoiceTotal(); } catch (e) { console.error('Invoice gen error', e); }
        window.stepper.to(7); window.showStepContent(7);
    });

    $('.step-trigger').on('click', function () {
        setTimeout(function () { window.showStepContent($('.step.active').index() + 1); }, 100);
    });

    // ==========================================
    // 11. SUBMIT — UPDATE JOB CARD
    // ==========================================
    $('#submit_update_jobcard').on('click', function () {
        current_mileage = parseInt($('#current-mileage').val());
        if (!current_mileage || current_mileage <= 0) {
            Swal.fire({ icon: 'warning', title: 'Validation Error', text: 'Please enter current mileage' });
            window.stepper.to(1); window.showStepContent(1); return;
        }

        var jobCardData = {
            job_card_id     : jobCardId,
            vehicle_id      : vehicle[0].vehicle_id,
            current_mileage : current_mileage,
            new_mileage     : parseInt($('#new-mileage').val()),
            paid_status     : $('#cmbpaidstatus').val(),
            job_card_type   : job_card_type,
            status          : $('#cmbstatus').val(),
            notify          : $('input[name="customRadio"]:checked').val(),
            invoice_code    : invoiceCode,
            vat             : parseFloat($('#in_vat_input').val()) || 0,
            vehicle_reports : rowVehicleReportData,
            washers         : WasherValues,
            service_packages: selected_service_packages,
            fuels           : selected_fuel,
            filters         : selected_filter,
            repairs         : [],
            products        : []
        };

        repair_items.forEach(function (item) {
            var hours = parseFloat($(item.HoursInput).val()) || 0;
            if (hours > 0) {
                jobCardData.repairs.push({
                    repair_id  : $(item.rowID).text(),
                    code       : $(item.rowCode).text(),
                    name       : $(item.rowName).text(),
                    hours      : hours,
                    unit_price : parseFloat($(item.UnitPriceInput).val()) || 0,
                    discount   : parseFloat($(item.discountInput).val())  || 0
                });
            }
        });

        products_items.forEach(function (item) {
            var qty = parseFloat($(item.quantityInput).val()) || 0;
            if (qty > 0) {
                jobCardData.products.push({
                    product_id : $(item.rowID).text(),
                    code       : $(item.rowCode).text(),
                    name       : $(item.rowName).text(),
                    qty        : qty,
                    price      : parseFloat($(item.priceInput).val())    || 0,
                    discount   : parseFloat($(item.discountInput).val()) || 0
                });
            }
        });

        $('#submit_update_jobcard').hide();
        $('#btn-loading').show();

        $.ajax({
            type        : 'POST',
            url         : '../api/update-jobcard.php',
            data        : JSON.stringify(jobCardData),
            contentType : 'application/json',
            dataType    : 'json',
            success: function (response) {
                $('#btn-loading').hide(); $('#submit_update_jobcard').show();
                if (response.success) {
                    Swal.fire({ icon: 'success', title: 'Success!', text: 'Job card updated successfully', timer: 3000 })
                        .then(function () { window.location.href = '../job-cards/'; });
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: response.message || 'Failed to update job card' });
                }
            },
            error: function (xhr) {
                $('#btn-loading').hide(); $('#submit_update_jobcard').show();
                var msg = xhr.responseText ? xhr.responseText.replace(/<[^>]*>?/gm, '').substring(0, 300) : 'Check console (F12) for details.';
                Swal.fire({ icon: 'error', title: 'Server Error: ' + xhr.status, text: msg });
            }
        });
    });

    // ==========================================
    // 12. UTILITIES
    // ==========================================
    function removeLeadingZeros(phoneNumber) { return (phoneNumber || '').replace(/^0+/, ''); }
    function generateUUID() { return 'INV-' + Date.now() + '-' + Math.floor(Math.random() * 10000); }
});