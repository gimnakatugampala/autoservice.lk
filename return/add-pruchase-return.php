<?php include_once '../includes/header.php';?>

<style>
    /* Styling to match AdminLTE professional standards */
    .content-wrapper { background-color: #f4f6f9; }
    .card-primary.card-outline { border-top: 3px solid #007bff; }
    .form-group label { font-weight: 600; color: #495057; }
    
    /* Table refinement */
    .table thead th {
        background-color: #f8f9fa;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #dee2e6;
    }
    
    /* Summary box styling */
    .summary-box {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        padding: 15px;
    }
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
          <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold text-dark"><i class="fas fa-undo-alt mr-2 text-primary"></i>Add Purchase Order Return</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Purchase Order Return</a></li>
              <li class="breadcrumb-item active">Add Purchase Order Return</li>
            </ol>
          </div>

        </div>
      </div></section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
      
            <div class="card card-primary card-outline shadow-sm">
              <div class="card-header border-0">
                <h3 class="card-title text-bold"><i class="fas fa-file-invoice mr-1"></i> Return Details</h3>
              </div>
              <div class="card-body">

              <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                <label for="cmbsuppliers">Select Supplier <span class="text-danger">*</span></label>
                        <select id="cmbsuppliers" class="custom-select shadow-none">
                        <option value="" selected disabled>Please Select Supplier</option>
                          </select>
                      </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="purchase-date">Purchase Return Date <span class="text-danger">*</span></label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" id="purchase-date" class="form-control datetimepicker-input shadow-none" data-target="#reservationdate" placeholder="Select Date"/>
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text bg-primary text-white border-primary"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
               
                    </div>
                </div>

                <div class="col-md-12">
                <div class="form-group">
                <label for="cmbproducts">Select Products <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                            <select id="cmbproducts" class="custom-select shadow-none border-primary">
                              <option value="" selected disabled>Find and Add Products to List...</option>
                              </select>
                        </div>
                      </div>
                </div>

                <div class="col-md-3">
                <div class="form-group">
                <label for="cmbpaidstatus">Paid Status <span class="text-danger">*</span></label>
                        <select id="cmbpaidstatus" class="custom-select shadow-none">
                        <option value="" selected disabled>Please Select</option>
                          </select>
                      </div>
                </div>

                <div class="col-md-3">
                <div class="form-group">
                    <label for="paid_amount">Paid Amount (LKR)</label>
                    <input type="text" class="form-control shadow-none font-weight-bold" id="paid_amount" placeholder="0.00">
                  </div>
                </div>

                <div class="col-md-3">
                <div class="form-group">
                <label for="cmbstatus">Return Status <span class="text-danger">*</span></label>
                        <select id="cmbstatus" class="custom-select shadow-none">
                        <option value="" selected disabled>Please Select</option>
                          </select>
                      </div>
                </div>

                <div class="col-md-3">
                <div class="form-group">
                <label for="cmbpaymentmethod">Payment Method <span class="text-danger">*</span></label>
                        <select id="cmbpaymentmethod" class="custom-select shadow-none">
                        <option value="" selected disabled>Please Select</option>
                          </select>
                      </div>
                </div>

                <div class="col-md-12">
                <div class="form-group">
                        <label for="return_note">Note <span class="text-danger">*</span></label>
                        <textarea id="return_note" class="form-control shadow-none" rows="3" placeholder="Enter reason for return or additional info..."></textarea>
                      </div>
                </div>

                <div class="col-md-12 mt-3 mb-4">
                <div class="table-responsive">
                    <table class="table table-hover table-striped border">
                      <thead class="bg-light">
                        <tr>
                          <th>Product Name</th>
                          <th style="width: 150px;">QTY</th>
                          <th style="width: 200px;">Purchase Price (LKR)</th>
                          <th style="width: 200px;">Discount (LKR)</th>
                          <th style="width: 180px;">Total Cost (LKR)</th>
                          <th style="width: 50px;"></th>
                        </tr>
                      </thead>
                      <tbody id="tbpuchaseorder_return_products">

                        </tbody>
                    </table>
                </div>
                </div>

                <div class="col-md-7"></div>

                <div class="col-md-5">
                <div class="summary-box shadow-sm mb-4">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless font-weight-bold mb-0">
                          <tr>
                            <th style="width:50%">Sub Total:</th>
                            <td id="subtotal" class="text-right">0.00</td>
                          </tr>
                          <tr>
                            <th class="align-middle">VAT (%)</th>
                            <td class="text-right"><input type="text" value="0" class="form-control form-control-sm w-50 ml-auto text-right font-weight-bold" id="vat"></td>
                          </tr>
                          <tr style="display:none;">
                            <th>Paid Amount</th>
                            <td id="paid" class="text-right">0.00</td>
                          </tr>
                          <tr class="border-top border-primary">
                            <th class="text-lg">Total To Be Paid:</th>
                            <td class="text-right text-lg text-primary"><span id="to_be_paid" style="text-decoration: underline; text-decoration-style: double;">0.00</span></td>
                          </tr>
                        </table>
                    </div>
                </div>
                </div>
                
                <div class="col-md-12 text-right border-top pt-3">
                    <button type="button" class="btn btn-default px-4 mr-2" onclick="window.history.back();">Cancel</button>
                    <button id="add_pruchase_order_return_btn" type="button" class="btn btn-primary px-5 shadow-sm font-weight-bold">
                        <i class="fas fa-save mr-1"></i> Submit Return
                    </button>

                    <span style="display: none;" id="btn-loading">
                        <button  type="button" class="btn btn-primary px-5 shadow-sm" disabled>
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden"></span>
                            </div>
                            &nbsp; Processing...
                        </button>
                    </span>
                </div>

              </div>


              </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  <?php include_once '../includes/sub-footer.php';?>

  <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>
<?php include_once '../includes/footer.php';?>
<script src="../assets/js/add-por.js"></script>

</body>
</html>