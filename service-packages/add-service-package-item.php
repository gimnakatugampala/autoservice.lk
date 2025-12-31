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
            <h1 class="m-0 font-weight-bold text-dark"><i class="fas fa-plus-circle mr-2 text-primary"></i>Add Service Package Item</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Service Package</a></li>
              <li class="breadcrumb-item active">Add Service Package Item</li>
            </ol>
          </div>
        </div>
      </div></section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8 mx-auto">
      
            <div class="card card-primary card-outline shadow-sm">
              <div class="card-header">
                <h3 class="card-title text-bold">Item Specification</h3>
              </div>
              <div class="card-body">

              <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                          <label for="service_package_item">Service Package Item Name <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-list-ul"></i></span>
                            </div>
                            <input type="text" class="form-control" id="service_package_item" placeholder="e.g. Engine Oil Filter Replacement">
                          </div>
                      </div>
                </div>

                <div class="col-md-12 mt-3 border-top pt-3 text-right">
                    <button type="button" class="btn btn-secondary px-4 mr-1" onclick="window.history.back();">Cancel</button>
                    <button id="btn_add_service_package_item" type="button" class="btn btn-primary px-5 shadow-sm">Submit Item</button>

                    <span style="display: none;" id="btn-loading">
                        <button  type="button" class="btn btn-primary px-5" disabled>
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