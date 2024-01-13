
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
            <h1>Add Maintenance</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Maintenance Package</a></li>
              <li class="breadcrumb-item active">Add Maintenance</li>
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

                <div class="col-md-7 mx-auto">
                    <div class="form-group">
                          <label for="exampleInputEmail1">Maintenance <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Maintenance Name">
                      </div>
                </div>

                <div class="col-md-7 mx-auto">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Vehicle Type</th>
                      <th>Price (LKR)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Car</td>
                      <td>
                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="LKR">
                      </td>
                    </tr>
                    <tr>
                      <td>Van</td>
                      <td>
                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="LKR">
                      </td>
                    </tr>
                   
                  </tbody>
                </table>
                </div>

                <!-- <div class="col-md-6">
                    <div class="form-group">
                          <label for="exampleInputEmail1">Price <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Last Name">
                      </div>
                </div> -->

      

                <div class="col-md-12">
                <button type="button" class="btn bg-gradient-secondary">Cancel</button>
                <button type="button" class="btn bg-gradient-primary">Submit</button>
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
