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
                        <button type="button" class="btn btn-primary btn-action-sm shadow-sm btn-view-invoice" 
                                data-id="<?php echo $row['id']; ?>" 
                                data-toggle="modal" data-target="#modal-xl" title="View Full Invoice">
                            <i class="fa fa-file-invoice" aria-hidden="true"></i>
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

  <div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
      <div class="modal-content shadow-lg">
        <div class="modal-header bg-dark text-white border-0">
          <h4 class="modal-title font-weight-bold"><i class="fas fa-receipt mr-2"></i>Invoice Details</h4>
          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body p-0">
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12 p-4">
                  <div class="invoice p-0 mb-3 shadow-none border-0">
                    
                    <div class="invoice-header-bg bg-white border-bottom pb-3 mb-4">
  <div class="row align-items-center">
    <div class="col-md-3 text-center text-md-left">
      <img id="mdl_in_station_logo" 
           style="max-height: 100px; width: auto; max-width: 100%; object-fit: contain;" 
           src="../dist/img/system/logo_default.png" 
           alt="Station Logo">
    </div>
    
    <div class="col-md-9 text-center text-md-right pl-md-4">
      <h2 class="m-0 font-weight-bold text-dark text-uppercase" style="letter-spacing: 1px;">
        <span id="mdl_in_station_name">Station Name Loading...</span>
      </h2>
      
      <p class="text-muted mb-1 font-weight-bold text-uppercase" style="font-size: 0.9rem;">
        <span id="mdl_in_station_address">Address Loading...</span>
      </p>
      
      <div class="small text-muted">
        <span class="d-inline-block mr-3">
            <i class="fas fa-phone-alt mr-1 text-success"></i> 
            <span id="mdl_in_station_phone">...</span>
        </span>
        <span class="d-inline-block">
            <i class="fas fa-envelope mr-1 text-primary"></i> 
            <span id="mdl_in_station_email">...</span>
        </span>
      </div>
    </div>
  </div>
</div>

                    <div class="row invoice-info px-4 mb-4">
                      <div class="col-sm-6 invoice-col border-right">
                        <p class="lead text-primary text-bold mb-2">Customer Information</p>
                        <address class="mb-0">
                          <b>Job Card:</b> <span id="mdl_in_jobcard_no" class="text-primary font-weight-bold">-</span><br>
                          <b>Owner:</b> <span class="text-uppercase" id="mdl_in_vehicle_owner">-</span><br>
                          <b>Address:</b> <span class="text-uppercase" id="mdl_in_address">-</span><br />
                          <b>Phone:</b> <span id="mdl_in_contact_number">-</span><br />
                          <b>VAT:</b> <span id="mdl_in_vat">0</span>%<br />
                        </address>
                      </div>
                      <div class="col-sm-6 invoice-col pl-sm-4">
                        <p class="lead text-primary text-bold mb-2">Vehicle Information</p>
                        <div class="row">
                          <div class="col-6">
                            <b>Invoice #:</b> <span class="text-uppercase" id="mdl_in_invoice_no">-</span><br>
                            <b>Vehicle:</b> <span class="text-uppercase text-bold" id="mdl_in_vehicle_no">-</span><br>
                            <b>Make:</b> <span class="text-uppercase" id="mdl_in_make">-</span><br />
                            <b>Model:</b> <span class="text-uppercase" id="mdl_in_model">-</span>
                          </div>
                          <div class="col-6">
                            <b>Mileage:</b> <span id="mdl_in_current_mileage">-</span><br />
                            <b>Type:</b> <span class="badge badge-warning text-uppercase" id="mdl_in_job_card_type">-</span><br />
                            <b>Engine:</b> <span id="mdl_in_engine_no">-</span><br />
                            <b>Chassis:</b> <span id="mdl_in_chassis_no">-</span>
                          </div>
                        </div>
                        <div class="mt-2 small text-muted">
                          <b>Opened:</b> <span id="mdl_in_opening_date">-</span> | <b>Next Serv:</b> <span id="mdl_in_next_mileage">-</span>
                        </div>
                      </div>
                    </div>

                    <div class="row px-4">
                      <div class="col-12 table-responsive">
                        <table class="table table-striped table-bordered">
                          <thead class="bg-light">
                            <tr>
                              <th>Code</th>
                              <th>Item Description</th>
                              <th class="text-center">QTY/Hrs</th>
                              <th class="text-right">Unit Price</th>
                              <th class="text-right">Discount</th>
                              <th class="text-right">Total (LKR)</th>
                            </tr>
                          </thead>
                          <tbody id="invoice-items-body">
                            </tbody>
                        </table>
                      </div>
                    </div>

                    <div class="row px-4 mt-4">
                      <div class="col-6">
                        <p class="lead font-weight-bold mb-1">Payment Methods:</p>
                        <img src="../dist/img/credit/visa.png" alt="Visa" class="mr-1">
                        <img src="../dist/img/credit/mastercard.png" alt="Mastercard" class="mr-1">
                        <img src="../dist/img/credit/american-express.png" alt="American Express" class="mr-1">
                        <img src="../dist/img/credit/paypal2.png" alt="Paypal">
                        <p class="text-muted bg-light p-2 rounded mt-3" style="font-size: 0.8rem; border-left: 3px solid #adb5bd;">
                          Thank you for choosing ABC Service Station.
                        </p>
                      </div>
                      <div class="col-6">
                        <div class="table-responsive">
                          <table class="table table-borderless">
                            <tr>
                              <th class="text-right" style="width:50%">Subtotal:</th>
                              <td class="text-right font-weight-bold" id="mdl_subtotal">LKR 0.00</td>
                            </tr>
                            <tr>
                              <th class="text-right">VAT (%)</th>
                              <td class="text-right font-weight-bold" id="mdl_vat_amount">0.00 %</td>
                            </tr>
                            <tr class="border-top border-bottom">
                              <th class="text-right h4 text-bold text-primary">Total:</th>
                              <td class="text-right h4 text-bold text-primary" id="mdl_grand_total">LKR 0.00</td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>

                    <div class="row no-print px-4 pb-4 mt-3">
                      <div class="col-12 text-right">
                        <button type="button" onclick="window.print()" class="btn btn-default shadow-sm"><i class="fas fa-print"></i> Print</button>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>

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
</script>

</body>
</html>