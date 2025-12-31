<?php include_once '../includes/header.php';?>

<style>
    /* AdminLTE custom tweaks */
    .content-wrapper { background-color: #f4f6f9; }
    .card-primary.card-outline { border-top: 3px solid #007bff; }
    .form-group label { font-weight: 600; color: #495057; }
    .text-danger { margin-left: 2px; }
    
    /* Table refinement */
    .table thead th {
        background-color: #f8f9fa;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-top: 0;
    }
    .price-input-group {
        max-width: 250px;
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
            <h1 class="m-0 font-weight-bold text-dark"><i class="fas fa-tools mr-2 text-primary"></i>Add Repair</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Repair Package</a></li>
              <li class="breadcrumb-item active">Add Repair</li>
            </ol>
          </div>
        </div>
      </div></section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
      
            <div class="card card-primary card-outline shadow-sm">
              <div class="card-header">
                <h3 class="card-title text-bold">Repair Configuration</h3>
              </div>
              <div class="card-body">

              <div class="row">

                <div class="col-md-7 mx-auto">
                    <div class="form-group">
                          <label for="repair_name">Repair Name <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-wrench"></i></span>
                            </div>
                            <input type="text" class="form-control" id="repair_name" placeholder="Enter Repair Name (e.g. Brake Adjustment)">
                          </div>
                      </div>
                </div>

                <div class="col-md-7 mx-auto mt-3">
                <label class="text-muted small mb-2"><i class="fas fa-truck-pickup mr-1"></i> Labor Rates per Vehicle Type</label>
                <table class="table table-hover table-bordered shadow-sm">
                  <thead>
                    <tr>
                      <th style="width: 40%;">Vehicle Type</th>
                      <th>Unit Price Per Hr (LKR)</th>
                    </tr>
                  </thead>
                  <tbody id="tbrepair">

                    </tbody>
                </table>
                </div>

                <div class="col-md-7 mx-auto mt-4 border-top pt-3 text-right">
                    <button type="button" class="btn btn-secondary px-4 mr-2" onclick="window.history.back();">Cancel</button>
                    <button id="btn_add_repair" type="button" class="btn btn-primary px-5 shadow-sm font-weight-bold">
                        <i class="fas fa-save mr-1"></i> Submit Repair
                    </button>

                    <span style="display: none;" id="btn-loading">
                        <button  type="button" class="btn btn-primary px-5 shadow-sm" disabled>
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