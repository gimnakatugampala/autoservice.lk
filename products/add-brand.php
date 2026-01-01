<?php include_once '../includes/header.php';?>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php include_once '../includes/loader.php';?>

  <?php include_once '../includes/navbar.php'; ?>
  <?php include_once '../includes/sidebar.php';?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa-tags mr-2"></i>Add Brand</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Brands</a></li>
              <li class="breadcrumb-item active">Add Brand</li>
            </ol>
          </div>
        </div>
      </div></section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8 mx-auto">
      
            <div class="card card-primary card-outline shadow">
              <div class="card-header">
                <h3 class="card-title">Brand Details</h3>
              </div>
              <div class="card-body">

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="brand_name">Brand Name <span class="text-danger">*</span></label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-copyright"></i></span>
                        </div>
                        <input type="text" class="form-control" id="brand_name" placeholder="Enter brand name (e.g., Toyota, Castrol)">
                      </div>
                      <small class="text-muted">Enter the unique name for the product brand.</small>
                    </div>
                  </div>
                </div>

              </div>
              <div class="card-footer text-right">
                <button type="button" class="btn btn-secondary mr-2" onclick="window.history.back();">
                  <i class="fas fa-times mr-1"></i> Cancel
                </button>
                
                <button id="btn_add_brand" type="button" class="btn btn-primary px-4">
                  <i class="fas fa-save mr-1"></i> Submit
                </button>

                <span style="display: none;" id="btn-loading">
                  <button type="button" class="btn btn-primary px-4" disabled>
                    <div class="spinner-border spinner-border-sm" role="status">
                      <span class="visually-hidden"></span>
                    </div>
                    Processing...
                  </button>
                </span>
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