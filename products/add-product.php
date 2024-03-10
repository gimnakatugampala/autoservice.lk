
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
            <h1>Add Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Product</a></li>
              <li class="breadcrumb-item active">Add Product</li>
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
                          <label for="product_name">Product Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="product_name" placeholder="Name">
                      </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="exampleInputEmail1">Select Category <span class="text-danger">*</span></label>
                        <select id="cmbproductcategory" class="custom-select">
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
                <label for="exampleInputEmail1">Select Brand <span class="text-danger">*</span></label>
                        <select id="cmbproductbrand" class="custom-select">
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
                          <label for="product_warrenty">Warrenty <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="product_warrenty" placeholder="Warrenty">
                      </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                          <label for="product_quantity">Quantity <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="product_quantity" placeholder="Quantity">
                      </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="exampleInputEmail1">Availability <span class="text-danger">*</span></label>
                        <select id="cmbavailablity" class="custom-select">
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
                          <label for="selling_price">Selling Price (LKR)<span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="selling_price" placeholder="Selling Price">
                      </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                          <label for="buying_price">Buying Price (LKR)<span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="buying_price" placeholder="Buying Price">
                      </div>
                </div>

        
            

                <div class="col-md-4">
                <button type="button" class="btn bg-gradient-secondary">Cancel</button>
                <button id="btn_add_product" type="button" class="btn bg-gradient-primary">Submit</button>


                <span style="display: none;" id="btn-loading">
                        <button  type="button" class="btn bg-gradient-primary">
                        <div class="spinner-border spinner-border-sm" role="status">
                            <span class="visually-hidden"></span>
                        </div>
                        </button>
                  </span>

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

<?php include_once '../includes/footer.php';?>

</body>
</html>
