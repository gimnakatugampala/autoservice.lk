<?php include_once '../includes/header.php';?>

<style>
    /* AdminLTE professional standards */
    .content-wrapper { background-color: #f4f6f9; }
    .card-primary.card-outline { border-top: 3px solid #007bff; }
    .form-group label { font-weight: 600; color: #495057; }
    .text-danger { margin-left: 2px; }
    
    /* Input Group refinement */
    .input-group-text {
        background-color: #f8f9fa;
        color: #007bff;
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
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold text-dark"><i class="fas fa-plus-circle mr-2 text-primary"></i>Add Washer Rate</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Washer</a></li>
              <li class="breadcrumb-item active">Add Washer</li>
            </ol>
          </div>
        </div>
      </div></section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-10 mx-auto">
      
            <div class="card card-primary card-outline shadow-sm">
              <div class="card-header">
                <h3 class="card-title text-bold">Washer Service Configuration</h3>
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
                                <option disabled selected value="">Please Select</option>
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
                            <input type="number" step="0.01" class="form-control" id="price" placeholder="0.00">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4 border-top pt-3 text-right">
                    <button type="button" class="btn btn-secondary px-4 mr-2" onclick="window.history.back();">Cancel</button>
                    <button id="btn_add_washer" type="button" class="btn btn-primary px-5 shadow-sm font-weight-bold">
                        <i class="fas fa-save mr-1"></i> Submit Rate
                    </button>


                    <span style="display: none;" id="btn-loading">
                        <button type="button" class="btn btn-primary px-5" disabled>
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden"></span>
                            </div>
                        </button>
                    </span>

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
<?php include_once '../includes/footer.php';?>

</body>
</html>