
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
            <h1><b>HYUI8899</b></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Service Records</a></li>
              <li class="breadcrumb-item active">KY-3038</li>
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

                <div class="col-md-12 my-2">
                    <h5><b>Service Package</b></h5>
                    <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Service Package Name</th>
                        <th>Fuel Type</th>
                        <th>Filter Type</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Toyota Car Package</td>
                        <td>Castrol/Valvoline 10W-30W</td>
                        <td>Castrol/Valvoline 10W-30W</td>
                    </tr>

                    </tbody>
                    </table>
                </div>

                <div class="col-md-12 my-2">
                    <h5><b>Repair Packages</b></h5>
                    <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Repair Package Name</th>
                        <th>Labour Hr (Hours)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Lathe Work</td>
                        <td>4.8</td>
                    </tr>

                    </tbody>
                    </table>
                </div>

                <div class="col-md-12 my-2">
                    <h5><b>Products</b></h5>
                    <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>QTY</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Head Light</td>
                        <td>4.8</td>
                    </tr>

                    </tbody>
                    </table>
                </div>

                <div class="col-md-12 my-2">
                    <h5><b>Washers</b></h5>
                    <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Washer Package Name</th>
                        <th>QTY</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Head Light</td>
                        <td>4.8</td>
                    </tr>

                    </tbody>
                    </table>
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

<script src="../plugins/jquery/jquery.min.js"></script>
<?php include_once '../includes/footer.php';?>
<script src="../assets/js/service-record-details.js"></script>

</body>
</html>
