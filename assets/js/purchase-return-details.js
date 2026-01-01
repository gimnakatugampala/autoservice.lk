$(document).ready(function () {
    // Extract code from URL: ?code=XXXX
    const urlParams = new URLSearchParams(window.location.search);
    const returnCode = urlParams.get('code');

    if (returnCode) {
        getReturnDetails(returnCode);
    } else {
        alert("No return code provided in URL");
        console.error("No return code found in URL");
    }

   function getReturnDetails(code) {
    $.ajax({
        url: "../api/getpurchaseorderreturn.php",
        type: "POST",
        data: { code: code },
        dataType: "JSON",
        success: function (response) {
            console.log("Processing Data:", response);

            // Handle multiple response formats safely
            let header = null;
            if (response.status === "success") {
                header = response.header;
            } else if (response.data_content && response.data_content.length > 0) {
                header = response.data_content[0];
            } else if (response.id) {
                header = response.id;
            }

            let products = response.products || [];

            if (header) {
                // 1. Station Details
                const stationName = header.station_name || "Pistona Automotive Solutions (Pvt) Ltd";
                const addrParts = [header.station_address, header.station_street, header.station_city].filter(Boolean);
                const fullAddr = addrParts.join(", ") || "385/45, Major Wasantha Gunarathne Mw, Mahara Kadawatha";

                $("#station_name, #from_station_name").text(stationName);
                $("#station_address, #from_station_address").html(fullAddr);
                $("#station_phone, #from_station_phone").text("Tel: " + (header.station_phone || "0117600800"));
                $("#station_email, #from_station_email").text("Email: " + (header.station_email || "pistonaautomotivesolutions@gmail.com"));

                if (header.station_logo) {
                    $("#station_logo").attr("src", "../uploads/stations/" + header.station_logo);
                }

                // 2. Supplier Details
                const sName = ((header.supplier_first_name || "") + " " + (header.supplier_last_name || "")).trim();
                $("#lbl_supplier_name").text(sName || "---");
                $("#lbl_supplier_address").text(header.supplier_address || "---");
                $("#lbl_supplier_phone").text(header.supplier_phone || "---");
                $("#lbl_supplier_email").text(header.supplier_email || "---");

                // 3. Return Info
                $("#lbl_por_code").text(header.por_code || header.code || "---");
                $("#lbl_return_date").text(header.por_date || header.purchase_o_r_date || "---");
                $("#lbl_payment_method").text(header.payment_method_name || "---");

                // Status Badges
                const statusName = header.status_name || "Pending";
                $("#lbl_status").html(`<span class="badge badge-info">${statusName}</span>`);
                const paidName = header.paid_status_name || "Not Paid";
                $("#lbl_paid_status").html(`<span class="badge badge-warning">${paidName}</span>`);

                // 4. Products Table
                let rows = "";
                products.forEach(item => {
                    let price = parseFloat(item.purchase_price || 0);
                    let qty = parseFloat(item.qty || 0);
                    let disc = parseFloat(item.discount || 0);
                    let total = (price * qty) - disc;

                    rows += `<tr>
                        <td>${item.product_code || 'N/A'}</td>
                        <td class="text-uppercase">${item.product_name || 'N/A'}</td>
                        <td class="text-center">${qty}</td>
                        <td class="text-right">${price.toFixed(2)}</td>
                        <td class="text-right">${(price * qty).toFixed(2)}</td>
                        <td class="text-right">${disc.toFixed(2)}</td>
                        <td class="text-right font-weight-bold">${total.toFixed(2)}</td>
                    </tr>`;
                });
                $("#tb_return_details").html(rows);

                // 5. Totals
                const sub = parseFloat(header.sub_total || 0);
                const vat = parseFloat(header.vat_amount || 0);
                $("#lbl_subtotal").text("LKR " + sub.toFixed(2));
                $("#lbl_vat").text("LKR " + vat.toFixed(2));
                $("#lbl_total").text((sub + vat).toFixed(2));

            } else {
                alert("Data structure error: Check console");
            }
        }
    });
}
});