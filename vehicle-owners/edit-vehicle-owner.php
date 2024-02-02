
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
            <h1>Edit Vehicle Owner</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Vehicles Owners</a></li>
              <li class="breadcrumb-item active">Edit Vehicle Owner</li>
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
                          <label for="exampleInputEmail1">First Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="first_name" placeholder="First Name">
                      </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                          <label for="exampleInputEmail1">Last Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="last_name" placeholder="Last Name">
                      </div>
                </div>

                
                <div class="col-md-6">
                    <div class="form-group">
                          <label for="exampleInputEmail1">Email <span class="text-danger">*</span></label>
                          <input type="email" class="form-control" id="email" placeholder="Email address">
                      </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                          <label for="exampleInputEmail1">NIC <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="nic" placeholder="National Identity Card">
                      </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                  <label>Phone Number <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input id="phone_number" type="text" class="form-control" data-inputmask='"mask": "099 9999 999"' data-mask>
                  </div>
                </div>
                </div>


                <div class="col-md-6">
                <div class="form-group">
                  <label>Other Phone Number</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input id="other_phone_number" type="text" class="form-control" data-inputmask='"mask": "099 9999 999"' data-mask>
                  </div>
                </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                          <label for="exampleInputEmail1">Address <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="address" placeholder="Address">
                      </div>
                </div>

                
                <div class="col-md-6">
                    <div class="form-group">
                          <label for="exampleInputEmail1">City <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="city" placeholder="City">
                      </div>
                </div>


                <div class="col-md-4">
                <button type="button" class="btn bg-gradient-secondary">Cancel</button>
                <button id="update-vehicle-owner-btn" type="button" class="btn bg-gradient-primary">Update</button>
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
<script src="../assets/js/getvehicleowner.js"></script>

<?php include_once '../includes/footer.php';?>


</body>
</html>
