
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
            <h1>Add Washer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Washer</a></li>
              <li class="breadcrumb-item active">Add Washer</li>
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
                                <label>Vehicle Class <span class="text-danger">*</span></label>
                                <select id="cmbvehicleclass"class="custom-select">
                                <!-- <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option> -->
                            </select>
                      </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                          <label for="price">Price (LKR) <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="price" placeholder="Price">
                      </div>
                </div>

              

      

                <div class="col-md-12">
                <button type="button" class="btn bg-gradient-secondary">Cancel</button>
                <button id="btn_add_washer" type="button" class="btn bg-gradient-primary">Submit</button>
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
