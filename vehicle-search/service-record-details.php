<?php include_once '../includes/header.php';?>

<style>
    /* AdminLTE Custom UI Tweaks */
    .content-wrapper { background-color: #f4f6f9; }
    .card-title { font-weight: 700; font-size: 1.1rem; }
    .table thead th { 
        background-color: #f8f9fa; 
        text-transform: uppercase; 
        font-size: 0.8rem; 
        letter-spacing: 0.5px;
    }
    .info-header {
        border-left: 5px solid #007bff;
        padding-left: 15px;
        margin-bottom: 20px;
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
        <div class="row mb-2 align-items-center">
          <div class="col-sm-6">
            <div class="info-header">
                <small class="text-muted text-uppercase d-block">Service Details for</small>
                <h1 class="m-0 font-weight-bold text-primary"><span id="vehicle_number_details"></span></h1>
            </div>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Service Records</a></li>
              <li id="breadcrumb_vehicle_number" class="breadcrumb-item active"></li>
            </ol>
          </div>

        </div>
      </div></section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
      
            <div class="row">

                <div class="col-md-6 my-2">
                    <div class="card card-outline card-primary shadow-sm h-100">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-box-open mr-2 text-primary"></i>Service Package</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Package Name</th>
                                        <th>Lubricant</th>
                                        <th>Filter</th>
                                    </tr>
                                </thead>
                                <tbody id="tb_service_record_packages">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 my-2">
                    <div class="card card-outline card-info shadow-sm h-100">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-tools mr-2 text-info"></i>Repair Packages</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Repair Name</th>
                                        <th>Labour Time</th>
                                    </tr>
                                </thead>
                                <tbody id="tb_service_record_repair">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 my-2">
                    <div class="card card-outline card-success shadow-sm h-100">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-cubes mr-2 text-success"></i>Products / Parts</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody id="tb_service_record_products">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 my-2">
                    <div class="card card-outline card-warning shadow-sm h-100">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-shower mr-2 text-warning"></i>Washers</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Washer Package</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody id="tb_service_record_washer">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div> </div>
          </div>
        </div>
      </section>
    </div>
  <?php include_once '../includes/sub-footer.php';?>

  <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>
<script src="../plugins/jquery/jquery.min.js"></script>
<?php include_once '../includes/footer.php';?>
<script src="../assets/js/service-record-details.js"></script>

</body>
</html>