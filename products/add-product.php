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
            <h1 class="m-0 font-weight-bold text-dark"><i class="fas fa-plus-circle mr-2 text-primary"></i>Add New Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Product</a></li>
              <li class="breadcrumb-item active">Add Product</li>
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
                <h3 class="card-title text-bold">Product Specification</h3>
              </div>
              <div class="card-body">

              <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                          <label for="product_name">Product Name <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-box"></i></span>
                            </div>
                            <input type="text" class="form-control" id="product_name" placeholder="Enter Product Name">
                          </div>
                      </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cmbproductcategory">Select Category <span class="text-danger">*</span></label>
                        <select id="cmbproductcategory" class="custom-select">
                          <option disabled selected value="">-- Choose Category --</option>
                          </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cmbproductbrand">Select Brand <span class="text-danger">*</span></label>
                        <select id="cmbproductbrand" class="custom-select">
                           <option disabled selected value="">-- Choose Brand --</option>
                          </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                          <label for="product_warrenty">Warrenty <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-shield-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" id="product_warrenty" placeholder="e.g. 1 Year / No Warrenty">
                          </div>
                      </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                          <label for="product_quantity">Quantity <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
                            </div>
                            <input type="number" class="form-control" id="product_quantity" placeholder="Stock Amount">
                          </div>
                      </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cmbavailablity">Availability <span class="text-danger">*</span></label>
                        <select id="cmbavailablity" class="custom-select border-primary text-primary font-weight-bold">
                          </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                          <label for="selling_price">Selling Price (LKR)<span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold text-xs">LKR</span>
                            </div>
                            <input type="text" class="form-control" id="selling_price" placeholder="0.00">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-tags"></i></span>
                            </div>
                          </div>
                      </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                          <label for="buying_price">Buying Price (LKR)<span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold text-xs">LKR</span>
                            </div>
                            <input type="text" class="form-control" id="buying_price" placeholder="0.00">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-file-invoice-dollar"></i></span>
                            </div>
                          </div>
                      </div>
                </div>

                <div class="col-md-12 mt-4 border-top pt-3 text-right">
                    <button type="button" class="btn btn-secondary px-4 mr-2" onclick="window.history.back();">Cancel</button>
                    <button id="btn_add_product" type="button" class="btn btn-primary px-5 shadow-sm font-weight-bold">
                        <i class="fas fa-save mr-1"></i> Submit Product
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