$(document).ready(function () {
    console.log("Edit Job Card Script Loaded");
    
    // ==========================================
    // 1. GLOBAL HELPER FUNCTION (Must be at top)
    // ==========================================
    window.showStepContent = function(stepIndex) {
        // 1. Hide all content parts
        $('.bs-stepper-content .content').removeClass('active dstepper-block').hide();

        // 2. Select the specific content div (stepIndex - 1 because eq is 0-indexed)
        var targetContent = $('.bs-stepper-content .content').eq(stepIndex - 1);

        // 3. Show the target content
        if (targetContent.length) {
            targetContent.addClass('active dstepper-block').show();
            targetContent.css('display', 'block'); 
        }
    };

    // ==========================================
    // 2. INITIALIZE STEPPER
    // ==========================================
    var stepperElement = document.querySelector('.bs-stepper');
    if (stepperElement) {
        window.stepper = new Stepper(stepperElement, {
            linear: false,
            animation: false // FIXED: Set to false to prevent layout gaps
        });
        console.log("Stepper initialized");
        
        // Force show first step
        setTimeout(() => {
            if (window.stepper) {
                window.stepper.to(1);
            }
            window.showStepContent(1);
            
            const firstStep = document.querySelector('.step[data-target="#search-vehicle-part"]');
            if (firstStep) {
                firstStep.classList.add('active');
            }
        }, 200);
    }

    // Get job card code from URL
    const urlParams = new URLSearchParams(window.location.search);
    const jobCardCode = urlParams.get('code');

    // Global variables
    let vehicle = [];
    let current_mileage = 0;
    let new_mileage = 0;
    let paid_status = "";
    let job_card_type = "";
    let status = "";
    let notify = "";
    let jobCardId = 0;
    let invoiceCode = "";
    let serviceStationInfo = [];

    let rowVehicleReportData = [];
    let items = [];
    let WasherValues = [];
    let selected_service_packages = [];
    let selected_fuel = [];
    let selected_filter = [];
    let repair_items = [];
    let selected_repairs = [];
    let products_items = [];
    let selected_products = [];

    console.log("Job Card Code:", jobCardCode);

    // Check for job card code
    if (!jobCardCode) {
        Swal.fire({
            icon: "warning",
            title: "No Job Card Code",
            text: "Please provide a job card code in the URL",
        }).then(() => {
            window.location.href = "../job-cards/";
        });
        return;
    }

    // Load job card data
    loadJobCardData(jobCardCode);

    // ============================================
    // FUNCTION DEFINITIONS
    // ============================================

    function loadJobCardData(code) {
        console.log("Loading job card data for:", code);
        
        $.ajax({
            type: "POST",
            url: "../api/get-jobcard-data.php",
            data: { code: code },
            dataType: "json",
            beforeSend: function() {
                $('#search-vehicle-content').html(`
                    <div class="d-flex justify-content-center my-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                `);
            },
            success: function (data) {
                console.log("Loaded job card data:", data);
                
                if (data.success) {
                    setTimeout(() => {
                        populateExistingData(data);
                    }, 100);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Job card not found",
                    }).then(() => {
                        window.location.href = "../job-cards/";
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Failed to load job card data",
                });
            }
        });
    }

    function populateExistingData(data) {
        const jc = data.job_card;
        
        // Store essential data
        jobCardId = jc.id;
        invoiceCode = jc.invoice_code || generateUUID();
        
        vehicle = [{
            vehicle_id: jc.vehicle_id,
            vehicle_number: jc.vehicle_number,
            chassis_number: jc.chassis_number,
            engine_number: jc.engine_number,
            vehicle_class_id: jc.vehicle_class_id,
            vehicle_color: jc.vehicle_color,
            vehicle_model_id: jc.vehicle_model_id,
            vehicle_owner_id: jc.vehicle_owner_id,
            first_name: jc.first_name,
            last_name: jc.last_name,
            phone: jc.phone,
            address: jc.address,
            vehicle_model_name: jc.vehicle_model_name,
            vehicle_make_name: jc.vehicle_make_name,
            current_mileage: jc.current_mileage
        }];

        serviceStationInfo = data.station;
        current_mileage = jc.job_mileage || 0;
        new_mileage = jc.next_mileage || 0;
        paid_status = jc.paid_status_id;
        job_card_type = jc.job_card_type_id;
        status = jc.status_id;
        notify = jc.notify_month || 2;

        // Populate all steps in sequence
        populateVehicleInfo(data);
        populateVehicleReports(data.reports);
        populateWashers(data.washers);
        populateServicePackages(data.fuels, data.filters);
        populateRepairs(data.repairs);
        populateProducts(data.products);
        
        // Wait for DOM updates before invoice
        setTimeout(() => {
            getInvoiceDetails(vehicle, serviceStationInfo);
        }, 200);
    }

    function populateVehicleInfo(data) {
        const jc = data.job_card;
        
        const vehicleImages = {
            1: "../assets/img/vehicle-img/light_motor_cycle.jpg",
            2: "../assets/img/vehicle-img/motor_cycles.jpg",
            3: "../assets/img/vehicle-img/three_wheeler.jpg",
            4: "../assets/img/vehicle-img/van.jpg",
            5: "../assets/img/vehicle-img/car.jpg",
            6: "../assets/img/vehicle-img/Light_Motor_Lorry.jpg",
            7: "../assets/img/vehicle-img/motor_lorry.jpg",
            8: "../assets/img/vehicle-img/Heavy_Motor_Lorry.jpg",
            9: "../assets/img/vehicle-img/light_bus.jpg",
            10: "../assets/img/vehicle-img/Hand_Tractors.jpg",
            11: "../assets/img/vehicle-img/Land_Vehicle.jpg",
            12: "../assets/img/vehicle-img/Special_purpose_Vehicle.jpg"
        };

        let vehicleImage = vehicleImages[jc.vehicle_class_id] || "../assets/img/vehicle-img/car.jpg";

        const htmlContent = `
            <div class="row my-4">
                <div class="col-md-5 mx-auto">
                    <div class="card p-3 py-4 border border-dark text-center">
                        <div class="mx-auto my-2">
                            <img src="${vehicleImage}" style="width: 80px; height: 80px; border-radius: 50%;object-fit: cover;" alt="Vehicle" />
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <span class="m-0 p-0 d-flex align-items-center text-secondary mr-2">
                                    <span class="mr-1">Color: </span>
                                    <div class="border" style="width:15px;height:15px;background-color:${jc.vehicle_color};border-radius:50%"></div>
                                </span>
                                <span class="h4 m-0 p-0"><b>${jc.vehicle_number}</b></span>
                            </div>
                            <p class="m-0 p-0 text-secondary mt-2">${jc.first_name} ${jc.last_name}</p>
                            <p class="m-0 p-0 text-secondary">+94 ${removeLeadingZeros(jc.phone)}</p>
                            <p class="m-0 p-0 text-secondary">Previous Mileage: ${jc.current_mileage || 0} KM</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mx-auto">
                    <div class="form-group">
                        <label for="current-mileage">Current Mileage (KM) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="current-mileage" placeholder="Current Mileage" value="${current_mileage}">
                    </div>
                </div>
                <div class="col-md-4 mx-auto">
                    <div class="form-group">
                        <label for="new-mileage">Next Service Mileage (KM) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="new-mileage" placeholder="Next Mileage" value="${new_mileage}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Paid Status <span class="text-danger">*</span></label>
                        <select id="cmbpaidstatus" class="custom-select">
                            <option value="" disabled>Please Select</option>
                            ${data.cmbpaidstatus.map(state => 
                                `<option value="${state.id}" ${state.id == paid_status ? 'selected' : ''}>${state.status}</option>`
                            ).join('')}
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Job Card Type <span class="text-danger">*</span></label>
                        <select id="cmbjobcardtype" class="custom-select" disabled>
                            <option value="" disabled>Please Select</option> 
                            ${data.cmbjobtypes.map(state => 
                                `<option value="${state.id}" ${state.id == job_card_type ? 'selected' : ''}>${state.type}</option>`
                            ).join('')}
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select id="cmbstatus" class="custom-select">
                            <option value="" disabled>Please Select</option> 
                            ${data.cmbstatus.map(state => 
                                `<option value="${state.id}" ${state.id == status ? 'selected' : ''}>${state.status}</option>`
                            ).join('')}
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 mx-auto">
                    <label>Notify Customer For Next Service <span class="text-danger">*</span></label>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="custom-control custom-radio">
                                <input value="2" class="custom-control-input" type="radio" id="customRadio2" name="customRadio" ${notify == 2 ? 'checked' : ''}>
                                <label for="customRadio2" class="custom-control-label">In 2 Months</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="custom-control custom-radio">
                                <input value="4" class="custom-control-input" type="radio" id="customRadio4" name="customRadio" ${notify == 4 ? 'checked' : ''}>
                                <label for="customRadio4" class="custom-control-label">In 4 Months</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="custom-control custom-radio">
                                <input value="6" class="custom-control-input" type="radio" id="customRadio6" name="customRadio" ${notify == 6 ? 'checked' : ''}>
                                <label for="customRadio6" class="custom-control-label">In 6 Months</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        $('#search-vehicle-content').html(htmlContent);
        $('#search-vehicle-content').show().css('display', 'block');
    }

    function populateVehicleReports(reports) {
        if (!reports || reports.length === 0) {
            if (job_card_type == "6" || job_card_type == "3" || job_card_type == "5") {
                $.ajax({
                    type: "POST",
                    url: "../api/getvehiclereport.php",
                    dataType: "json",
                    success: function (data) {
                        populateVehicleReportContent(data, []);
                    },
                    error: function() {
                        $('#vehicle-report-tables').html(`<p class="text-center text-danger">Failed to load vehicle report template</p>`);
                    }
                });
            } else {
                $('#vehicle-report-tables').html(`<p class="text-center text-muted">Vehicle reports not available for this job card type.</p>`);
            }
            return;
        }

        $.ajax({
            type: "POST",
            url: "../api/getvehiclereport.php",
            dataType: "json",
            success: function (data) {
                populateVehicleReportContent(data, reports);
            }
        });
    }

    function populateVehicleReportContent(data, existingReports) {
        const tablesHTML = data.vehicle_category.map(category => `
            <div class="col-md-10 table-responsive p-0 mx-auto my-2">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width: 30%">${category.category}</th>
                            <th class="text-center">Worse</th>
                            <th class="text-center">Bad</th>
                            <th class="text-center">Ok</th>
                            <th class="text-center">Good</th>
                            <th class="text-center">Perfect</th>
                        </tr>
                    </thead>
                    <tbody>
                    ${data.vehicle_subcategory
                        .filter(sub => sub.vehicle_condition_category_id === category.id)
                        .map(sub => {
                            const existing = existingReports.find(r => r.sub_category_id == sub.id);
                            const selectedValue = existing ? existing.value_id : null;
                            
                            return `
                                <tr data-category-id="${category.id}" data-subcategory-id="${sub.id}">
                                    <td>${sub.sub_category}</td>
                                    <td class="text-center">
                                        <input value="1" class="form-check-input" type="radio" 
                                            name="radio${sub.id}" ${selectedValue == 1 ? 'checked' : ''}>
                                    </td>
                                    <td class="text-center">
                                        <input value="2" class="form-check-input" type="radio" 
                                            name="radio${sub.id}" ${selectedValue == 2 ? 'checked' : ''}>
                                    </td>
                                    <td class="text-center">
                                        <input value="3" class="form-check-input" type="radio" 
                                            name="radio${sub.id}" ${selectedValue == 3 ? 'checked' : ''}>
                                    </td>
                                    <td class="text-center">
                                        <input value="4" class="form-check-input" type="radio" 
                                            name="radio${sub.id}" ${selectedValue == 4 ? 'checked' : ''}>
                                    </td>
                                    <td class="text-center">
                                        <input value="5" class="form-check-input" type="radio" 
                                            name="radio${sub.id}" ${selectedValue == 5 ? 'checked' : ''}>
                                    </td>
                                </tr>
                            `;
                        }).join('')}
                    </tbody>
                </table>
            </div>
        `).join('');
        
        $('#vehicle-report-tables').html(tablesHTML);
        collectVehicleReportData();
        $('#vehicle-report-tables input[type="radio"]').on('change', collectVehicleReportData);
    }

    function collectVehicleReportData() {
        rowVehicleReportData = [];
        $('#vehicle-report-tables tr[data-category-id]').each(function() {
            const categoryId = $(this).data('category-id');
            const subcategoryId = $(this).data('subcategory-id');
            const selectedRadio = $(this).find('input[type="radio"]:checked');
            
            if (selectedRadio.length > 0) {
                rowVehicleReportData.push({
                    categoryId: categoryId,
                    subcategoryId: subcategoryId,
                    value: parseInt(selectedRadio.val())
                });
            }
        });
    }

    function populateWashers(washers) {
        if (!washers || washers.length === 0) {
            $('#table-jobcard-washer tbody').html(`
                <tr><td colspan="8" class="text-center text-muted">No washers added</td></tr>
            `);
            items = [];
            return;
        }

        const washer = washers[0];
        const row = $(`
            <tr class="rowBody">
                <td style='display:none;' class='rowID'>${washer.washer_id}</td>
                <td style='display:none;' class='rowCode'>${washer.code}</td>
                <td>1</td>
                <td>Wash (${washer.code})</td>
                <td><input value="${washer.qty}" type="number" class="form-control wash-qty" min="0" step="1"></td>
                <td><input value="${washer.price}" type="number" class="form-control wash-unit-price" min="0" step="0.01"></td>
                <td><input value="${washer.discount}" type="number" class="form-control wash-discount" min="0" step="0.01"></td>
                <td><p class="h6 font-weight-bold wash-total">0.00</p></td>
            </tr>
        `);

        $('#table-jobcard-washer tbody').html(row);

        const item = {
            rowCode: row.find(".rowCode")[0],
            rowID: row.find(".rowID")[0],
            quantityInput: row.find(".wash-qty")[0],
            priceInput: row.find(".wash-unit-price")[0],
            discountInput: row.find(".wash-discount")[0],
            totalCell: row.find(".wash-total")[0],
        };
        
        items = [item];

        $(item.quantityInput).on('input', calculateWasherTotal);
        $(item.priceInput).on('input', calculateWasherTotal);
        $(item.discountInput).on('input', calculateWasherTotal);

        calculateWasherTotal();
    }

    function populateServicePackages(fuels, filters) {
        if ((!fuels || fuels.length === 0) && (!filters || filters.length === 0)) {
            $('#table-service-packages tbody').html(`
                <tr><td colspan="3" class="text-center text-muted">No service packages added</td></tr>
            `);
            return;
        }

        selected_fuel = [];
        selected_filter = [];
        selected_service_packages = [];

        const packageMap = {};
        
        if (fuels) {
            fuels.forEach(f => {
                if (!packageMap[f.service_package_id]) {
                    packageMap[f.service_package_id] = { 
                        id: f.service_package_id,
                        fuels: [], 
                        filters: [] 
                    };
                }
                packageMap[f.service_package_id].fuels.push({
                    id: f.fuel_type_id,
                    name: f.fuel_name,
                    price: parseFloat(f.price)
                });
                
                selected_fuel.push({
                    ServicePackageId: f.service_package_id,
                    ServicePackageName: `Service Package`,
                    ServicePackageCode: `SP-${f.service_package_id}`,
                    price: parseFloat(f.price),
                    typeId: f.fuel_type_id
                });
            });
        }

        if (filters) {
            filters.forEach(f => {
                if (!packageMap[f.service_package_id]) {
                    packageMap[f.service_package_id] = { 
                        id: f.service_package_id,
                        fuels: [], 
                        filters: [] 
                    };
                }
                packageMap[f.service_package_id].filters.push({
                    id: f.filter_type_id,
                    name: f.filter_name,
                    price: parseFloat(f.price)
                });
                
                selected_filter.push({
                    ServicePackageId: f.service_package_id,
                    ServicePackageName: `Service Package`,
                    ServicePackageCode: `SP-${f.service_package_id}`,
                    price: parseFloat(f.price),
                    typeId: f.filter_type_id
                });
            });
        }

        let html = '';
        let index = 1;
        Object.keys(packageMap).forEach(pkgId => {
            const pkg = packageMap[pkgId];
            let total = 0;
            let itemsList = [];
            
            pkg.fuels.forEach(f => {
                itemsList.push(f.name);
                total += f.price;
            });
            
            pkg.filters.forEach(f => {
                itemsList.push(f.name);
                total += f.price;
            });
            
            html += `
                <tr>
                    <td>${index++}</td>
                    <td>Service Package #${pkgId}<br><small class="text-muted">${itemsList.join(', ')}</small></td>
                    <td><strong>LKR ${total.toFixed(2)}</strong></td>
                </tr>
            `;
            
            selected_service_packages.push({ id: pkgId });
        });

        $('#table-service-packages tbody').html(html);
        calculateServicePackageTotal();
    }

    function populateRepairs(repairs) {
        repair_items = [];
        selected_repairs = [];
        
        if (!repairs || repairs.length === 0) {
            $('#table-jobcard-repair tbody').html(`
                <tr><td colspan="10" class="text-center text-muted">No repairs added</td></tr>
            `);
            return;
        }

        repairs.forEach((repair, index) => {
            const row = $(`
                <tr>
                    <td class='rowID' style='display:none;'>${repair.repair_id}</td>
                    <td class='rowCode' style='display:none;'>${repair.code}</td>
                    <td class='rowName' style='display:none;'>${repair.name}</td>
                    <td>${index + 1}</td>
                    <td>${repair.name}</td>
                    <td><input value="${repair.hours}" type="number" class="form-control hours" min="0" step="0.5"></td>
                    <td><input value="${repair.unit_price}" type="number" class="form-control unit-price" min="0" step="0.01"></td>
                    <td><input value="${repair.discount}" type="number" class="form-control discount" min="0" step="0.01"></td>
                    <td><p class="h6 repair-total">0.00</p></td>
                    <td><button data-id="${repair.repair_id}" type="button" class="btn btn-sm bg-gradient-danger deleteRepairItem">
                        <i class="fas fa-trash"></i></button></td>
                </tr>
            `);
            
            $("#table-jobcard-repair tbody").append(row);

            const item = {
                rowCode: row.find(".rowCode")[0],
                rowName: row.find(".rowName")[0],
                rowID: row.find(".rowID")[0],
                HoursInput: row.find(".hours")[0],
                UnitPriceInput: row.find(".unit-price")[0],
                discountInput: row.find(".discount")[0],
                totalCell: row.find(".repair-total")[0],
            };
            
            repair_items.push(item);

            $(item.HoursInput).on("input", calculateRepairTotal);
            $(item.UnitPriceInput).on("input", calculateRepairTotal);
            $(item.discountInput).on("input", calculateRepairTotal);

            selected_repairs.push({ id: repair.repair_id });
        });

        calculateRepairTotal();
    }

    function populateProducts(products) {
        products_items = [];
        selected_products = [];
        
        if (!products || products.length === 0) {
            $('#table-jobcard-products tbody').html(`
                <tr><td colspan="10" class="text-center text-muted">No products added</td></tr>
            `);
            return;
        }

        products.forEach((product, index) => {
            const row = $(`
                <tr>
                    <td class='rowProductID' style='display:none;'>${product.product_id}</td>
                    <td class='rowProductCode' style='display:none;'>${product.code}</td>
                    <td class='rowProductName' style='display:none;'>${product.product_name}</td>
                    <td>${index + 1}</td>
                    <td>${product.product_name}</td>
                    <td><input value="${product.qty}" type="number" class="form-control quantityQty" min="0" step="1"></td>
                    <td><input value="${product.price}" type="number" class="form-control unitPriceProduct" min="0" step="0.01"></td>
                    <td><input value="${product.discount}" type="number" class="form-control discountProduct" min="0" step="0.01"></td>
                    <td><p class="h6 totalProduct">0.00</p></td>
                    <td><button data-id="${product.product_id}" type="button" class="btn btn-sm bg-gradient-danger deleteProductsItem">
                        <i class="fas fa-trash"></i></button></td>
                </tr>
            `);
            
            $("#table-jobcard-products tbody").append(row);

            const item = {
                rowID: row.find(".rowProductID")[0],
                rowCode: row.find(".rowProductCode")[0],
                rowName: row.find(".rowProductName")[0],
                quantityInput: row.find(".quantityQty")[0],
                priceInput: row.find(".unitPriceProduct")[0],
                discountInput: row.find(".discountProduct")[0],
                totalCell: row.find(".totalProduct")[0],
            };
            
            products_items.push(item);

            $(item.quantityInput).on("input", calculateProductTotal);
            $(item.priceInput).on("input", calculateProductTotal);
            $(item.discountInput).on("input", calculateProductTotal);

            selected_products.push({ id: product.product_id });
        });

        calculateProductTotal();
    }

    function getInvoiceDetails(vehicleData, stationData) {
        if (!vehicleData || vehicleData.length === 0 || !stationData || stationData.length === 0) {
            return;
        }

        const jc = vehicleData[0];
        const station = stationData[0];

        $("#station-logo").attr('src', station.logo ? `../uploads/stations/${station.logo}` : '../dist/img/system/logo_pistona.png');
        $("#station-name").text(station.service_name || 'Station Name');
        $("#station-address").text([station.address, station.street, station.city].filter(Boolean).join(', ') || 'Station Address');
        $("#station-contact").text(`Tel: ${station.phone || 'N/A'} | Fax: ${station.other_phone || 'N/A'}`);
        $("#station-email").text(`Email: ${station.email || 'N/A'}`);

        $("#invoice-customer-info").html(`
            <p class="mb-1"><strong>Customer Name:</strong> ${jc.first_name} ${jc.last_name}</p>
            <p class="mb-1"><strong>Phone:</strong> +94 ${removeLeadingZeros(jc.phone)}</p>
            <p class="mb-1"><strong>Address:</strong> ${jc.address || 'N/A'}</p>
        `);

        $("#invoice-vehicle-info").html(`
            <p class="mb-1"><strong>Vehicle Number:</strong> ${jc.vehicle_number}</p>
            <p class="mb-1"><strong>Make & Model:</strong> ${jc.vehicle_make_name} ${jc.vehicle_model_name}</p>
            <p class="mb-1"><strong>Chassis Number:</strong> ${jc.chassis_number || 'N/A'}</p>
            <p class="mb-1"><strong>Engine Number:</strong> ${jc.engine_number || 'N/A'}</p>
        `);

        $("#invoice-code").text(invoiceCode);
        $("#invoice-date").text(new Date().toLocaleDateString());
        $("#invoice-mileage").text(`${current_mileage} KM`);

        generateInvoiceItems();
        calculateInvoiceTotal();
    }

    // FIXED: Safe version of generateInvoiceItems
    function generateInvoiceItems() {
        let html = '';

        // Safety checks for undefined arrays
        const safeItems = (typeof items !== 'undefined' && Array.isArray(items)) ? items : [];
        const safeFuels = (typeof selected_fuel !== 'undefined' && Array.isArray(selected_fuel)) ? selected_fuel : [];
        const safeFilters = (typeof selected_filter !== 'undefined' && Array.isArray(selected_filter)) ? selected_filter : [];
        const safeRepairs = (typeof repair_items !== 'undefined' && Array.isArray(repair_items)) ? repair_items : [];
        const safeProducts = (typeof products_items !== 'undefined' && Array.isArray(products_items)) ? products_items : [];

        // Add Washers
        safeItems.forEach(item => {
            if(!item.quantityInput) return;
            
            const qty = parseFloat($(item.quantityInput).val()) || 0;
            const price = parseFloat($(item.priceInput).val()) || 0;
            const discount = parseFloat($(item.discountInput).val()) || 0;
            
            if (qty > 0) {
                const amount = qty * price;
                const total = amount - discount;
                html += `<tr>
                            <td>${$(item.rowCode).text()}</td>
                            <td>Wash Service</td>
                            <td>${qty}</td>
                            <td>${price.toFixed(2)}</td>
                            <td>${amount.toFixed(2)}</td>
                            <td>${discount.toFixed(2)}</td>
                            <td>${total.toFixed(2)}</td>
                        </tr>`;
            }
        });

        // Add Service Packages
        safeFuels.forEach(fuel => {
            html += `<tr>
                        <td>${fuel.ServicePackageCode}</td>
                        <td>Fuel - Service Package</td>
                        <td>1</td>
                        <td>${fuel.price.toFixed(2)}</td>
                        <td>${fuel.price.toFixed(2)}</td>
                        <td>0.00</td>
                        <td>${fuel.price.toFixed(2)}</td>
                    </tr>`;
        });

        safeFilters.forEach(filter => {
            html += `<tr>
                        <td>${filter.ServicePackageCode}</td>
                        <td>Filter - Service Package</td>
                        <td>1</td>
                        <td>${filter.price.toFixed(2)}</td>
                        <td>${filter.price.toFixed(2)}</td>
                        <td>0.00</td>
                        <td>${filter.price.toFixed(2)}</td>
                    </tr>`;
        });

        // Add Repairs
        safeRepairs.forEach(item => {
            if(!item.HoursInput) return;

            const hours = parseFloat($(item.HoursInput).val()) || 0;
            const price = parseFloat($(item.UnitPriceInput).val()) || 0;
            const discount = parseFloat($(item.discountInput).val()) || 0;

            if (hours > 0) {
                const amount = hours * price;
                const total = amount - discount;
                html += `<tr>
                            <td>${$(item.rowCode).text()}</td>
                            <td>${$(item.rowName).text()}</td>
                            <td>${hours}</td>
                            <td>${price.toFixed(2)}</td>
                            <td>${amount.toFixed(2)}</td>
                            <td>${discount.toFixed(2)}</td>
                            <td>${total.toFixed(2)}</td>
                        </tr>`;
            }
        });

        // Add Products
        safeProducts.forEach(item => {
            if(!item.quantityInput) return;

            const qty = parseFloat($(item.quantityInput).val()) || 0;
            const price = parseFloat($(item.priceInput).val()) || 0;
            const discount = parseFloat($(item.discountInput).val()) || 0;

            if (qty > 0) {
                const amount = qty * price;
                const total = amount - discount;
                html += `<tr>
                            <td>${$(item.rowCode).text()}</td>
                            <td>${$(item.rowName).text()}</td>
                            <td>${qty}</td>
                            <td>${price.toFixed(2)}</td>
                            <td>${amount.toFixed(2)}</td>
                            <td>${discount.toFixed(2)}</td>
                            <td>${total.toFixed(2)}</td>
                        </tr>`;
            }
        });

        if (html === '') {
            html = '<tr><td colspan="7" class="text-center text-muted">No items added</td></tr>';
        }

        $('#invoice-items-tbody').html(html);
    }

    function calculateWasherTotal() {
        WasherValues = [];
        let grandTotal = 0;
        
        if (typeof items !== 'undefined' && Array.isArray(items)) {
            items.forEach(item => {
                if(!item.quantityInput) return;
                const qty = parseFloat($(item.quantityInput).val()) || 0;
                const price = parseFloat($(item.priceInput).val()) || 0;
                const discount = parseFloat($(item.discountInput).val()) || 0;
                const amount = qty * price;
                const total = amount - discount;

                $(item.totalCell).text(total.toFixed(2));
                grandTotal += total;

                if (qty > 0) {
                    WasherValues.push({
                        washerID: $(item.rowID).text(),
                        code: $(item.rowCode).text(),
                        qty: qty,
                        price: price,
                        discount: discount,
                        total: total
                    });
                }
            });
        }
        $("#washer-grand-total").text(grandTotal.toFixed(2));
        calculateInvoiceTotal();
    }

    function calculateServicePackageTotal() {
        let grandTotal = 0;
        if(selected_fuel) selected_fuel.forEach(fuel => grandTotal += fuel.price);
        if(selected_filter) selected_filter.forEach(filter => grandTotal += filter.price);
        $("#service-package-grand-total").text(grandTotal.toFixed(2));
        calculateInvoiceTotal();
    }

    function calculateRepairTotal() {
        let grandTotal = 0;
        if (typeof repair_items !== 'undefined' && Array.isArray(repair_items)) {
            repair_items.forEach(item => {
                const hours = parseFloat($(item.HoursInput).val()) || 0;
                const price = parseFloat($(item.UnitPriceInput).val()) || 0;
                const discount = parseFloat($(item.discountInput).val()) || 0;
                const amount = hours * price;
                const total = amount - discount;
                $(item.totalCell).text(total.toFixed(2));
                grandTotal += total;
            });
        }
        $("#repair-grand-total").text(grandTotal.toFixed(2));
        calculateInvoiceTotal();
    }

    function calculateProductTotal() {
        let grandTotal = 0;
        if (typeof products_items !== 'undefined' && Array.isArray(products_items)) {
            products_items.forEach(item => {
                const qty = parseFloat($(item.quantityInput).val()) || 0;
                const price = parseFloat($(item.priceInput).val()) || 0;
                const discount = parseFloat($(item.discountInput).val()) || 0;
                const amount = qty * price;
                const total = amount - discount;
                $(item.totalCell).text(total.toFixed(2));
                grandTotal += total;
            });
        }
        $("#product-grand-total").text(grandTotal.toFixed(2));
        calculateInvoiceTotal();
    }

    function calculateInvoiceTotal() {
        let subtotal = 0;

        // Washers
        if (typeof items !== 'undefined' && Array.isArray(items)) {
            items.forEach(item => {
                if(!item.quantityInput) return;
                const qty = parseFloat($(item.quantityInput).val()) || 0;
                const price = parseFloat($(item.priceInput).val()) || 0;
                const discount = parseFloat($(item.discountInput).val()) || 0;
                subtotal += (qty * price) - discount;
            });
        }

        // Service Packages
        if(selected_fuel) selected_fuel.forEach(fuel => subtotal += fuel.price);
        if(selected_filter) selected_filter.forEach(filter => subtotal += filter.price);

        // Repairs
        if (typeof repair_items !== 'undefined' && Array.isArray(repair_items)) {
            repair_items.forEach(item => {
                const hours = parseFloat($(item.HoursInput).val()) || 0;
                const price = parseFloat($(item.UnitPriceInput).val()) || 0;
                const discount = parseFloat($(item.discountInput).val()) || 0;
                subtotal += (hours * price) - discount;
            });
        }

        // Products
        if (typeof products_items !== 'undefined' && Array.isArray(products_items)) {
            products_items.forEach(item => {
                const qty = parseFloat($(item.quantityInput).val()) || 0;
                const price = parseFloat($(item.priceInput).val()) || 0;
                const discount = parseFloat($(item.discountInput).val()) || 0;
                subtotal += (qty * price) - discount;
            });
        }

        const vatRate = parseFloat($('#in_vat_input').val()) || 0;
        const vatAmount = (subtotal * vatRate) / 100;
        const grandTotal = subtotal + vatAmount;

        $('#invoice-subtotal').text(subtotal.toFixed(2));
        $('#invoice-grand-total').text(grandTotal.toFixed(2));
    }

    // ============================================
    // EVENT HANDLERS
    // ============================================

    $(document).on('input', '#in_vat_input', calculateInvoiceTotal);

    // Override generic 'Previous' button clicks to ensure proper routing
  $(document).on('click', 'button', function(e) {
        if ($(this).text().trim() === 'Previous' || $(this).attr('onclick') === 'stepper.previous()') {
            e.preventDefault();
            e.stopPropagation();
            
            // Start checking from the LAST step (7) down to the first.
            // This ensures we don't accidentally match an earlier step.
            let currentStep = 1;
            if ($('#generate-invoice-part').is(':visible')) currentStep = 7;
            else if ($('#select-products-part').is(':visible')) currentStep = 6;
            else if ($('#maintenance-part').is(':visible')) currentStep = 5;
            else if ($('#service-package-part').is(':visible')) currentStep = 4;
            else if ($('#washer-part').is(':visible')) currentStep = 3;
            else if ($('#vehicle-report-part').is(':visible')) currentStep = 2;

            if (currentStep > 1) {
                let prevStep = currentStep - 1;
                // Use .to() explicitly instead of .previous() to keep header and content in sync
                window.stepper.to(prevStep); 
                window.showStepContent(prevStep);
            }
        }
    });

    $('#job-card-step-1').on('click', function() {
        current_mileage = parseInt($('#current-mileage').val());
        new_mileage = parseInt($('#new-mileage').val());
        paid_status = $('#cmbpaidstatus').val();
        status = $('#cmbstatus').val();
        notify = $('input[name="customRadio"]:checked').val();

      
        if (!current_mileage || current_mileage <= 0) {
            Swal.fire({ icon: 'warning', title: 'Validation Error', text: 'Please enter current mileage' });
            return;
        }

        if (!new_mileage || new_mileage <= 0) {
            Swal.fire({ icon: 'warning', title: 'Validation Error', text: 'Please enter next service mileage' });
            return;
        }
        if (!paid_status) {
            Swal.fire({ icon: 'warning', title: 'Validation Error', text: 'Please select paid status' });
            return;
        }
        if (!status) {
            Swal.fire({ icon: 'warning', title: 'Validation Error', text: 'Please select status' });
            return;
        }

        window.stepper.to(2);
        window.showStepContent(2);
    });

    // Step 2: Next -> Washers
    $('#job-card-step-2').on('click', function() {
        collectVehicleReportData();
        window.stepper.to(3);
        window.showStepContent(3);
    });

    // Step 3: Next -> Service Packages
    $('#job-card-step-3').on('click', function() {
        window.stepper.to(4);
        window.showStepContent(4);
    });

    // Step 4: Next -> Repairs
    $('#job-card-step-4').on('click', function() {
        window.stepper.to(5);
        window.showStepContent(5);
    });

    // Step 5: Next -> Products
    $('#job-card-step-5').on('click', function() {
        window.stepper.to(6);
        window.showStepContent(6);
    });

    // Step 6: Next -> Invoice
    $('#job-card-step-6').on('click', function() {
        try {
            generateInvoiceItems();
            calculateInvoiceTotal();
        } catch(e) {
            console.error("Invoice gen error", e);
        }
        window.stepper.to(7);
        window.showStepContent(7);
    });

    $('.step-trigger').on('click', function() {
        setTimeout(function() {
            const activeStep = $('.step.active');
            const stepIndex = activeStep.index() + 1;
            window.showStepContent(stepIndex);
        }, 100);
    });

    // Delete Repair Item
    $(document).on('click', '.deleteRepairItem', function() {
        const repairId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to remove this repair item?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).closest('tr').remove();
                repair_items = repair_items.filter(item => $(item.rowID).text() != repairId);
                selected_repairs = selected_repairs.filter(r => r.id != repairId);
                
                $('#table-jobcard-repair tbody tr').each(function(index) {
                    $(this).find('td:eq(1)').text(index + 1);
                });
                
                calculateRepairTotal();
                Swal.fire('Removed!', 'Repair item has been removed.', 'success');
            }
        });
    });

    // Delete Product Item
    $(document).on('click', '.deleteProductsItem', function() {
        const productId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to remove this product?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).closest('tr').remove();
                products_items = products_items.filter(item => $(item.rowID).text() != productId);
                selected_products = selected_products.filter(p => p.id != productId);
                
                $('#table-jobcard-products tbody tr').each(function(index) {
                    $(this).find('td:eq(1)').text(index + 1);
                });
                
                calculateProductTotal();
                Swal.fire('Removed!', 'Product has been removed.', 'success');
            }
        });
    });

    // Submit Update Job Card
    $('#submit_update_jobcard').on('click', function() {
        // Validation check for mileage again before submit
        current_mileage = parseInt($('#current-mileage').val());
        if (!current_mileage || current_mileage <= 0) {
            Swal.fire({ icon: 'warning', title: 'Validation Error', text: 'Please enter current mileage' });
            window.stepper.to(1);
            window.showStepContent(1);
            return;
        }

        const jobCardData = {
            job_card_id: jobCardId,
            vehicle_id: vehicle[0].vehicle_id,
            current_mileage: current_mileage,
            new_mileage: parseInt($('#new-mileage').val()),
            paid_status: $('#cmbpaidstatus').val(),
            job_card_type: job_card_type,
            status: $('#cmbstatus').val(),
            notify: $('input[name="customRadio"]:checked').val(),
            invoice_code: invoiceCode,
            vat: parseFloat($('#in_vat_input').val()) || 0,
            vehicle_reports: rowVehicleReportData,
            washers: WasherValues,
            service_packages: selected_service_packages,
            fuels: selected_fuel,
            filters: selected_filter,
            repairs: [],
            products: []
        };

        repair_items.forEach(item => {
            const hours = parseFloat($(item.HoursInput).val()) || 0;
            if (hours > 0) {
                jobCardData.repairs.push({
                    repair_id: $(item.rowID).text(),
                    code: $(item.rowCode).text(),
                    name: $(item.rowName).text(),
                    hours: hours,
                    unit_price: parseFloat($(item.UnitPriceInput).val()) || 0,
                    discount: parseFloat($(item.discountInput).val()) || 0
                });
            }
        });

        products_items.forEach(item => {
            const qty = parseFloat($(item.quantityInput).val()) || 0;
            if (qty > 0) {
                jobCardData.products.push({
                    product_id: $(item.rowID).text(),
                    code: $(item.rowCode).text(),
                    name: $(item.rowName).text(),
                    qty: qty,
                    price: parseFloat($(item.priceInput).val()) || 0,
                    discount: parseFloat($(item.discountInput).val()) || 0
                });
            }
        });

        $('#submit_update_jobcard').hide();
        $('#btn-loading').show();

        $.ajax({
            type: "POST",
            url: "../api/update-jobcard.php",
            data: JSON.stringify(jobCardData),
            contentType: 'application/json',
            dataType: "json",
            success: function (response) {
                $('#btn-loading').hide();
                $('#submit_update_jobcard').show();

                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Job card updated successfully',
                        showConfirmButton: true,
                        timer: 3000
                    }).then(() => {
                        window.location.href = "../job-cards/";
                    });
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: response.message || 'Failed to update job card' });
                }
            },
         error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                console.error("Response Text:", xhr.responseText);
                
                $('#btn-loading').hide();
                $('#submit_update_jobcard').show();

                // 1. Capture the server's response
                let serverMessage = xhr.responseText;
                
                // 2. Clean up HTML tags if PHP outputted a full error page
                if (serverMessage) {
                    serverMessage = serverMessage.replace(/<[^>]*>?/gm, ''); // Strip HTML
                    serverMessage = serverMessage.substring(0, 300); // Limit length
                } else {
                    serverMessage = "Check console (F12) for details.";
                }

                // 3. Show the specific error
                Swal.fire({
                    icon: 'error',
                    title: 'Server Error: ' + xhr.status,
                    text: serverMessage
                });
            }
        });
    });

    function removeLeadingZeros(phoneNumber) {
        return phoneNumber.replace(/^0+/, '');
    }

    function generateUUID() {
        return 'INV-' + Date.now() + '-' + Math.floor(Math.random() * 10000);
    }
});