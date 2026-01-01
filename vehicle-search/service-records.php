<?php include_once '../includes/header.php';?>

<style>
    /* AdminLTE custom tweaks */
    .content-wrapper { background-color: #f4f6f9; }
    .card-primary.card-outline { border-top: 3px solid #007bff; }
    .table thead th {
        background-color: #f8f9fa;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-top: 0;
    }
    #service-records-vnumber {
        color: #007bff;
        text-transform: uppercase;
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include_once '../includes/loader.php';?>

  <?php include_once '../includes/navbar.php'; ?>
  <?php include_once '../includes/sidebar.php';?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 border-bottom pb-2">
          <div class="col-sm-9">
            <h1 class="m-0 font-weight-bold"><i class="fas fa-history mr-2 text-muted"></i>History for: <span id="service-records-vnumber"></span></h1>
          </div>
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Vehicle Search</a></li>
              <li class="breadcrumb-item active">Service Records</li>
            </ol>
          </div>

        </div>
      </div></section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
      
            <div class="card card-primary card-outline shadow-sm">
              <div class="card-header border-0">
                <h3 class="card-title text-bold">
                    <i class="fas fa-list-alt mr-1"></i> Detailed Service History
                </h3>
                <div class="card-tools">
                   <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                
                <div class="table-responsive">
                    <table class="table table-hover table-striped m-0">
                      <thead>
                      <tr>
                        <th><i class="fas fa-hashtag mr-1"></i> Job Number</th>
                        <th><i class="fas fa-gas-pump mr-1"></i> Station Name</th>
                        <th><i class="fas fa-file-invoice mr-1"></i> Type</th>
                        <th><i class="fas fa-info-circle mr-1"></i> Status</th>
                        <th><i class="far fa-calendar-plus mr-1"></i> Start Date</th>
                        <th><i class="far fa-calendar-check mr-1"></i> End Date</th>
                        <th><i class="fas fa-tachometer-alt mr-1"></i> Mileage (KM)</th>
                        <th class="text-center">Actions</th>
                      </tr>
                      </thead>
                      <tbody id="tb_service_records">

      
                
                      </tbody>
                    </table>
                </div>
              </div>
              <div class="card-footer bg-white small text-muted">
                * View specific job card details or download reports using the actions column.
              </div>
            </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content shadow-lg">
            <div class="modal-header bg-primary text-white border-0">
              <h4 class="modal-title font-weight-bold"><i class="fas fa-clipboard-check mr-2"></i>Vehicle Condition Report</h4>
              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body bg-light">
            
                <div id="vehicle-report-container" class="p-2"></div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="window.print()"><i class="fas fa-print"></i> Print Report</button>
            </div>
           
          </div>
          </div>
        </div>

  <?php include_once '../includes/sub-footer.php';?>

  <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>
<script src="../plugins/jquery/jquery.min.js"></script>

<?php include_once '../includes/footer.php';?>

<script src="../assets/js/service-records.js"></script>

</body>
</html>