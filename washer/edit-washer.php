<?php include_once '../includes/header.php';?>

<style>
    /* Custom AdminLTE tweaks for Edit Page */
    .content-wrapper { background-color: #f4f6f9; }
    .card-info.card-outline { border-top: 3px solid #17a2b8; }
    .form-group label { font-weight: 600; color: #495057; }
    .input-group-text { background-color: #f8f9fa; color: #17a2b8; }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include_once '../includes/loader.php';?>

  <?php include_once '../includes/navbar.php'; ?>
  <?php include_once '../includes/sidebar.php';?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold text-dark"><i class="fas fa-edit mr-2 text-info"></i>Edit Washer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Washer</a></li>
              <li class="breadcrumb-item active">Edit Washer</li>
            </ol>
          </div>
        </div>
      </div></section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-10 mx-auto">
      
            <div class="card card-info card-outline shadow-sm">
              <div class="card-header border-0">
                <h3 class="card-title text-bold">Update Washer Rate Configuration</h3>
              </div>
              <div class="card-body">

              <div class="row">

              <div class="col-md-6">
                    
                    <div class="form-group">
                          <label>Vehicle Class <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-car-side"></i></span>
                            </div>
                            <select id="cmbvehicleclass" class="custom-select">
                            </select>
                          </div>
                      </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                          <label for="price">Price (LKR) <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold text-xs">LKR</span>
                            </div>
                            <input type="text" class="form-control" id="price" placeholder="Price">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                            </div>
                          </div>
                      </div>
                </div>
              

                <div class="col-md-12 mt-3 border-top pt-3 text-right">
                    <button type="button" class="btn btn-secondary px-4 mr-2" onclick="window.history.back();">Cancel</button>
                    <button id="btn_update_washer" type="button" class="btn btn-info px-5 shadow-sm">Update Rate</button>
                </div>

              </div>


              </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  <?php include_once '../includes/sub-footer.php';?>

  <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../assets/js/getwasher.js"></script>

<?php include_once '../includes/footer.php';?>

</body>
</html>