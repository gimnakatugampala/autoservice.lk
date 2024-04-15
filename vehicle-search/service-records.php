
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
          <div class="col-sm-9">
            <h1><b id="service-records-vnumber"></b></h1>
          </div>
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Vehicle Search</a></li>
              <li class="breadcrumb-item active">Service Records</li>
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
                <h3 class="card-title">Service Records</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <table  class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Job Number</th>
                    <th>Station Name</th>
                    <th>Job Card Type</th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Current Milage (KM)</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody id="tb_service_records">

      
                
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

  <!-- Modal - Scan Report -->
  <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Vehicle Condition Report</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
            <div id="vehicle-report-container"></div>

            </div>
           
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

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

<script src="../assets/js/service-records.js"></script>

</body>
</html>
