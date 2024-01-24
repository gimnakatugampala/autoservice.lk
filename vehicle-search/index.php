
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


                <div class="container">
                  <div class="row">

                  <div class="col-md-10 mx-auto">
                    <a href="../vehicle-search/service-records.php" type="button" class="btn bg-gradient-secondary float-right"><i class="fas fa-history"></i> View Service Records</a>
                  </div>

                  <div class="col-md-10 mx-auto">
                      <img class="border"  width="280" height="200" src="../dist/img/system/car_img.png" alt="Vehicle">
                  </div>

                  <div class="col-md-9 mx-auto my-2">
                    <div class="d-flex align-items-center justify-content-evenly">
                      <span class="text-secondary mx-1"><b>Red</b></span>
                      <div class="border inline mx-1" style="width:11px;height:11px;background-color:crimson;border-radius:50%" ></div>
                      <span class="h4 m-0 p-0"><b>KY-3038</b></span>
                    </div>
                  </div>

                  <div class="col-md-10 mx-auto my-4">

                  <div class="row">
                    <div class="col-md-4 mb-4">
                        <h6 class="text-uppercase m-0 p-0"><b>Vehicle Code</b></h6>
                        <p class="text-muted m-0 p-0">HJKS</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h6 class="text-uppercase m-0 p-0"><b>Vehicle Owner</b></h6>
                        <p class="text-muted m-0 p-0">Gimna Katugampala</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h6 class="text-uppercase m-0 p-0"><b>Manufacturer</b></h6>
                        <p class="text-muted m-0 p-0">BMW</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h6 class="text-uppercase m-0 p-0"><b>Model</b></h6>
                        <p class="text-muted m-0 p-0">Fit</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h6 class="text-uppercase m-0 p-0"><b>Manufacturer Country</b></h6>
                        <p class="text-muted m-0 p-0">Japan</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h6 class="text-uppercase m-0 p-0"><b>Vehicle Type</b></h6>
                        <p class="text-muted m-0 p-0">Roadstar</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h6 class="text-uppercase m-0 p-0"><b>Fuel Type</b></h6>
                        <p class="text-muted m-0 p-0">Auto Deisel</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h6 class="text-uppercase m-0 p-0"><b>Year Of Manufacturer</b></h6>
                        <p class="text-muted m-0 p-0">2015</p>
                    </div>
                  </div>

                  </div>

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
