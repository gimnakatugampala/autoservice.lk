$(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    const returnCode = urlParams.get('code');

    if (returnCode) {
        getReturnDetails(returnCode);
    } else {
        alert("Error: No return code found in the URL.");
    }

    function getReturnDetails(code) {
        $.ajax({
            url: "../api/getpurchaseorderreturndetails.php",
            type: "POST",
            data: { code: code },
            dataType: "JSON",
            success: function (response) {
                if (response.status === "success") {
                    const header = response.header;
                    const products = response.products || [];

                    // 1. Update Station Info
                    $("#station_name, #from_station_name").text(header.station_name || "Pistona Automotive");
                    const fullAddr = [header.station_address, header.station_street, header.station_city].filter(Boolean).join(", ");
                    $("#station_address, #from_station_address").text(fullAddr || "Address not set");
                    $("#station_phone, #from_station_phone").text("Tel: " + (header.station_phone || "N/A"));
                    $("#station_email, #from_station_email").text("Email: " + (header.station_email || "N/A"));

                    if (header.station_logo) {
                        $("#station_logo").attr("src", "../uploads/stations/" + header.station_logo);
                    }

                    // 2. Update Supplier Info
                    const supplierFull = (header.supplier_first_name || "") + " " + (header.supplier_last_name || "");
                    $("#lbl_supplier_name").text(supplierFull.trim() || "Unknown Supplier");
                    $("#lbl_supplier_address").text(header.supplier_address || "N/A");
                    $("#lbl_supplier_phone").text(header.supplier_phone || "N/A");
                    $("#lbl_supplier_email").text(header.supplier_email || "N/A");

                    // 3. Return Metadata
                    $("#lbl_por_code").text(header.por_code);
                    $("#lbl_return_date").text(header.por_date);
                    $("#lbl_payment_method").text(header.payment_method_name || "Not Specified");
                    $("#lbl_note").text(header.note || "No notes provided");

                    // Status Badges
                    const sName = header.status_name || "Pending";
                    const sClass = sName.toLowerCase() === 'completed' ? 'badge-success' : 'badge-warning';
                    $("#lbl_status").html(`<span class="badge ${sClass}">${sName}</span>`);

                    const pName = header.paid_status_name || "Not Paid";
                    const pClass = pName.toLowerCase() === 'paid' ? 'badge-success' : 'badge-danger';
                    $("#lbl_paid_status").html(`<span class="badge ${pClass}">${pName}</span>`);

                    // 4. Populate Items Table
                    let rows = "";
                    if (products.length > 0) {
                        products.forEach(item => {
                            const unitPrice = parseFloat(item.purchase_price || 0);
                            const qty = parseFloat(item.qty || 0);
                            const disc = parseFloat(item.discount || 0);
                            const amount = unitPrice * qty;
                            const total = amount - disc;

                            rows += `<tr>
                                <td>${item.product_code}</td>
                                <td>${item.product_name}</td>
                                <td class="text-center">${qty}</td>
                                <td class="text-right">${unitPrice.toFixed(2)}</td>
                                <td class="text-right">${amount.toFixed(2)}</td>
                                <td class="text-right">${disc.toFixed(2)}</td>
                                <td class="text-right"><strong>${total.toFixed(2)}</strong></td>
                            </tr>`;
                        });
                    } else {
                        rows = '<tr><td colspan="7" class="text-center">No items found for this return.</td></tr>';
                    }
                    $("#tb_return_details").html(rows);

                    // 5. Totals
                    const sub = parseFloat(header.sub_total || 0);
                    const vat = parseFloat(header.vat_amount || 0);
                    $("#lbl_subtotal").text("LKR " + sub.toFixed(2));
                    $("#lbl_vat").text("LKR " + vat.toFixed(2));
                    $("#lbl_total").text((sub + vat).toFixed(2));

                } else {
                    alert(response.message);
                }
            },
            error: function (xhr) {
                console.error("Critical Error:", xhr.responseText);
                alert("An error occurred while communicating with the server.");
            }
        });
    }
});