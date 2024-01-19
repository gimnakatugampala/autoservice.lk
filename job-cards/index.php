
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
          <div class="col-sm-5">
            <h1>Pending Order List</h1>
          </div>
          <div class="col-sm-7">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Vehicles</li>
            </ol> -->
            <a href="../orders/add-repair-order.php" type="button" class="btn bg-gradient-primary"><i class="fas fa-plus"></i> Add Repair</a>
            <a href="../orders/add-service-order.php" type="button" class="btn bg-gradient-primary"><i class="fas fa-plus"></i> Add Service</a>
            <a href="../orders/add-service-repair-order.php" type="button" class="btn bg-gradient-primary"><i class="fas fa-plus"></i> Add Repair & Service</a>
            <a href="../orders/add-wash-order.php" type="button" class="btn bg-gradient-primary"><i class="fas fa-plus"></i> Add Washer</a>
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
              <div class="card-header">
                <h3 class="card-title">Pending Orders</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Order Code</th>
                    <th>Vehicle Owner Name</th>
                    <th>Vehicle Name</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>

                  <tr>
                    <td>001</td>
                    <td>AS344</td>
                    <td>Gimna Katugampala</td>
                    <td>KY-3038</td>
                    <td>2024-01-15</td>
                    <td>
                    <a href="../orders/edit-service-repair-order.php" type="button" class="btn bg-gradient-info"><i class="fas fa-pen"></i></a>
                    </td>
                  </tr>
                
                  </tbody>
                </table>
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
