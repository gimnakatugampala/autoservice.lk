$(document).ready(function() {
    $('body').on('click', '.btn-view-invoice', function() {
        var jobCardId = $(this).data('id');
        console.log("Clicked Invoice. ID:", jobCardId); // DEBUG LOG

        var tbody = $('#invoice-items-body');
        
        // Error check: Missing ID
        if (!jobCardId) {
            console.error("No Data-ID found on button");
            alert("Error: Cannot fetch invoice. ID is missing.");
            return;
        }

        // Error check: Table body missing
        if(tbody.length === 0) {
            console.error('Invoice table body with id="invoice-items-body" not found.');
            // Fallback for debugging
            $('.invoice table tbody').html('<tr><td colspan="6">Error: Missing #invoice-items-body</td></tr>');
            return;
        }
        
        // Show loading
        tbody.html('<tr><td colspan="6" class="text-center text-muted"><i class="fas fa-spinner fa-spin mr-2"></i>Loading invoice details...</td></tr>');
        $('#mdl_subtotal, #mdl_vat_amount, #mdl_grand_total').text('...');

        $.ajax({
            url: '../api/get-invoice-details.php',
            type: 'POST',
            data: { id: jobCardId },
            dataType: 'json',
            success: function(response) {
                console.log("Server Response:", response); // DEBUG LOG

                if(response.success) {
                    var data = response.data;
                    var items = response.items;
                    var totals = response.totals;

                    // 1. Station
                    $('#mdl_in_station_name').text(data.service_name);
                    $('#mdl_in_station_address').text((data.st_address || '') + ', ' + (data.st_city || ''));
                    $('#mdl_in_station_phone').text(data.st_phone);
                    $('#mdl_in_station_email').text(data.st_email);
                    var logoSrc = data.logo ? '../uploads/stations/' + data.logo : '../dist/img/system/logo_default.png';
                    $('#mdl_in_station_logo').attr('src', logoSrc);

                    // 2. Customer
                    $('#mdl_in_jobcard_no').text(data.job_card_code);
                    $('#mdl_in_vehicle_owner').text(data.first_name + ' ' + data.last_name);
                    $('#mdl_in_address').text(data.vo_address || 'N/A');
                    $('#mdl_in_contact_number').text(data.vo_phone || 'N/A');
                    $('#mdl_in_vat').text(parseFloat(data.vat).toFixed(1));
                    
                    // 3. Vehicle
                    $('#mdl_in_invoice_no').text(data.invoice_code || 'N/A');
                    $('#mdl_in_vehicle_no').text(data.vehicle_number);
                    $('#mdl_in_make').text(data.make_name || '-');
                    $('#mdl_in_model').text(data.model_name || '-');
                    $('#mdl_in_current_mileage').text(data.current_mileage + ' KM');
                    $('#mdl_in_job_card_type').text(data.job_type);
                    $('#mdl_in_engine_no').text(data.engine_number || '-');
                    $('#mdl_in_chassis_no').text(data.chassis_number || '-');
                    
                    // 4. Items
                    var itemsHtml = '';
                    if(items && items.length > 0) {
                        $.each(items, function(index, item) {
                            var lineTotal = (item.price * item.qty) - item.discount;
                            itemsHtml += `
                                <tr>
                                    <td><small class="text-muted">${item.code || '-'}</small></td>
                                    <td>${item.name}</td>
                                    <td class="text-center">${item.qty}</td>
                                    <td class="text-right">${item.price.toFixed(2)}</td>
                                    <td class="text-right">${item.discount.toFixed(2)}</td>
                                    <td class="text-right font-weight-bold text-dark">${lineTotal.toFixed(2)}</td>
                                </tr>
                            `;
                        });
                    } else {
                        itemsHtml = '<tr><td colspan="6" class="text-center text-muted font-italic">No items found for this invoice.</td></tr>';
                    }
                    tbody.html(itemsHtml);

                    // 5. Totals
                    $('#mdl_subtotal').text('LKR ' + totals.subtotal.toFixed(2));
                    $('#mdl_vat_amount').text(totals.vat_percent + '% (LKR ' + totals.vat_amount.toFixed(2) + ')');
                    $('#mdl_grand_total').text('LKR ' + totals.grand_total.toFixed(2));

                } else {
                    tbody.html('<tr><td colspan="6" class="text-center text-danger">Error: ' + response.message + '</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", xhr.responseText);
                tbody.html('<tr><td colspan="6" class="text-center text-danger">Server Error. Check Console.</td></tr>');
            }
        });
    });
});