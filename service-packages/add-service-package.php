
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
            <h1>Add Service Package</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Service Package</a></li>
              <li class="breadcrumb-item active">Add Service Package</li>
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
                          <label for="exampleInputEmail1">Service Package Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name">
                      </div>
                </div>

                <div class="col-md-7 mx-auto">
                    <div class="form-group">
                          <label for="exampleInputEmail1">Default Price <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Default Price">
                      </div>
                </div>

          
                <div class="col-md-12">
                <table class="table table-bordered">
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
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">LKR</span>
                            </div>
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Van</td>
                        <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">LKR</span>
                            </div>
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            </div>
                        </td>
                    </tr>
                    
                    </tbody>
                </table>
                </div>
                   

        


                <div class="col-md-4">
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
