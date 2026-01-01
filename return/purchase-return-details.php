<?php include_once '../includes/header.php';?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include_once '../includes/loader.php';?>
  <?php include_once '../includes/navbar.php'; ?>
  <?php include_once '../includes/sidebar.php';?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Purchase Return Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../return/">Manage Returns</a></li>
              <li class="breadcrumb-item active">Return Details</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="card">
              <div class="card-body">
                <div class="invoice p-3 mb-3">
                  
                  <!-- Company Header -->
                  <div class="row">
                    <div class="col-12">
                      <div class="row mb-4 justify-content-center">
                        <div class="col-auto text-center">
                          <img id="station_logo" width="100" src="../assets/img/system/autoservice_logo.jpg" alt="Station Logo" 
                               onerror="this.onerror=null; this.src='../dist/img/system/logo_pistona.png';" class="mb-3">
                          <h4 class="m-0 text-uppercase">
                            <strong id="station_name">Pistona Automotive Solutions (Pvt) Ltd</strong>
                          </h4>
                          <address class="mt-2">
                            <span id="station_address">385/45, Major Wasantha Gunarathne Mw, Mahara Kadawatha</span><br>
                            <span id="station_phone">Tel: 0117600800</span><br>
                            <span id="station_email">Email: pistonaautomotivesolutions@gmail.com</span>
                          </address>
                        </div>
                      </div>
                    </div>
                  </div>

                  <hr>

                  <!-- Document Title -->
                  <div class="row mb-3">
                    <div class="col-12 text-center">
                       <h4 class="text-uppercase"><strong>Purchase Order Return</strong></h4>
                    </div>
                  </div>

                  <!-- Invoice Information Row -->
                  <div class="row invoice-info mb-4">
                    <div class="col-sm-4 invoice-col border-right">
                      <strong>From (Station)</strong>
                      <address class="mt-2">
                        <strong><span id="from_station_name">Autoservice.lk</span></strong><br>
                        <span id="from_station_address">Station Location Details</span><br>
                        Phone: <span id="from_station_phone">(XXX) XXX-XXXX</span><br>
                        Email: <span id="from_station_email">info@autoservice.lk</span>
                      </address>
                    </div>
                    
                    <div class="col-sm-4 invoice-col border-right">
                      <strong>To (Supplier)</strong>
                      <address class="mt-2">
                        <strong id="lbl_supplier_name">---</strong><br>
                        <span id="lbl_supplier_address">---</span><br>
                        Phone: <span id="lbl_supplier_phone">---</span><br>
                        Email: <span id="lbl_supplier_email">---</span>
                      </address>
                    </div>
                    
                    <div class="col-sm-4 invoice-col">
                      <strong>Return Information</strong>
                      <div class="mt-2">
                        <table class="table table-sm table-borderless">
                          <tr>
                            <td width="50%"><strong>Return Code:</strong></td>
                            <td id="lbl_por_code">---</td>
                          </tr>
                          <tr>
                            <td><strong>Return Date:</strong></td>
                            <td id="lbl_return_date">---</td>
                          </tr>
                          <tr>
                            <td><strong>Status:</strong></td>
                            <td id="lbl_status">---</td>
                          </tr>
                          <tr>
                            <td><strong>Payment:</strong></td>
                            <td id="lbl_paid_status">---</td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>

                  <!-- Products Table -->
                  <div class="row mt-4">
                    <div class="col-12">
                      <h5><strong>Return Items</strong></h5>
                      <div class="table-responsive mt-3">
                        <table class="table table-bordered table-hover">
                          <thead class="thead-light">
                            <tr>
                              <th width="10%">Code</th>
                              <th>Item Description</th>
                              <th width="8%" class="text-center">QTY</th>
                              <th width="12%" class="text-right">Unit Price (LKR)</th>
                              <th width="12%" class="text-right">Amount (LKR)</th>
                              <th width="12%" class="text-right">Discount (LKR)</th>
                              <th width="12%" class="text-right">Total (LKR)</th>
                            </tr>
                          </thead>
                          <tbody id="tb_return_details">
                            <tr>
                              <td colspan="7" class="text-center text-muted">
                                Loading return details...
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                  <!-- Totals and Notes -->
                  <div class="row mt-4">
                    <div class="col-6">
                      <p class="lead">
                        <strong>Return Method:</strong> 
                        <span id="lbl_payment_method">---</span>
                      </p>
                      <div class="mt-3 p-3" style="background: #f8f9fa; border-left: 3px solid #dc3545;">
                        <strong>Note:</strong> <span id="lbl_note">No notes provided</span>
                      </div>
                    </div>
                    
                    <div class="col-6">
                      <div class="table-responsive">
                        <table class="table">
                          <tr>
                            <th width="50%">Subtotal:</th>
                            <td class="text-right" id="lbl_subtotal">LKR 0.00</td>
                          </tr>
                          <tr>
                            <th>VAT:</th>
                            <td class="text-right" id="lbl_vat">LKR 0.00</td>
                          </tr>
                          <tr class="border-top">
                            <th class="text-lg text-danger"><strong>Net Refund Total:</strong></th>
                            <td class="text-right text-lg text-danger">
                              <strong>LKR <span id="lbl_total">0.00</span></strong>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <!-- Action Buttons Footer -->
              <div class="card-footer no-print">
                <button type="button" class="btn btn-default" onclick="window.print();">
                  <i class="fas fa-print"></i> Print
                </button>
                <button type="button" class="btn btn-primary float-right" onclick="window.history.back();">
                  <i class="fas fa-arrow-left"></i> Back to Returns
                </button>
              </div>

            </div>

          </div>
        </div>
      </div>
    </section>
  </div>

  <?php include_once '../includes/sub-footer.php';?>

</div>

<?php include_once '../includes/footer.php';?>
<script src="../assets/js/purchase-return-details.js"></script>

<!-- Professional Print Styles -->
<style>
.invoice {
  background: #fff;
  padding: 20px;
}

.invoice-info {
  margin-bottom: 20px;
}

.invoice-col {
  margin-bottom: 15px;
}

.table thead.thead-light th {
  background-color: #f8f9fa;
  border-bottom: 2px solid #dee2e6;
  font-weight: 600;
}

.table {
  margin-bottom: 0;
}

@media print {
  .no-print,
  .main-sidebar,
  .main-header,
  .content-header,
  .card-footer,
  .breadcrumb {
    display: none !important;
  }
  
  .content-wrapper {
    margin-left: 0 !important;
    margin-top: 0 !important;
    padding: 10px !important;
  }
  
  .invoice {
    border: none;
    margin: 0;
    padding: 0;
  }
  
  .card {
    border: none;
    box-shadow: none;
  }
  
  .table {
    page-break-inside: avoid;
  }
  
  body {
    background: #fff;
  }
}
</style>

</body>
</html>