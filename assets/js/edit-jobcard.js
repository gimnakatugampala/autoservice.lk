$(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    const jobCode = urlParams.get('code');
    
    // Global State (matching add-jobcard structures)
    let vehicle = null, serviceStationInfo = null;
    let items = [], repair_items = [], products_items = [], WasherValues = [];
    let selected_fuel = [], selected_filter = [], selected_service_packages = [];
    let job_card_db_id = null;

    if (!jobCode) { window.location.href = "index.php"; return; }

    // Initialize Stepper
    window.stepper = new Stepper(document.querySelector('.bs-stepper'));

    // 1. LOAD DATA FROM DATABASE
    $.ajax({
        type: "POST",
        url: "../api/get-jobcard-details.php",
        data: { code: jobCode },
        dataType: "json",
        success: function (res) {
            if (!res.success) { alert("Job Card not found"); return; }
            
            const jc = res.job_card;
            job_card_db_id = jc.id;
            vehicle = [jc]; // Set global vehicle object
            serviceStationInfo = res.station;

            // Step 1 Population
            populateSearchVehicleContent({ vehicles: [jc], station: res.station, cmbpaidstatus: [], cmbjobtypes: [], cmbstatus: [] });
            
            // Re-fetch dropdowns but set values after they load
            loadDropdownsForEdit(jc);

            // Step 2 & 3: Reports & Washers
            if (jc.job_card_type_id == "6" || jc.job_card_type_id == "3" || jc.job_card_type_id == "5") {
                getVehicleReport(); // This fetches subcategories
            }
            
            if (res.washers.length > 0) {
                populateWasherTable({ id: res.washers[0].washer_id, price: res.washers[0].price, code: res.washers[0].code });
                $(".wash-qty").val(res.washers[0].qty);
                $(".wash-discount").val(res.washers[0].discount);
                calculateWasherTotal();
            }

            // Step 5: Repairs
            res.repairs.forEach(r => {
                renderRepairRow({ id: r.repair_id, code: r.code, name: r.name, price: r.unit_price, hours: r.hours, discount: r.discount });
            });

            // Step 6: Products
            res.products.forEach(p => {
                renderProductRow({ id: p.product_id, code: p.code, name: p.product_name, price: p.price, qty: p.qty, discount: p.discount });
            });
            
            // Pre-fill VAT
            $("#in_vat_input").val(jc.vat);
        }
    });

    function loadDropdownsForEdit(jc) {
        // Logic to pre-select dropdown values once they are fetched via AJAX
        $.ajax({ type: "POST", url: "../api/cmb/paidstatus.php", success: (data) => {
            let html = '<option value="" disabled>Select</option>';
            JSON.parse(data).forEach(s => html += `<option value="${s.id}" ${s.id == jc.paid_status_id ? 'selected':''}>${s.status}</option>`);
            $("#cmbpaidstatus").html(html);
        }});
        // ... Repeat for status and job types ...
    }

    // 2. REUSE & ADAPT ROW RENDERING FUNCTIONS
    function renderRepairRow(data) {
        var tableBody = $("#table-jobcard-repair");
        var row = $(`<tr>
            <td class='rowID' style='display:none;'>${data.id}</td>
            <td class='rowCode'>${data.code}</td>
            <td class='rowName'>${data.name}</td>
            <td><input value="${data.hours}" type="text" class="form-control hours"></td>
            <td><input value="${data.price}" type="text" class="form-control unit-price"></td>
            <td><input value="${data.discount}" type="text" class="form-control discount"></td>
            <td><p class="repair-total">0.00</p></td>
            <td><button type="button" class="btn btn-sm btn-danger remove-row"><i class="fas fa-trash"></i></button></td>
        </tr>`);
        tableBody.append(row);
        var item = { rowCode: row.find(".rowCode")[0], rowName: row.find(".rowName")[0], rowID: row.find(".rowID")[0], HoursInput: row.find(".hours")[0], UnitPriceInput: row.find(".unit-price")[0], discountInput: row.find(".discount")[0], totalCell: row.find(".repair-total")[0] };
        repair_items.push(item);
        $(row).find('input').on('input', calculateRepairTotal);
        calculateRepairTotal();
    }

    function renderProductRow(data) {
        var tableBody = $("#table-jobcard-products");
        var row = $(`<tr>
            <td class='rowProductID' style='display:none;'>${data.id}</td>
            <td class='rowProductCode'>${data.code}</td>
            <td class='rowProductName'>${data.name}</td>
            <td><input value="${data.qty}" type="text" class="form-control quantityQty"></td>
            <td><input value="${data.price}" type="text" class="form-control unitPriceProduct"></td>
            <td><input value="${data.discount}" type="text" class="form-control discountProduct"></td>
            <td><p class="totalProduct">0.00</p></td>
            <td><button type="button" class="btn btn-sm btn-danger remove-row"><i class="fas fa-trash"></i></button></td>
        </tr>`);
        tableBody.append(row);
        var item = { rowID: row.find(".rowProductID")[0], rowCode: row.find(".rowProductCode")[0], rowName: row.find(".rowProductName")[0], quantityInput: row.find(".quantityQty")[0], priceInput: row.find(".unitPriceProduct")[0], discountInput: row.find(".discountProduct")[0], totalCell: row.find(".totalProduct")[0] };
        products_items.push(item);
        $(row).find('input').on('input', calculateProductTotal);
        calculateProductTotal();
    }

    // 3. THE UPDATE SUBMISSION
    $("#submit_update_jobcard").click(function () {
        $("#submit_update_jobcard").hide();
        $("#btn-loading").show();

        const updatePayload = {
            job_card_id: job_card_db_id,
            status: $("#cmbstatus").val(),
            paid_status: $("#cmbpaidstatus").val(),
            vat: $("#in_vat_input").val(),
            washers: JSON.stringify(WasherValues),
            repairs: JSON.stringify(repair_items.map(r => ({
                repairID: r.rowID.innerText,
                hours: r.HoursInput.value,
                price: r.UnitPriceInput.value,
                discount: r.discountInput.value
            }))),
            products: JSON.stringify(products_items.map(p => ({
                productID: p.rowID.innerText,
                qty: p.quantityInput.value,
                price: p.priceInput.value,
                discount: p.discountInput.value
            })))
        };

        $.ajax({
            type: "POST",
            url: "../api/update-jobcard.php", // CREATE THIS FILE
            data: updatePayload,
            success: function (res) {
                if (res.trim() === "success") {
                    Swal.fire({ icon: "success", title: "Job Card Updated" }).then(() => window.location.href="index.php");
                } else {
                    alert("Error: " + res);
                    $("#submit_update_jobcard").show();
                    $("#btn-loading").hide();
                }
            }
        });
    });

    // Handle button clicks to move steps
    $("#job-card-step-1").click(() => stepper.next());
    $("#job-card-step-2").click(() => stepper.next());
    $("#job-card-step-3").click(() => stepper.next());
    $("#job-card-step-4").click(() => stepper.next());
    $("#job-card-step-5").click(() => stepper.next());
    // Step 6 preview logic
    $("#job-card-step-6").click(() => {
        getInvoiceDetails(vehicle, serviceStationInfo);
        stepper.next();
    });

    // ... INCLUDE ALL YOUR CALCULATION FUNCTIONS (calculateRepairTotal, calculateProductTotal, calculateSubtotal, etc.) ...
});