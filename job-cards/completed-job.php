
<?php include_once '../includes/header.php';?>
<?php include_once '../api/completed-jobcard-list.php';?>

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
          <div class="col-sm-10">
            <h1>Completed Job Card List</h1>
          </div>
          <div class="col-sm-2">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Vehicles</li>
            </ol> -->
            <a href="../job-cards/add-job-card.php" type="button" class="btn bg-gradient-primary"><i class="fas fa-plus"></i> Add Job Card</a>
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
                <h3 class="card-title">Completed Job Cards</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Job Card Code</th>
                    <th>Vehicle Owner Name</th>
                    <th>Phone</th>
                    <th>Vehicle Name</th>
                    <th>Job Card Type</th>
                    <th>Created Date</th>
                    <th>Completed Date</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php foreach ($jobcards as $row) : ?>

                    <tr>
                      <td><?php echo  $row["job_card_code"]; ?></td>
                      <td><?php echo  $row["first_name"]; ?> <?php echo  $row["last_name"]; ?></td>
                      <td><?php echo  $row["phone"]; ?></td>
                      <td><?php echo  $row["vehicle_number"]; ?></td>
                      <td><?php echo  $row["JOB_CARD_TYPE"]; ?></td>
                      <td><?php echo  $row["JOB_CARD_PLACED_DATE"]; ?></td>
                      <td><?php echo  $row["COMPLETED_DATE"]; ?></td>
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

<?php include_once '../includes/footer.php';?>

</body>
</html>
