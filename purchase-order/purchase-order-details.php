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
            <h1>Purchase Order Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../purchase-order/">Manage Purchase Orders</a></li>
              <li class="breadcrumb-item active">Details</li>
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
                      <div class="row mb-4">
                        <div class="col-2"></div>
                        <div class="col-2 text-center">
                          <img id="station_logo" width="100" src="../assets/img/system/autoservice_logo.jpg" alt="Station Logo" 
                               onerror="this.onerror=null; this.src='../dist/img/system/logo_pistona.png';">
                        </div>
                        
                        <div class="col-8">
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
                       <h4 class="text-uppercase"><strong>Purchase Order</strong></h4>
                    </div>
                  </div>

                  <!-- Invoice Information Row -->
                  <div class="row invoice-info mb-4">
                    <div class="col-sm-4 invoice-col border-right">
                      <strong>From</strong>
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
                      <strong>Order Information</strong>
                      <div class="mt-2">
                        <table class="table table-sm table-borderless">
                          <tr>
                            <td width="50%"><strong>PO Code:</strong></td>
                            <td id="lbl_po_code">---</td>
                          </tr>
                          <tr>
                            <td><strong>Placed Date:</strong></td>
                            <td id="lbl_placed_date">---</td>
                          </tr>
                          <tr>
                            <td><strong>Status:</strong></td>
                            <td id="lbl_po_status">---</td>
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
                      <h5><strong>Order Items</strong></h5>
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
                          <tbody id="tb_po_details">
                            <tr>
                              <td colspan="7" class="text-center text-muted">
                                Loading order details...
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                  <!-- Totals and Payment Info -->
                  <div class="row mt-4">
                    <div class="col-6">
                      <p class="lead">
                        <strong>Payment Method:</strong> 
                        <span id="lbl_payment_method">---</span>
                      </p>
                      <p class="text-muted well well-sm shadow-none" style="background: #f4f4f4; border-left: 3px solid #d2d6de; padding: 10px; margin-top: 20px;">
                        <small>Note: This is a computer-generated Purchase Order and does not require a physical signature.</small>
                      </p>
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
                          <tr>
                            <th>Paid Amount:</th>
                            <td class="text-right" id="lbl_paid_amount">LKR 0.00</td>
                          </tr>
                          <tr class="border-top">
                            <th class="text-lg"><strong>Net Total:</strong></th>
                            <td class="text-right text-lg">
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
                  <i class="fas fa-arrow-left"></i> Back to List
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
<script src="../assets/js/purchase-order-details.js"></script>

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