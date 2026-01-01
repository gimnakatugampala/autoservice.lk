<?php include_once '../includes/header.php';?>
<?php include_once '../api/addcategory.php';?>

<style>
    /* AdminLTE professional standards refinement */
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
            <h1 class="m-0 font-weight-bold text-dark"><i class="fas fa-folder-plus mr-2 text-primary"></i>Add Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Category</a></li>
              <li class="breadcrumb-item active">Add Category</li>
            </ol>
          </div>

        </div>
      </div></section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8 mx-auto">
      
            <div class="card card-primary card-outline shadow-sm">
              <div class="card-header border-0">
                <h3 class="card-title text-bold">New Category Details</h3>
              </div>
              <div class="card-body">

              <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                          <label for="category_name">Category Name <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" id="category_name" placeholder="Enter Category Name">
                          </div>
                      </div>
                </div>


                <div class="col-md-12 mt-3 border-top pt-3 text-right">
                    <button type="button" class="btn btn-secondary px-4 mr-1" onclick="window.history.back();">Cancel</button>
                    <button id="btn_add_category" type="button" class="btn btn-primary px-5 shadow-sm font-weight-bold">
                        <i class="fas fa-save mr-1"></i> Submit
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