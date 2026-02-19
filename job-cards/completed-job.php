<?php include_once '../includes/header.php';?>
<?php include_once '../api/completed-jobcard-list.php';?>

<style>
    .content-wrapper { background-color: #f4f6f9; }
    .card-success.card-outline { border-top: 3px solid #28a745; }
    .table thead th { border-bottom: 2px solid #dee2e6; text-transform: uppercase; font-size: 0.8rem; }
    .invoice { border: 1px solid #ebedef; border-radius: 5px; background-color: #fff; }
    .invoice-header-bg { background-color: #f8f9fa; padding: 15px; border-bottom: 1px solid #dee2e6; margin-bottom: 20px; }
    .btn-action-sm { width: 35px; height: 35px; padding: 0; display: inline-flex; align-items: center; justify-content: center; }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include_once '../includes/loader.php';?>
  <?php include_once '../includes/navbar.php'; ?>
  <?php include_once '../includes/sidebar.php';?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1 class="m-0 font-weight-bold text-dark"><i class="fas fa-check-double mr-2 text-success"></i>Completed Job Card List</h1>
          </div>
          <div class="col-sm-2">
            <a href="../job-cards/add-job-card.php" class="btn btn-block btn-primary elevation-2">
                <i class="fas fa-plus-circle mr-1"></i> Add Job Card
            </a>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-success card-outline shadow-sm">
              <div class="card-header">
                <h3 class="card-title text-bold"><i class="fas fa-history mr-2"></i> Finished Service Records</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-hover table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>Job Card Code</th>
                    <th>Vehicle Owner</th>
                    <th>Phone</th>
                    <th>Vehicle Name</th>
                    <th>Job Type</th>
                    <th>Placed Date</th>
                    <th>Completed Date</th>
                    <th class="text-center">Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($jobcards as $row) : ?>
                    <tr>
                      <td class="font-weight-bold text-success"><?php echo $row["job_card_code"]; ?></td>
                      <td class="text-uppercase"><?php echo $row["first_name"]; ?> <?php echo $row["last_name"]; ?></td>
                      <td><i class="fas fa-phone-alt mr-1 text-muted small"></i> <?php echo $row["phone"]; ?></td>
                      <td><span class="badge badge-secondary px-2 py-1"><?php echo $row["vehicle_number"]; ?></span></td>
                      <td>
                          <span class="badge <?php echo ($row['JOB_CARD_TYPE'] == 'Service') ? 'badge-success' : 'badge-info'; ?> shadow-none">
                              <?php echo $row["JOB_CARD_TYPE"]; ?>
                          </span>
                      </td>
                      <td class="text-muted small"><?php echo $row["JOB_CARD_PLACED_DATE"]; ?></td>
                      <td class="text-dark small font-weight-bold"><?php echo $row["COMPLETED_DATE"]; ?></td>
                      <td class="text-center">
                       <button type="button" class="btn btn-info btn-action-sm shadow-sm btn-view-jobcard"
        data-id="<?php echo $row['jc_id']; ?>" data-toggle="modal" data-target="#modal-jobcard-details"
        title="View Job Card Details">
    <i class="fas fa-clipboard-list" aria-hidden="true"></i>
</button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- ===== Job Card Details Modal (Invoice Style) ===== -->
  <div class="modal fade" id="modal-jobcard-details">
    <div class="modal-dialog modal-xl">
      <div class="modal-content shadow-lg">

        <div class="modal-header bg-dark text-white border-0">
          <h4 class="modal-title font-weight-bold"><i class="fas fa-clipboard-list mr-2"></i>Job Card Details</h4>
          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body p-0">
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12 p-4">
                  <div class="invoice p-0 mb-3 shadow-none border-0">

                    <!-- Loading -->
                    <div id="jc-loading" class="text-center py-5">
                      <div class="spinner-border text-secondary" role="status"></div>
                      <p class="mt-2 text-muted">Loading job card details...</p>
                    </div>

                    <!-- Error -->
                    <div id="jc-error" class="alert alert-danger mx-3" style="display:none;">
                      <i class="fas fa-exclamation-triangle mr-2"></i>
                      Failed to load job card details. Please try again.
                    </div>

                    <!-- Content -->
                    <div id="jc-content" style="display:none;">

                      <!-- Station Header -->
                      <div class="invoice-header-bg bg-white border-bottom pb-3 mb-4">
                        <div class="row align-items-center">
                          <div class="col-md-3 text-center text-md-left">
                            <img id="jc_station_logo"
                                 style="max-height: 100px; width: auto; max-width: 100%; object-fit: contain;"
                                 src="../dist/img/system/logo_default.png"
                                 alt="Station Logo">
                          </div>
                          <div class="col-md-9 text-center text-md-right pl-md-4">
                            <h2 class="m-0 font-weight-bold text-dark text-uppercase" style="letter-spacing: 1px;">
                              <span id="jc_station_name"></span>
                            </h2>
                            <p class="text-muted mb-1 font-weight-bold text-uppercase" style="font-size: 0.9rem;">
                              <span id="jc_station_address"></span>
                            </p>
                            <div class="small text-muted">
                              <span class="d-inline-block mr-3">
                                <i class="fas fa-phone-alt mr-1 text-success"></i>
                                <span id="jc_station_phone"></span>
                              </span>
                              <span class="d-inline-block">
                                <i class="fas fa-envelope mr-1 text-primary"></i>
                                <span id="jc_station_email"></span>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Customer & Vehicle Info -->
                      <div class="row invoice-info px-4 mb-4">
                        <div class="col-sm-6 invoice-col border-right">
                          <p class="lead text-primary text-bold mb-2">Customer Information</p>
                          <address class="mb-0">
                            <b>Job Card:</b> <span id="jc_code" class="text-primary font-weight-bold">-</span><br>
                            <b>Owner:</b> <span class="text-uppercase" id="jc_owner">-</span><br>
                            <b>Address:</b> <span class="text-uppercase" id="jc_address">-</span><br>
                            <b>Phone:</b> <span id="jc_phone">-</span><br>
                            <b>VAT:</b> <span id="jc_vat_pct">0</span>%
                          </address>
                        </div>
                        <div class="col-sm-6 invoice-col pl-sm-4">
                          <p class="lead text-primary text-bold mb-2">Vehicle Information</p>
                          <div class="row">
                            <div class="col-6">
                              <b>Invoice #:</b> <span class="text-uppercase" id="jc_invoice_no">-</span><br>
                              <b>Vehicle:</b> <span class="text-uppercase text-bold" id="jc_vehicle_no">-</span><br>
                              <b>Make:</b> <span class="text-uppercase" id="jc_make">-</span><br>
                              <b>Model:</b> <span class="text-uppercase" id="jc_model">-</span>
                            </div>
                            <div class="col-6">
                              <b>Mileage:</b> <span id="jc_mileage">-</span><br>
                              <b>Type:</b> <span class="badge badge-warning text-uppercase" id="jc_type">-</span><br>
                              <b>Engine:</b> <span id="jc_engine">-</span><br>
                              <b>Chassis:</b> <span id="jc_chassis">-</span>
                            </div>
                          </div>
                          <div class="mt-2 small text-muted">
                            <b>Opened:</b> <span id="jc_placed_date">-</span> |
                            <b>Completed:</b> <span id="jc_completed_date">-</span> |
                            <b>Next Serv:</b> <span id="jc_next_mileage">-</span>
                          </div>
                        </div>
                      </div>

                      <!-- Items Table -->
                      <div class="row px-4">
                        <div class="col-12 table-responsive">
                          <table class="table table-striped table-bordered">
                            <thead class="bg-light">
                              <tr>
                                <th>Code</th>
                                <th>Item Description</th>
                                <th class="text-center">QTY / Hrs</th>
                                <th class="text-right">Unit Price</th>
                                <th class="text-right">Discount</th>
                                <th class="text-right">Total (LKR)</th>
                              </tr>
                            </thead>
                            <tbody id="jc-items-body"></tbody>
                          </table>
                        </div>
                      </div>

                      <!-- Totals + Payment Methods -->
                      <div class="row px-4 mt-4">
                        <div class="col-6">
                          <!-- <p class="lead font-weight-bold mb-1">Payment Methods:</p>
                          <img src="../dist/img/credit/visa.png" alt="Visa" class="mr-1">
                          <img src="../dist/img/credit/mastercard.png" alt="Mastercard" class="mr-1">
                          <img src="../dist/img/credit/american-express.png" alt="American Express" class="mr-1">
                          <img src="../dist/img/credit/paypal2.png" alt="Paypal"> -->
                          <p class="text-muted bg-light p-2 rounded mt-3" style="font-size: 0.8rem; border-left: 3px solid #adb5bd;">
                            Thank you for choosing our Service Station.
                          </p>
                        </div>
                        <div class="col-6">
                          <div class="table-responsive">
                            <table class="table table-borderless">
                              <tr>
                                <th class="text-right" style="width:50%">Subtotal:</th>
                                <td class="text-right font-weight-bold" id="jc_subtotal">LKR 0.00</td>
                              </tr>
                              <tr>
                                <th class="text-right">VAT (%)</th>
                                <td class="text-right font-weight-bold" id="jc_vat_amount">0.00 %</td>
                              </tr>
                              <tr class="border-top border-bottom">
                                <th class="text-right h4 text-bold text-primary">Total:</th>
                                <td class="text-right h4 text-bold text-primary" id="jc_grand_total">LKR 0.00</td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>

                      <!-- Print Button -->
                      <div class="row no-print px-4 pb-4 mt-3">
                        <div class="col-12 text-right">
                          <button type="button" onclick="window.print()" class="btn btn-default shadow-sm">
                            <i class="fas fa-print"></i> Print
                          </button>
                        </div>
                      </div>

                    </div><!-- /#jc-content -->
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div><!-- /.modal-body -->

      </div>
    </div>
  </div>
  <!-- ================================================= -->

  <?php include_once '../includes/sub-footer.php';?>
  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<?php include_once '../includes/footer.php';?>
<script src="../assets/js/invoice-modal.js"></script>

<script>
  $(function () {
    if (!$.fn.DataTable.isDataTable('#example1')) {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "order": [[6, "desc"]]
      });
    }
    $('[data-toggle="tooltip"]').tooltip();
  });

  // ── View Job Card Details ───────────────────────────────────────────
  $(document).on('click', '.btn-view-jobcard', function () {
    var jobCardId = $(this).data('id');

    // Reset state
    $('#jc-loading').show();
    $('#jc-content').hide();
    $('#jc-error').hide();
    $('#jc-items-body').empty();

    $.ajax({
      url: '../api/get-jobcard-details.php',
      type: 'GET',
      data: { id: jobCardId },
      dataType: 'json',
      success: function (res) {
        if (!res.success) {
          $('#jc-loading').hide();
          $('#jc-error').show();
          return;
        }

        // ── Station info — loaded directly from API response ────────
        var s = res.station || {};
        $('#jc_station_name').text(s.service_name   || '');
        $('#jc_station_address').text(s.full_address || '');
        $('#jc_station_phone').text(s.phone          || '');
        $('#jc_station_email').text(s.email          || '');
       // Update Logo Path logic
          if (s.logo && s.logo !== '') {
              // Points to your uploads folder + the filename from database
              $('#jc_station_logo').attr('src', '../uploads/stations/' + s.logo);
          } else {
              // Fallback to default if no logo exists
              $('#jc_station_logo').attr('src', '../dist/img/system/logo_default.png');
          }

        // ── Job card data ───────────────────────────────────────────
        var d = res.data;

        $('#jc_code').text(d.job_card_code || '—');
        $('#jc_owner').text(((d.first_name || '') + ' ' + (d.last_name || '')).trim());
        $('#jc_address').text(d.address || '—');
        $('#jc_phone').text(d.phone || '—');
        $('#jc_vat_pct').text(parseFloat(d.vat || 0).toFixed(2));

        $('#jc_invoice_no').text(d.invoice_no || '—');
        $('#jc_vehicle_no').text(d.vehicle_number || '—');
        $('#jc_make').text(d.make || '—');
        $('#jc_model').text(d.model || '—');
        $('#jc_mileage').text(d.current_mileage ? d.current_mileage + ' km' : '—');
        $('#jc_type').text(d.JOB_CARD_TYPE || '—');
        $('#jc_engine').text(d.engine_no || '—');
        $('#jc_chassis').text(d.chassis_no || '—');

        $('#jc_placed_date').text(d.JOB_CARD_PLACED_DATE || '—');
        $('#jc_completed_date').text(d.COMPLETED_DATE || '—');
        $('#jc_next_mileage').text(d.next_mileage ? d.next_mileage + ' km' : '—');

        // ── Items ───────────────────────────────────────────────────
        var items    = res.items || [];
        var subtotal = 0;

        if (items.length === 0) {
          $('#jc-items-body').html('<tr><td colspan="6" class="text-center text-muted py-3">No items found.</td></tr>');
        } else {
          $.each(items, function (i, item) {
            var qty       = parseFloat(item.qty)        || 0;
            var unitPrice = parseFloat(item.unit_price) || 0;
            var discount  = parseFloat(item.discount)   || 0;
            var lineTotal = (qty * unitPrice) - discount;
            subtotal     += lineTotal;

            $('#jc-items-body').append(
              '<tr>' +
                '<td>' + (item.item_code || '—') + '</td>' +
                '<td>' + (item.item_name  || '—') + '</td>' +
                '<td class="text-center">' + qty + '</td>' +
                '<td class="text-right">LKR ' + unitPrice.toFixed(2) + '</td>' +
                '<td class="text-right">LKR ' + discount.toFixed(2) + '</td>' +
                '<td class="text-right font-weight-bold">LKR ' + lineTotal.toFixed(2) + '</td>' +
              '</tr>'
            );
          });
        }

        // ── Totals ──────────────────────────────────────────────────
        var vatPercent = parseFloat(d.vat || 0);
        var vatAmount  = subtotal * (vatPercent / 100);
        var grandTotal = subtotal + vatAmount;

        $('#jc_subtotal').text('LKR ' + subtotal.toFixed(2));
        $('#jc_vat_amount').text(vatPercent.toFixed(2) + ' %');
        $('#jc_grand_total').text('LKR ' + grandTotal.toFixed(2));

        $('#jc-loading').hide();
        $('#jc-content').fadeIn();
      },
      error: function () {
        $('#jc-loading').hide();
        $('#jc-error').show();
      }
    });
  });
</script>

</body>
</html>