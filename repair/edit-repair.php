<?php include_once '../includes/header.php';?>

<style>
    /* AdminLTE professional standards for Edit View */
    .content-wrapper { background-color: #f4f6f9; }
    .card-info.card-outline { border-top: 3px solid #17a2b8; }
    .form-group label { font-weight: 600; color: #495057; }
    .text-danger { margin-left: 2px; }
    
    /* Input Group refinement */
    .input-group-text {
        background-color: #f8f9fa;
        color: #17a2b8;
    }
    /* Table refinement */
    .table thead th {
        background-color: #f8f9fa;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-top: 0;
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
            <h1 class="m-0 font-weight-bold text-dark"><i class="fas fa-edit mr-2 text-info"></i>Edit Repair</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Repair Package</a></li>
              <li class="breadcrumb-item active">Edit Repair</li>
            </ol>
          </div>
        </div>
      </div></section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
      
            <div class="card card-info card-outline shadow-sm">
              <div class="card-header">
                <h3 class="card-title text-bold">Update Repair Configuration</h3>
              </div>
              <div class="card-body">

              <div class="row">

              <div class="col-md-7 mx-auto">
                    <div class="form-group">
                          <label for="repair_name">Repair <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-wrench"></i></span>
                            </div>
                            <input type="text" class="form-control font-weight-bold" id="repair_name" placeholder="Repair Name">
                          </div>
                      </div>
                </div>

                <div class="col-md-7 mx-auto mt-3">
                <label class="text-muted small mb-2"><i class="fas fa-money-bill-wave mr-1"></i> Labor Rates per Vehicle Type</label>
                <table class="table table-hover table-bordered shadow-sm">
                  <thead>
                    <tr>
                      <th style="width: 40%;">Vehicle Type</th>
                      <th>Unit Price Per Hr (LKR) </th>
                    </tr>
                  </thead>
                  <tbody id="tbeditrepair">
                    </tbody>
                </table>
                </div>
      

                <div class="col-md-7 mx-auto border-top mt-4 pt-3 text-right">
                    <button type="button" class="btn btn-secondary px-4 mr-2" onclick="window.history.back();">Cancel</button>
                    <button id="btn_update_repair" type="button" class="btn btn-info px-5 shadow-sm">Update Repair</button>
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
<script src="../assets/js/getrepairs.js"></script>

<?php include_once '../includes/footer.php';?>

</body>
</html>