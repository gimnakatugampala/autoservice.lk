$(document).ready(function() {
    $('body').on('click', '.btn-view-invoice', function() {
        var jobCardId = $(this).data('id');
        console.log("Fetching invoice for ID:", jobCardId);

        // Target the table body safely
        var tbody = $('#invoice-items-body');
        
        // Safety Check: Does the table body exist?
        if (tbody.length === 0) {
            alert("Error: HTML element #invoice-items-body is missing!");
            return;
        }

        // Show loading spinner
        tbody.html('<tr><td colspan="6" class="text-center text-muted"><i class="fas fa-spinner fa-spin mr-2"></i>Loading...</td></tr>');
        
        // Reset totals
        $('#mdl_subtotal').text('...');
        $('#mdl_vat_amount').text('...');
        $('#mdl_grand_total').text('...');

        $.ajax({
            url: '../api/get-invoice-details.php',
            type: 'POST',
            data: { id: jobCardId },
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    var data = response.data;
                    var items = response.items;
                    var totals = response.totals;

                    // 1. Station Info
                    $('#mdl_in_station_name').text(data.service_name);
                    $('#mdl_in_station_address').text((data.st_address||'') + ', ' + (data.st_city||''));
                    $('#mdl_in_station_phone').text(data.st_phone);
                    $('#mdl_in_station_email').text(data.st_email);
                    var logo = data.logo ? '../uploads/stations/' + data.logo : '../dist/img/system/logo_default.png';
                    $('#mdl_in_station_logo').attr('src', logo);

                    // 2. Customer & Vehicle Info
                    $('#mdl_in_jobcard_no').text(data.job_card_code);
                    $('#mdl_in_vehicle_owner').text(data.first_name + ' ' + data.last_name);
                    $('#mdl_in_address').text(data.vo_address);
                    $('#mdl_in_contact_number').text(data.vo_phone);
                    $('#mdl_in_vat').text(parseFloat(data.vat).toFixed(1));
                    $('#mdl_in_vehicle_no').text(data.vehicle_number);
                    $('#mdl_in_make').text(data.make_name);
                    $('#mdl_in_model').text(data.model_name);
                    $('#mdl_in_current_mileage').text(data.current_mileage + ' KM');
                    $('#mdl_in_invoice_no').text(data.invoice_code || 'N/A');
                    $('#mdl_in_job_card_type').text(data.job_type);
                    $('#mdl_in_engine_no').text(data.engine_number);
                    $('#mdl_in_chassis_no').text(data.chassis_number);
                    $('#mdl_in_opening_date').text(data.job_date);
                    $('#mdl_in_next_mileage').text((data.next_mileage || 0) + ' KM');

                    // 3. Populate Items
                    var html = '';
                    if(items.length > 0) {
                        $.each(items, function(i, item) {
                            var total = (item.qty * item.price) - item.discount;
                            html += `<tr>
                                <td>${item.code || '-'}</td>
                                <td>${item.name}</td>
                                <td class="text-center">${item.qty}</td>
                                <td class="text-right">${item.price.toFixed(2)}</td>
                                <td class="text-right">${item.discount.toFixed(2)}</td>
                                <td class="text-right font-weight-bold">${total.toFixed(2)}</td>
                            </tr>`;
                        });
                    } else {
                        html = '<tr><td colspan="6" class="text-center text-muted">No items found.</td></tr>';
                    }
                    tbody.html(html);

                    // 4. Populate Totals
                    $('#mdl_subtotal').text('LKR ' + totals.subtotal.toFixed(2));
                    $('#mdl_vat_amount').text(totals.vat_percent + '% (LKR ' + totals.vat_amount.toFixed(2) + ')');
                    $('#mdl_grand_total').text('LKR ' + totals.grand_total.toFixed(2));

                } else {
                    tbody.html('<tr><td colspan="6" class="text-center text-danger">Error: ' + response.message + '</td></tr>');
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                tbody.html('<tr><td colspan="6" class="text-center text-danger">Server Error. Check Console.</td></tr>');
            }
        });
    });
});