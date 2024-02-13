
<?php include_once '../includes/header.php';?>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php include_once '../includes/loader.php';?>

  <!-- Navbar -->
  <?php include_once '../includes/navbar.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 <?php include_once '../includes/sidebar.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Purchase Order</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Purchase Order</a></li>
              <li class="breadcrumb-item active">Add Purchase Order</li>
            </ol>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
      
            <!-- /.card -->
            <div class="card">
              <div class="card-body">

              <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                <label for="exampleInputEmail1">Select Supplier <span class="text-danger">*</span></label>
                        <select id="cmbsuppliers" class="custom-select">
                        <option value="" selected disabled>Please Select</option>
                          <!-- <option>Car</option>
                          <option>Van</option>
                          <option>Bus</option>
                          <option>Lorry</option>
                          <option>option 5</option> -->
                        </select>
                      </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="exampleInputEmail1">Purchase Date <span class="text-danger">*</span></label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" id="purchase-date" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
               
                    </div>
                </div>

                <div class="col-md-12">
                <div class="form-group">
                <label for="exampleInputEmail1">Select Products <span class="text-danger">*</span></label>
                        <select id="cmbproducts" class="custom-select">
                          <option value="" selected disabled>Please Select</option>
                          <!-- <option>Car</option>
                          <option>Van</option>
                          <option>Bus</option>
                          <option>Lorry</option>
                          <option>option 5</option> -->
                        </select>
                      </div>
                </div>

                <div class="col-md-3">
                <div class="form-group">
                <label for="exampleInputEmail1">Paid Status <span class="text-danger">*</span></label>
                        <select id="cmbpaidstatus" class="custom-select">
                        <option value="" selected disabled>Please Select</option>
                          <!-- <option>Car</option>
                          <option>Van</option>
                          <option>Bus</option>
                          <option>Lorry</option>
                          <option>option 5</option> -->
                        </select>
                      </div>
                </div>

                <div class="col-md-3">
                <div class="form-group">
                    <label for="paid_amount">Paid Amount</label>
                    <input type="text" class="form-control" id="paid_amount" placeholder="0.00">
                  </div>
                </div>

                <div class="col-md-3">
                <div class="form-group">
                <label for="exampleInputEmail1">Status <span class="text-danger">*</span></label>
                        <select id="cmbstatus" class="custom-select">
                        <option value="" selected disabled>Please Select</option>
                          <!-- <option>Car</option>
                          <option>Van</option>
                          <option>Bus</option>
                          <option>Lorry</option>
                          <option>option 5</option> -->
                        </select>
                      </div>
                </div>

                <div class="col-md-3">
                <div class="form-group">
                <label for="exampleInputEmail1">Payment Method <span class="text-danger">*</span></label>
                        <select id="cmbpaymentmethod" class="custom-select">
                        <option value="" selected disabled>Please Select</option>
                          <!-- <option>Car</option>
                          <option>Van</option>
                          <option>Bus</option>
                          <option>Lorry</option>
                          <option>option 5</option> -->
                        </select>
                      </div>
                </div>

                <div class="col-md-12">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Product Name</th>
                      <th>QTY</th>
                      <th>Purchase Price (LKR)</th>
                      <th>Discount (LKR)</th>
                      <th>Total Cost (LKR)</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="tbpuchaseorder_products">

                    <!-- <tr>
                      <td>Oil Barrel</td>
                      <td><input type="text" class="form-control"></td>
                      <td><input type="text" class="form-control"></td>
                      <td><input type="text" class="form-control"></td>
                      <td>20.00</td>
                      <td><button type="button" class="btn bg-gradient-danger"><i class="fas fa-trash"></i></button></td>
                    </tr> -->

                  </tbody>
                </table>
                </div>

        
                <div class="col-md-6"></div>

              <div class="col-md-6">
                <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">Sub Total:</th>
                    <td id="subtotal">0.00</td>
                  </tr>
                  <tr>
                    <th>VAT (%)</th>
                    <td><input type="text" value="0" class="form-control w-50" id="vat"></td>
                  </tr>
                  <tr style="display:none;">
                    <th>Paid Amount</th>
                    <td id="paid">0.00</td>
                  </tr>
                  <tr>
                    <th>To Be Paid:</th>
                    <td><u id="to_be_paid" style="text-decoration-style: double;">0.00</u></td>
                  </tr>
                </table>
                </div>
                    
                </div>
                
            

                <div class="col-md-4">
                <button type="button" class="btn bg-gradient-secondary">Cancel</button>
                <button id="btn_add_purchase" type="button" class="btn bg-gradient-primary">Submit</button>
                </div>

              </div>


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include_once '../includes/sub-footer.php';?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>

<?php include_once '../includes/footer.php';?>

<script src="../assets/js/add-purchase.js"></script>

</body>
</html>
