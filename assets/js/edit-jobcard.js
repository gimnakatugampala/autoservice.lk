$(document).ready(function () {
    // Initialize BS Stepper
    var stepperElement = document.querySelector('.bs-stepper');
    if (stepperElement) {
        window.stepper = new Stepper(stepperElement, {
            linear: false,
            animation: true
        });
    } else {
        console.error("Stepper element not found!");
    }

    // Get job card code from URL
    const urlParams = new URLSearchParams(window.location.search);
    const jobCardCode = urlParams.get('code');

    console.log("Job Card Code from URL:", jobCardCode);

    let vehicle;
    let current_mileage;
    let new_mileage;
    let paid_status;
    let job_card_type;
    let status;
    let notify;
    let jobCardId;
    let invoiceCode;
    let serviceStationInfo;

    var rowVehicleReportData = [];
    var items = [];
    var WasherValues = [];
    var service_packages_items = [];
    var service_packages_items_fuel = [];
    var service_packages_items_filter = [];
    var selected_service_packages = [];
    var selected_fuel = [];
    var selected_filter = [];
    var repair_items = [];
    var selected_repairs = [];
    var products_items = [];
    var selected_products = [];

    let counterId = 0;

    const currentDate = new Date();
    const day = currentDate.getDate();
    const month = currentDate.getMonth() + 1;
    const year = currentDate.getFullYear();
    const formattedDay = day < 10 ? `0${day}` : day;
    const formattedMonth = month < 10 ? `0${month}` : month;
    const formattedDate = `${formattedDay}-${formattedMonth}-${year}`;

   const VAT = document.getElementById("in_vat_input");
    // ADDED: Null check for VAT element
    if (VAT) {
        VAT.addEventListener("input", function () {
            displayCalculation();
        });
    }

    // Load existing job card data
    if (jobCardCode) {
        console.log("Loading job card with code:", jobCardCode);
        loadJobCardData(jobCardCode);
    } else {
        console.error("No job card code provided in URL");
        Swal.fire({
            icon: "warning",
            title: "No Job Card Code",
            text: "Please provide a job card code in the URL",
        }).then(() => {
            window.location.href = "../job-cards/";
        });
    }

    function loadJobCardData(code) {
        $.ajax({
            type: "POST",
            url: "../api/get-jobcard-data.php",
            data: { code: code },
            dataType: "json",
            success: function (data) {
                console.log("Loaded job card data:", data);
                
                if (data.success) {
                    populateExistingData(data);
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
                console.error("Response:", xhr.responseText);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Failed to load job card data. Please check if the API file exists at: ../api/get-jobcard-data.php",
                });
            }
        });
    }

    function populateExistingData(data) {
        console.log("Starting to populate data...");
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
            first_name: jc.first_name,
            last_name: jc.last_name,
            phone: jc.phone,
            address: jc.address,
            vehicle_model_name: jc.vehicle_model_name,
            vehicle_make_name: jc.vehicle_make_name,
            current_mileage: jc.current_mileage
        }];

        serviceStationInfo = data.station;
        current_mileage = jc.job_mileage;
        new_mileage = jc.next_mileage;
        paid_status = jc.paid_status_id;
        job_card_type = jc.job_card_type_id;
        status = jc.status_id;
        notify = jc.notify_month;

        console.log("Vehicle data:", vehicle);
        console.log("Job card type:", job_card_type);

        // Populate Step 1 - Vehicle Information
        console.log("Populating vehicle info...");
        populateVehicleInfo(data);

        // Populate Step 2 - Vehicle Report
        console.log("Populating vehicle reports...");
        if (data.reports && data.reports.length > 0) {
            populateVehicleReports(data.reports);
        } else {
            if (job_card_type == "6" || job_card_type == "3" || job_card_type == "5") {
                $('#vehicle-report-tables').html(`<p class="text-center text-muted">No vehicle reports found for this job card.</p>`);
            } else {
                $('#vehicle-report-tables').html(`<p class="text-center text-muted">Vehicle reports not available for this job card type.</p>`);
            }
        }

        // Populate Step 3 - Washers
        console.log("Populating washers...");
        if (data.washers && data.washers.length > 0) {
            populateWashers(data.washers);
        } else {
            $('#table-jobcard-washer tbody').html(`<tr><td colspan="6" class="text-center text-muted">No washers found for this job card.</td></tr>`);
        }

        // Populate Step 4 - Service Packages
        console.log("Populating service packages...");
        if (data.fuels && data.fuels.length > 0) {
            populateServicePackages(data.fuels, data.filters);
        } else {
            $('#table-service-packages tbody').html(`<tr><td colspan="3" class="text-center text-muted">No service packages found for this job card.</td></tr>`);
        }

        // Populate Step 5 - Repairs
        console.log("Populating repairs...");
        if (data.repairs && data.repairs.length > 0) {
            populateRepairs(data.repairs);
        } else {
            $('#table-jobcard-repair tbody').html(`<tr><td colspan="7" class="text-center text-muted">No repairs found for this job card.</td></tr>`);
        }

        // Populate Step 6 - Products
        console.log("Populating products...");
        if (data.products && data.products.length > 0) {
            populateProducts(data.products);
        } else {
            $('#table-jobcard-products tbody').html(`<tr><td colspan="7" class="text-center text-muted">No products found for this job card.</td></tr>`);
        }

        // Populate Step 7 - Invoice
        console.log("Generating invoice...");
        getInvoiceDetails(vehicle, serviceStationInfo);

        console.log("Data population complete!");
    }

    function populateVehicleInfo(data) {
        console.log("populateVehicleInfo called with:", data);
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

        let vehicleImage = vehicleImages[jc.vehicle_class_id] || "../assets/img/vehicle-img/default.jpg";

        const htmlContent = `
            <div class="row my-4">
                <div class="col-md-5 mx-auto">
                    <div class="card p-3 py-4 border border-dark text-center">
                        <div class="mx-auto my-2">
                            <img src="${vehicleImage}" style="width: 80px; height: 80px; border-radius: 50%;object-fit: cover;" alt="Profile Image" />
                            <div class="d-flex align-items-center justify-content-center">
                                <span class="m-0 p-0 d-flex align-items-center text-secondary mr-2">
                                    <span class="mr-1">Color: </span>
                                    <div class="border inline" style="width:11px;height:11px;background-color:${jc.vehicle_color};border-radius:50%"></div>
                                </span>
                                <span class="h4 m-0 p-0"><b>${jc.vehicle_number}</b></span>
                            </div>
                            <p class="m-0 p-0 text-secondary">${jc.first_name} ${jc.last_name}</p>
                            <p class="m-0 p-0 text-secondary">+94 ${removeLeadingZeros(jc.phone)}</p>
                            <p class="m-0 p-0 text-secondary">Prev Mileage : ${jc.current_mileage || 0} KM</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mx-auto">
                    <div class="form-group">
                        <label for="current-mileage">Current Mileage (KM) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="current-mileage" placeholder="Current Mileage" value="${current_mileage || ''}">
                    </div>
                </div>
                <div class="col-md-4 mx-auto">
                    <div class="form-group">
                        <label for="new-mileage">Next Mileage (KM) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="new-mileage" placeholder="Next Mileage" value="${new_mileage || ''}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Paid Status <span class="text-danger">*</span></label>
                        <select id="cmbpaidstatus" class="custom-select">
                            <option value="" selected disabled>Please Select</option>
                            ${data.cmbpaidstatus.map((state) => {
                                return `<option value="${state.id}" ${state.id == paid_status ? 'selected' : ''}>${state.status}</option>`;
                            }).join('')}
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Job Card Type <span class="text-danger">*</span></label>
                        <select id="cmbjobcardtype" class="custom-select" disabled>
                            <option value="" selected disabled>Please Select</option> 
                            ${data.cmbjobtypes.map((state) => {
                                return `<option value="${state.id}" ${state.id == job_card_type ? 'selected' : ''}>${state.type}</option>`;
                            }).join('')}
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select id="cmbstatus" class="custom-select">
                            <option value="" selected disabled>Please Select</option> 
                            ${data.cmbstatus.map((state) => {
                                return `<option value="${state.id}" ${state.id == status ? 'selected' : ''}>${state.status}</option>`;
                            }).join('')}
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mx-auto">
                    <label>Notify Me <span class="text-danger">*</span></label>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="row">
                        <div class="col-md-4 mx-auto">
                            <div class="custom-control custom-radio">
                                <input value="2" class="custom-control-input" type="radio" id="customRadio2" name="customRadio" ${notify == 2 ? 'checked' : ''}>
                                <label for="customRadio2" class="custom-control-label">In 2 Months</label>
                            </div>
                        </div>
                        <div class="col-md-4 mx-auto">
                            <div class="custom-control custom-radio">
                                <input value="4" class="custom-control-input" type="radio" id="customRadio4" name="customRadio" ${notify == 4 ? 'checked' : ''}>
                                <label for="customRadio4" class="custom-control-label">In 4 Months</label>
                            </div>
                        </div>
                        <div class="col-md-4 mx-auto">
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
        console.log("Vehicle info populated successfully");
    }

    function populateVehicleReports(reports) {
        // Implementation for vehicle reports based on job card type
        if (job_card_type == "6" || job_card_type == "3" || job_card_type == "5") {
            getVehicleReport(reports);
        } else {
            $('#vehicle-report-tables').html(`<p class="text-center">Report Not Available</p>`);
        }
    }

    function populateWashers(washers) {
        if (washers.length > 0) {
            const washer = washers[0];
            $('#table-jobcard-washer tbody').html(`
                <tr class="rowBody">
                    <td style='display:none;' class='rowID'>${washer.washer_id}</td>
                    <td style='display:none;' class='rowCode'>${washer.code}</td>
                    <td>1.</td>
                    <td>Wash (${washer.code})</td>
                    <td><input value="${washer.qty}" type="number" class="form-control wash-qty"></td>
                    <td><input value="${washer.price}" type="number" class="form-control wash-unit-price"></td>
                    <td><input value="${washer.discount}" type="number" class="form-control wash-discount"></td>
                    <td><p class="h6 font-weight-bold wash-total">0.00</p></td>
                </tr>
            `);

            var row = $(".rowBody");
            var item = {
                rowCode: row.find(".rowCode")[0],
                rowID: row.find(".rowID")[0],
                quantityInput: row.find(".wash-qty")[0],
                priceInput: row.find(".wash-unit-price")[0],
                discountInput: row.find(".wash-discount")[0],
                totalCell: row.find(".wash-total")[0],
            };
            
            items = [item];

            [item.quantityInput, item.priceInput, item.discountInput].forEach(input => {
                input.addEventListener("input", calculateWasherTotal);
            });

            calculateWasherTotal();
        }
    }

    function populateServicePackages(fuels, filters) {
        if (!fuels || fuels.length === 0) return;

        // Group fuels and filters by service package
        const packageMap = {};
        
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
                price: f.price,
                selected: true
            });
        });

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
                    price: f.price,
                    selected: true
                });
            });
        }

        // Populate each service package
        Object.keys(packageMap).forEach((pkgId, index) => {
            const pkg = packageMap[pkgId];
            counterId = index + 1;
            
            // Store selected fuel/filter for this package
            const selectedFuelForPkg = pkg.fuels.find(f => f.selected);
            const selectedFilterForPkg = pkg.filters.find(f => f.selected);

            if (selectedFuelForPkg) {
                selected_fuel.push({
                    ServicePackageId: pkgId,
                    ServicePackageName: `Package ${pkgId}`,
                    ServicePackageCode: `PKG-${pkgId}`,
                    price: selectedFuelForPkg.price,
                    typeId: selectedFuelForPkg.id
                });
            }

            if (selectedFilterForPkg) {
                selected_filter.push({
                    ServicePackageId: pkgId,
                    ServicePackageName: `Package ${pkgId}`,
                    ServicePackageCode: `PKG-${pkgId}`,
                    price: selectedFilterForPkg.price,
                    typeId: selectedFilterForPkg.id
                });
            }

            // Add to selected packages
            selected_service_packages.push({ id: pkgId });
        });

        calculateServicePackageTotal();
    }

    function populateRepairs(repairs) {
        repairs.forEach((repair, index) => {
            var row = $("<tr>");
            row.append(`<td class='rowID' style='display:none;'>${repair.repair_id}</td>`);
            row.append(`<td class='rowCode' style='display:none;'>${repair.code}</td>`);
            row.append(`<td class='rowName' style='display:none;'>${repair.name}</td>`);
            row.append(`<td>${index + 1}.</td>`);
            row.append(`<td>${repair.name}</td>`);
            row.append(`<td><div class="input-group"><input value="${repair.hours}" type="text" class="form-control hours"><div class="input-group-append"><span class="input-group-text">.00</span></div></div></td>`);
            row.append(`<td><div class="input-group"><input value="${repair.unit_price}" type="text" class="form-control unit-price"><div class="input-group-append"><span class="input-group-text">.00</span></div></div></td>`);
            row.append(`<td><div class="input-group"><input value="${repair.discount}" type="text" class="form-control discount"><div class="input-group-append"><span class="input-group-text">.00</span></div></div></td>`);
            row.append(`<td><p class="h6 repair-total">0.00</p></td>`);
            row.append(`<td><button data-id="${repair.repair_id}" type="button" class="btn bg-gradient-danger deleteRepairItem"><i class="fas fa-trash"></i></button></td>`);
            $("#table-jobcard-repair").append(row);

            var item = {
                rowCode: row.find(".rowCode")[0],
                rowName: row.find(".rowName")[0],
                rowID: row.find(".rowID")[0],
                HoursInput: row.find(".hours")[0],
                UnitPriceInput: row.find(".unit-price")[0],
                discountInput: row.find(".discount")[0],
                totalCell: row.find(".repair-total")[0],
            };
            repair_items.push(item);

            item.HoursInput.addEventListener("input", calculateRepairTotal);
            item.UnitPriceInput.addEventListener("input", calculateRepairTotal);
            item.discountInput.addEventListener("input", calculateRepairTotal);

            selected_repairs.push({ id: repair.repair_id });
        });

        calculateRepairTotal();
    }

    function populateProducts(products) {
        products.forEach((product, index) => {
            var row = $("<tr>");
            row.append(`<td class='rowProductID' style='display:none;'>${product.product_id}</td>`);
            row.append(`<td class='rowProductCode' style='display:none;'>${product.code}</td>`);
            row.append(`<td class='rowProductName' style='display:none;'>${product.product_name}</td>`);
            row.append(`<td>${index + 1}.</td>`);
            row.append(`<td>${product.product_name}</td>`);
            row.append(`<td><div class="input-group"><input value="${product.qty}" type="text" class="form-control quantityQty"><div class="input-group-append"><span class="input-group-text">.00</span></div></div></td>`);
            row.append(`<td><div class="input-group"><input value="${product.price}" type="text" class="form-control unitPriceProduct"><div class="input-group-append"><span class="input-group-text">.00</span></div></div></td>`);
            row.append(`<td><div class="input-group"><input value="${product.discount}" type="text" class="form-control discountProduct"><div class="input-group-append"><span class="input-group-text">.00</span></div></div></td>`);
            row.append(`<td><p class="h6 totalProduct">0.00</p></td>`);
            row.append(`<td><button data-id="${product.product_id}" type="button" class="btn bg-gradient-danger deleteProductsItem"><i class="fas fa-trash"></i></button></td>`);
            $("#table-jobcard-products").append(row);

            var item = {
                rowID: row.find(".rowProductID")[0],
                rowCode: row.find(".rowProductCode")[0],
                rowName: row.find(".rowProductName")[0],
                quantityInput: row.find(".quantityQty")[0],
                priceInput: row.find(".unitPriceProduct")[0],
                discountInput: row.find(".discountProduct")[0],
                totalCell: row.find(".totalProduct")[0],
            };
            products_items.push(item);

            item.quantityInput.addEventListener("input", calculateProductTotal);
            item.priceInput.addEventListener("input", calculateProductTotal);
            item.discountInput.addEventListener("input", calculateProductTotal);

            selected_products.push({ id: product.product_id });
        });

        calculateProductTotal();
    }

    function populateDropdowns(data) {
        // This would populate the search dropdowns if needed
    }

    // Calculation functions
  function calculateWasherTotal() {
    let grandTotal = 0;
    WasherValues = [];

    items.forEach(function (item) {
        // FIXED: Check if properties exist before accessing innerText or value
        if (item.rowID && item.quantityInput && item.priceInput && item.totalCell) {
            var rowID = item.rowID.innerText;
            var quantity = parseFloat(item.quantityInput.value) || 0;
            var price = parseFloat(item.priceInput.value) || 0;
            var discount = parseFloat(item.discountInput.value) || 0;

            var itemTotal = (quantity * price) - discount;
            item.totalCell.textContent = itemTotal.toFixed(2);
            
            grandTotal += itemTotal;

            WasherValues.push({
                washerID: rowID,
                price: price,
                quantity: quantity,
                discount: discount
            });
        }
    });

    $("#washer-grand-total").text(grandTotal.toFixed(2));
}

    function calculateServicePackageTotal() {
        let totalAmount = 0;

        selected_filter.forEach((filter) => {
            totalAmount += parseFloat(filter.price) || 0;
        });

        selected_fuel.forEach((fuel) => {
            totalAmount += parseFloat(fuel.price) || 0;
        });

        $("#service-package-grand-total").text(totalAmount.toFixed(2));
    }

    function calculateRepairTotal() {
        var totalAmount = 0;
        repair_items.forEach(function (item) {
            var hours = item.HoursInput.value == "" ? 0 : parseFloat(item.HoursInput.value);
            var unitPrice = item.UnitPriceInput.value == "" ? 0 : parseFloat(item.UnitPriceInput.value);
            var discount = item.discountInput.value == "" ? 0 : parseFloat(item.discountInput.value);

            var itemTotal = hours * unitPrice - discount;
            item.totalCell.textContent = itemTotal.toFixed(2);

            totalAmount += itemTotal;
        });
        $("#repair-grand-total").text(totalAmount.toFixed(2));
    }

    function calculateProductTotal() {
        var totalAmount = 0;
        products_items.forEach(function (item) {
            var quantity = item.quantityInput.value == "" ? 0 : parseFloat(item.quantityInput.value);
            var price = item.priceInput.value == "" ? 0 : parseFloat(item.priceInput.value);
            var discount = item.discountInput.value == "" ? 0 : parseFloat(item.discountInput.value);

            var itemTotal = quantity * price - discount;
            item.totalCell.textContent = itemTotal.toFixed(2);

            totalAmount += itemTotal;
        });
        $("#product-grand-total").text(totalAmount.toFixed(2));
    }

    function getInvoiceDetails(vehicle, serviceStationInfo) {
        const jc = vehicle[0];
        const station = serviceStationInfo[0];

        $("#station-logo").attr('src', station.logo ? `../uploads/stations/${station.logo}` : '../dist/img/system/logo_pistona.png');
        $("#station-name").text(station.service_name || 'Station Name');
        $("#station-address").text(station.address ? `${station.address} ${station.street || ''} ${station.city || ''}` : 'Station Address');
        $("#station-contact").text(`Tel: ${station.phone || 'Phone'} | Fax: ${station.fax || 'Fax'}`);
        $("#station-email").text(`Email: ${station.email || 'email@example.com'}`);

        $("#invoice-customer-info").html(`
            <span><b>Customer Name</b></span>: <span class="text-uppercase">${jc.first_name} ${jc.last_name}</span><br>
            <span><b>Address</b></span>: <span class="text-uppercase">${jc.address}</span><br>
            <span><b>Contact No.</b></span>: <span>${jc.phone}</span><br>
            <span><b>Vehicle No</b></span>: <span class="text-uppercase">${jc.vehicle_number}</span><br>
            <span><b>Model</b></span>: <span class="text-uppercase">${jc.vehicle_model_name}</span><br>
            <span><b>Make</b></span>: <span class="text-uppercase">${jc.vehicle_make_name}</span><br>
        `);

        $("#invoice-job-info").html(`
            <span><b>Job Card No</b></span>: <span>${jobCardCode}</span><br>
            <span><b>Invoice No</b></span>: <span>${invoiceCode}</span><br>
            <span><b>Current Mileage</b></span>: <span>${current_mileage} KM</span><br>
            <span><b>Next Mileage</b></span>: <span>${new_mileage} KM</span><br>
            <span><b>Chassis No</b></span>: <span>${jc.chassis_number}</span><br>
            <span><b>Engine No</b></span>: <span>${jc.engine_number}</span><br>
        `);

        calculateSubtotal();
        displayCalculation();
        updateInvoiceItems();
    }

   function calculateSubtotal() {
        let grandTotal = 0;

        // FIXED: Added parseFloat and null checks for internal text
        items.forEach(wash => {
            if(wash.totalCell) grandTotal += parseFloat(wash.totalCell.innerText || 0);
        });
        
        repair_items.forEach(repair => {
            if(repair.totalCell) grandTotal += parseFloat(repair.totalCell.innerText || 0);
        });
        
        products_items.forEach(product => {
            if(product.totalCell) grandTotal += parseFloat(product.totalCell.innerText || 0);
        });

        selected_fuel.forEach((fuel) => {
            grandTotal += parseFloat(fuel.price) || 0;
        });

        selected_filter.forEach((filter) => {
            grandTotal += parseFloat(filter.price) || 0;
        });

        $("#invoice-subtotal").text(grandTotal.toFixed(2));
    }

function displayCalculation() {
        // FIXED: Safe access to VAT and subtotal
        const VAT_element = document.getElementById("in_vat_input");
        const VAT_value = (VAT_element && VAT_element.value !== "") ? parseFloat(VAT_element.value) : 0;
        const subtotalText = $("#invoice-subtotal").text();
        const subtotal = parseFloat(subtotalText) || 0;
        
        const final = subtotal + (subtotal * VAT_value / 100);
        $("#invoice-grand-total").text(final.toFixed(2));
    }

    function updateInvoiceItems() {
        let html = '';

        // Washers
    items.forEach(wash => {
            // FIXED: Check innerText safely
            const code = wash.rowCode ? wash.rowCode.innerText : "N/A";
            const total = wash.totalCell ? wash.totalCell.innerText : "0.00";
            html += `<tr>
                <td>${code}</td>
                <td class="text-uppercase">Wash</td>
                <td>${wash.quantityInput.value}</td>
                <td>${wash.priceInput.value}</td>
                <td>${parseFloat(wash.quantityInput.value * wash.priceInput.value).toFixed(2)}</td>
                <td>${wash.discountInput.value}</td>
                <td>${total}</td>
            </tr>`;
        });

        // Service Packages
        const groupedPackages = {};
        selected_fuel.forEach(fuel => {
            if (!groupedPackages[fuel.ServicePackageId]) {
                groupedPackages[fuel.ServicePackageId] = {
                    code: fuel.ServicePackageCode,
                    name: fuel.ServicePackageName,
                    total: 0
                };
            }
            groupedPackages[fuel.ServicePackageId].total += parseFloat(fuel.price);
        });

        selected_filter.forEach(filter => {
            if (!groupedPackages[filter.ServicePackageId]) {
                groupedPackages[filter.ServicePackageId] = {
                    code: filter.ServicePackageCode,
                    name: filter.ServicePackageName,
                    total: 0
                };
            }
            groupedPackages[filter.ServicePackageId].total += parseFloat(filter.price);
        });

        Object.values(groupedPackages).forEach(pkg => {
            html += `<tr>
                <td>${pkg.code}</td>
                <td class="text-uppercase">${pkg.name}</td>
                <td>1</td>
                <td>${pkg.total.toFixed(2)}</td>
                <td>${pkg.total.toFixed(2)}</td>
                <td>0.00</td>
                <td>${pkg.total.toFixed(2)}</td>
            </tr>`;
        });

        // Repairs
        repair_items.forEach(repair => {
            html += `<tr>
                <td>${repair.rowCode.innerText}</td>
                <td class="text-uppercase">${repair.rowName.innerText}</td>
                <td>${repair.HoursInput.value}</td>
                <td>${repair.UnitPriceInput.value}</td>
                <td>${parseFloat(repair.HoursInput.value * repair.UnitPriceInput.value).toFixed(2)}</td>
                <td>${repair.discountInput.value}</td>
                <td>${repair.totalCell.innerText}</td>
            </tr>`;
        });

        // Products
        products_items.forEach(product => {
            html += `<tr>
                <td>${product.rowCode.innerText}</td>
                <td class="text-uppercase">${product.rowName.innerText}</td>
                <td>${product.quantityInput.value}</td>
                <td>${product.priceInput.value}</td>
                <td>${parseFloat(product.quantityInput.value * product.priceInput.value).toFixed(2)}</td>
                <td>${product.discountInput.value}</td>
                <td>${product.totalCell.innerText}</td>
            </tr>`;
        });

        $("#invoice-items-tbody").html(html);
    }

    // Step navigation
    $("#job-card-step-1").click(function () {
        current_mileage = $("#current-mileage").val();
        new_mileage = $("#new-mileage").val();
        paid_status = $("#cmbpaidstatus").val();
        status = $("#cmbstatus").val();
        notify = $('input[name="customRadio"]:checked').val();

        if (!current_mileage || !new_mileage || !paid_status || !status || !notify) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please fill all required fields",
            });
            return;
        }

        stepper.next();
    });

    $("#job-card-step-2").click(function () {
        stepper.next();
    });

    $("#job-card-step-3").click(function () {
        stepper.next();
    });

    $("#job-card-step-4").click(function () {
        stepper.next();
    });

    $("#job-card-step-5").click(function () {
        stepper.next();
    });

    $("#job-card-step-6").click(function () {
        getInvoiceDetails(vehicle, serviceStationInfo);
        stepper.next();
    });

    // Submit update
    $("#submit_update_jobcard").click(function () {
        $("#submit_update_jobcard").hide();
        $("#btn-loading").show();

        const repairArr = repair_items.map(repair => ({
            repairID: repair.rowID.innerText,
            repairCode: repair.rowCode.innerText,
            repairName: repair.rowName.innerText,
            hours: repair.HoursInput.value,
            price: repair.UnitPriceInput.value,
            discount: repair.discountInput.value,
            total: repair.totalCell.innerText
        }));

        const productArr = products_items.map(product => ({
            productID: product.rowID.innerText,
            productCode: product.rowCode.innerText,
            productName: product.rowName.innerText,
            qty: product.quantityInput.value,
            price: product.priceInput.value,
            discount: product.discountInput.value,
            total: product.totalCell.innerText
        }));

        $.ajax({
            type: "POST",
            url: "../api/update-jobcard.php",
            data: {
                job_card_id: jobCardId,
                status: status,
                paid_status: paid_status,
                vat: VAT.value,
                current_mileage: current_mileage,
                new_mileage: new_mileage,
                notify: notify,
                washers: JSON.stringify(WasherValues),
                repairs: JSON.stringify(repairArr),
                products: JSON.stringify(productArr),
                fuels: JSON.stringify(selected_fuel),
                filters: JSON.stringify(selected_filter),
                vehicle_reports: JSON.stringify(rowVehicleReportData),
                vehicleDetails: JSON.stringify(vehicle),
                station: JSON.stringify(serviceStationInfo)
            },
            success: function (response) {
                console.log(response);
                
                if (response === "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Job Card Updated!",
                        text: "The job card has been updated successfully.",
                        confirmButtonColor: "#007bff",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "../job-cards/";
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Please Try Again",
                        text: "Something Went Wrong: " + response,
                    });
                    $("#submit_update_jobcard").show();
                    $("#btn-loading").hide();
                }
            },
            error: function (error) {
                console.log(error);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Failed to update job card",
                });
                $("#submit_update_jobcard").show();
                $("#btn-loading").hide();
            }
        });
    });

    // Delete handlers
    $("#table-jobcard-repair").on("click", ".deleteRepairItem", function () {
        var listItem = $(this).data('id');
        
        let indexToRemove = selected_repairs.findIndex(item => item.id == listItem);
        if (indexToRemove !== -1) {
            selected_repairs.splice(indexToRemove, 1);
        }

        let indexToRemoveItems = repair_items.findIndex(item => item.rowID.innerText == listItem);
        if (indexToRemoveItems !== -1) {
            repair_items.splice(indexToRemoveItems, 1);
        }

        calculateRepairTotal();
        $(this).closest('tr').remove();
    });

    $("#table-jobcard-products").on("click", ".deleteProductsItem", function () {
        var listItem = $(this).data('id');
        
        let indexToRemove = selected_products.findIndex(item => item.id == listItem);
        if (indexToRemove !== -1) {
            selected_products.splice(indexToRemove, 1);
        }

        let indexToRemoveItems = products_items.findIndex(item => item.rowID.innerText == listItem);
        if (indexToRemoveItems !== -1) {
            products_items.splice(indexToRemoveItems, 1);
        }

        calculateProductTotal();
        $(this).closest('tr').remove();
    });

    // Helper functions
    function removeLeadingZeros(str) {
        return str.replace(/^0+/, '');
    }

    function generateUUID() {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    }

    function getVehicleReport(existingReports) {
        $.ajax({
            type: "POST",
            url: "../api/getvehiclereport.php",
            dataType: "json",
            success: function (data) {
                populateVehicleReportContent(data, existingReports);
            },
            error: function () {
                console.log("Failed to load vehicle report");
            }
        });
    }

    function populateVehicleReportContent(data, existingReports) {
        $('#vehicle-report-tables').html(`
            ${data.vehicle_category.map((category) => {
                return `
                    <div class="col-md-10 table-responsive p-0 mx-auto my-2">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>${category.category}</th>
                                    <th>Worse</th>
                                    <th>Bad</th>
                                    <th>Ok</th>
                                    <th>Good</th>
                                    <th>Perfect</th>
                                </tr>
                            </thead>
                            <tbody>
                            ${data.vehicle_subcategory.filter(subcategory => subcategory.vehicle_condition_category_id === category.id).map(subcategory => {
                                const existingReport = existingReports.find(r => r.sub_category_id == subcategory.id);
                                const selectedValue = existingReport ? existingReport.value_id : null;
                                
                                return `
                                    <tr data-category-id="${category.id}" data-subcategory-id="${subcategory.id}">
                                        <td>${subcategory.sub_category}</td>
                                        <td><div class="form-check"><input value="1" class="form-check-input" type="radio" name="radio${subcategory.id}" ${selectedValue == 1 ? 'checked' : ''}><label class="form-check-label">Worse</label></div></td>
                                        <td><div class="form-check"><input value="2" class="form-check-input" type="radio" name="radio${subcategory.id}" ${selectedValue == 2 ? 'checked' : ''}><label class="form-check-label">Bad</label></div></td>
                                        <td><div class="form-check"><input value="3" class="form-check-input" type="radio" name="radio${subcategory.id}" ${selectedValue == 3 ? 'checked' : ''}><label class="form-check-label">Ok</label></div></td>
                                        <td><div class="form-check"><input value="4" class="form-check-input" type="radio" name="radio${subcategory.id}" ${selectedValue == 4 ? 'checked' : ''}><label class="form-check-label">Good</label></div></td>
                                        <td><div class="form-check"><input value="5" class="form-check-input" type="radio" name="radio${subcategory.id}" ${selectedValue == 5 ? 'checked' : ''}><label class="form-check-label">Perfect</label></div></td>
                                    </tr>
                                `;
                            }).join('')}
                            </tbody>
                        </table>
                    </div>`;
            }).join('')}
        `);
    }
});