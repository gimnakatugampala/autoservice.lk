$(document).ready(function () {
    // Get purchase order code from URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const poCode = urlParams.get('code');

    if (poCode) {
        getPODetails(poCode);
    } else {
        alert("No purchase order code provided in URL");
    }

    function getPODetails(code) {
        $.ajax({
            url: "../api/getpurchaseorderdetails.php",
            type: "POST",
            data: { code: code },
            dataType: "JSON",
            success: function (response) {
                if (response.status === "success") {
                    const header = response.header;
                    
                    // Service Station Information
                    const stationName = header.station_name || "Pistona Automotive Solutions (Pvt) Ltd";
                    const stationAddress = header.station_address || "385/45, Major Wasantha Gunarathne Mw, Mahara Kadawatha";
                    const stationStreet = header.station_street || "";
                    const stationCity = header.station_city || "";
                    const stationPhone = header.station_phone || "0117600800";
                    const stationOtherPhone = header.station_other_phone || "";
                    const stationEmail = header.station_email || "pistonaautomotivesolutions@gmail.com";
                    const stationLogo = header.station_logo || "";
                    
                    // Update Station Header
                    $("#station_name").text(stationName);
                    
                    // Build full address
                    let fullAddress = stationAddress;
                    if (stationStreet) fullAddress += ", " + stationStreet;
                    if (stationCity) fullAddress += ", " + stationCity;
                    $("#station_address").html(fullAddress);
                    
                    // Build phone display
                    let phoneDisplay = "Tel: " + stationPhone;
                    if (stationOtherPhone) phoneDisplay += " / " + stationOtherPhone;
                    $("#station_phone").text(phoneDisplay);
                    
                    $("#station_email").text("Email: " + stationEmail);
                    
                    // Update "From" section with same station data
                    $("#from_station_name").text(stationName);
                    $("#from_station_address").html(fullAddress);
                    $("#from_station_phone").text(stationPhone + (stationOtherPhone ? " / " + stationOtherPhone : ""));
                    $("#from_station_email").text(stationEmail);
                    
                    // Update logo if available
                    if (stationLogo) {
                        $("#station_logo").attr("src", "../uploads/stations/" + stationLogo);
                    }
                    
                    // Supplier Information
                    const supplierName = (header.supplier_first_name || "") + " " + (header.supplier_last_name || "");
                    $("#lbl_supplier_name").text(supplierName.trim() || "---");
                    $("#lbl_supplier_address").text(header.supplier_address || "---");
                    $("#lbl_supplier_phone").text(header.supplier_phone || "---");
                    $("#lbl_supplier_email").text(header.supplier_email || "---");
                    
                    // Purchase Order Information
                    $("#lbl_po_code").text(header.po_code || "---");
                    $("#lbl_placed_date").text(header.po_date || header.po_created_date || "---");
                    
                    // Status Information with badges
                    const statusName = header.status_name || "N/A";
                    let statusBadge = '';
                    if (statusName === 'Pending') {
                        statusBadge = '<span class="badge badge-warning">' + statusName + '</span>';
                    } else if (statusName === 'Completed') {
                        statusBadge = '<span class="badge badge-success">' + statusName + '</span>';
                    } else if (statusName === 'Canceled') {
                        statusBadge = '<span class="badge badge-danger">' + statusName + '</span>';
                    } else {
                        statusBadge = '<span class="badge badge-secondary">' + statusName + '</span>';
                    }
                    $("#lbl_po_status").html(statusBadge);
                    
                    const paidStatusName = header.paid_status_name || "N/A";
                    let paidBadge = '';
                    if (paidStatusName === 'Paid') {
                        paidBadge = '<span class="badge badge-success">' + paidStatusName + '</span>';
                    } else if (paidStatusName === 'Advance') {
                        paidBadge = '<span class="badge badge-info">' + paidStatusName + '</span>';
                    } else if (paidStatusName === 'Not Paid') {
                        paidBadge = '<span class="badge badge-danger">' + paidStatusName + '</span>';
                    } else {
                        paidBadge = '<span class="badge badge-secondary">' + paidStatusName + '</span>';
                    }
                    $("#lbl_paid_status").html(paidBadge);
                    
                    // Note: payment_method is not in purchase_order table based on schema
                    // If needed, add payment_method_id to purchase_order table
                    $("#lbl_payment_method").text("N/A");

                    // Build Product Table
                    let rows = "";
                    let calculatedSubtotal = 0;
                    
                    if (response.products && response.products.length > 0) {
                        response.products.forEach(function(item) {
                            let price = parseFloat(item.purchase_price) || 0;
                            let qty = parseFloat(item.qty) || 0;
                            let disc = parseFloat(item.discount) || 0;
                            let amount = price * qty;
                            let total = amount - disc;
                            
                            calculatedSubtotal += total;

                            rows += `<tr>
                                <td>${item.product_code || 'N/A'}</td>
                                <td class="text-uppercase">${item.product_name || 'Unknown Product'}</td>
                                <td class="text-center">${qty.toFixed(2)}</td>
                                <td class="text-right">${price.toFixed(2)}</td>
                                <td class="text-right">${amount.toFixed(2)}</td>
                                <td class="text-right">${disc.toFixed(2)}</td>
                                <td class="text-right font-weight-bold">${total.toFixed(2)}</td>
                            </tr>`;
                        });
                    } else {
                        rows = `<tr>
                            <td colspan="7" class="text-center text-muted">No products found for this purchase order</td>
                        </tr>`;
                    }
                    
                    $("#tb_po_details").html(rows);

                    // Financial Calculations
                    // Use sub_total from database if available, otherwise use calculated
                    let subTotal = parseFloat(header.sub_total) || calculatedSubtotal;
                    let vatAmount = parseFloat(header.vat_amount) || 0;
                    let paidAmount = parseFloat(header.paid_amount) || 0;
                    let grandTotal = subTotal + vatAmount;

                    $("#lbl_subtotal").text("LKR " + subTotal.toFixed(2));
                    $("#lbl_vat").text("LKR " + vatAmount.toFixed(2));
                    $("#lbl_paid_amount").text("LKR " + paidAmount.toFixed(2));
                    $("#lbl_total").text(grandTotal.toFixed(2));
                    
                } else {
                    alert("Error: " + (response.message || "Failed to load purchase order details"));
                    console.error("API Error:", response);
                }
            },
            error: function (xhr, status, error) {
                alert("Failed to connect to server. Please check your connection.");
                console.error("AJAX Error:", {
                    status: status,
                    error: error,
                    response: xhr.responseText
                });
            }
        });
    }
});