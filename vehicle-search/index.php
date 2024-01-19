
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
            <h1>Search Vehicle</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Search Vehicle</a></li>
              <li class="breadcrumb-item active">Search Vehicle</li>
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
                    <div class="col-md-10 mx-auto">
                    <div class="form-group">
                    <label>Vehicle Search</label>
                    <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Please Select Vehicle</option>
                    <option>KY-3038</option>
                    <option>CAT-8717</option>
                    <option>GY-2999</option>
                    <option>GY-2499</option>
                    </select>
                    </div>
                    </div>
                </div>


                <div class="row">

                <div class="col-md-12">
                    <img style="object-fit: cover;" class="border border-dark rounded-circle" width="200" height="180" src="../dist/img/system/car_img.png" alt="Vehicle">
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
