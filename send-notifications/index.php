
<?php include_once '../includes/header.php';?>
<?php include_once '../api/service-notification-list.php';?>

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
          <div class="col-sm-9">
            <h1>Send Notifications</h1>
          </div>
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Send Notifications</li>
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
              <div class="card-header">
                <h3 class="card-title">Customers Reminders</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped tb_notification">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Vehicle Number</th>
                    <th>Last Service Date</th>
                    <th>Current Mileage (KM)</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php foreach ($notifications as $row) : ?>

                  <tr>
                    <td><?php echo  $row["jobcard_code"]; ?></td>
                    <td><?php echo  $row["first_name"]; ?> <?php echo  $row["last_name"]; ?></td>
                    <td><?php echo  $row["vehicle_number"]; ?></td>
                    <td><?php echo  $row["last_serv_date"]; ?></td>
                    <td><?php echo  $row["curr_mileage"]; ?></td>
                    <td>
                    <button 
                    data-jobcardid="<?php echo  $row["jobcard_id"]; ?>" 
                    data-vo="<?php echo  $row["first_name"]; ?> <?php echo  $row["last_name"]; ?>" data-vno="<?php echo  $row["vehicle_number"]; ?>" 
                    data-phone="<?php echo  $row["vehicle_o_phone"]; ?>" 
                    type="button" class="btn bg-gradient-warning notificationItem"><i class="fas fa-paper-plane"></i></button>
                    </td>
                  </tr>

                  <?php endforeach; ?>
                
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

<script src="../plugins/jquery/jquery.min.js"></script>
<?php include_once '../includes/footer.php';?>

<script src="../assets/js/notification.js"></script>
</body>
</html>
