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
            <h1 class="m-0 font-weight-bold text-dark"><i class="fas fa-edit mr-2 text-info"></i>Edit Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Product</a></li>
              <li class="breadcrumb-item active">Edit Product</li>
            </ol>
          </div>
        </div>
      </div></section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
      
            <div class="card card-info card-outline shadow-sm">
              <div class="card-header border-0">
                <h3 class="card-title text-bold">Update Product Details</h3>
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
                            <input type="text" class="form-control" id="product_name" placeholder="Name">
                          </div>
                      </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="cmbproductcategory">Select Category <span class="text-danger">*</span></label>
                        <select id="cmbproductcategory" class="custom-select">
                          </select>
                      </div>
                </div>

            

                <div class="col-md-6">
                <div class="form-group">
                <label for="cmbproductbrand">Select Brand <span class="text-danger">*</span></label>
                        <select id="cmbproductbrand" class="custom-select">
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
                            <input type="text" class="form-control" id="product_warrenty" placeholder="Warrenty">
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
                            <input type="text" class="form-control" id="product_quantity" placeholder="Quantity">
                          </div>
                      </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="cmbavailablity">Availability <span class="text-danger">*</span></label>
                        <select id="cmbavailablity" class="custom-select border-info">
                          </select>
                      </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                          <label for="selling_price">Selling Price (LKR)<span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold text-xs text-info">LKR</span>
                            </div>
                            <input type="text" class="form-control font-weight-bold text-dark" id="selling_price" placeholder="Selling Price">
                          </div>
                      </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                          <label for="buying_price">Buying Price (LKR)<span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold text-xs text-info">LKR</span>
                            </div>
                            <input type="text" class="form-control" id="buying_price" placeholder="Buying Price">
                          </div>
                      </div>
                </div>

        
            

                <div class="col-md-12 mt-3 border-top pt-3 text-right">
                    <button type="button" class="btn btn-secondary px-4 mr-2" onclick="window.history.back();">Cancel</button>
                    <button id="btn_update_product" type="button" class="btn btn-info px-5 shadow-sm">Update Product</button>
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
<script src="../assets/js/getproducts.js"></script>

<?php include_once '../includes/footer.php';?>

</body>
</html>