
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
            <h1>Add Employee</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Employees</a></li>
              <li class="breadcrumb-item active">Add Employee</li>
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
                          <label for="exampleInputEmail1">NIC <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="nic" placeholder="National Identity Number">
                      </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                          <label for="exampleInputEmail1">Email <span class="text-danger">*</span></label>
                          <input type="email" class="form-control" id="email" placeholder="Email">
                      </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                  <label>Phone Number <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input id="phone_number" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
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
                    <input id="other_phone_number" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                  </div>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                  <label>Date of Birth</label>
                  <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input id="dob" type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="col-md-6"></div>

                <div class="col-md-6">
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" id="pass" placeholder="Password">
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                  <label>Confirm Password</label>
                  <input type="password" class="form-control" id="con_pass" placeholder="Password">
                </div>
                </div>

    

          

                <div class="col-md-12">
                <button type="button" class="btn bg-gradient-secondary">Cancel</button>
                <button id="btn_add_employee" type="button" class="btn bg-gradient-primary">Submit</button>
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
