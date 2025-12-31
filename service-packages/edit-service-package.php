<?php include_once '../includes/header.php';?>

<style>
    /* AdminLTE custom tweaks for Edit View */
    .content-wrapper { background-color: #f4f6f9; }
    .card-info.card-outline { border-top: 3px solid #17a2b8; }
    .form-group label { font-weight: 600; color: #495057; }
    .text-danger { margin-left: 2px; }
    
    /* Input Group refinement */
    .input-group-text {
        background-color: #f8f9fa;
        color: #17a2b8;
    }
    /* Table styling */
    .table thead th {
        background-color: #f8f9fa;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-top: 0;
    }
    .section-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: #6c757d;
        margin-bottom: 10px;
        display: block;
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 5px;
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
            <h1 class="m-0 font-weight-bold text-dark"><i class="fas fa-edit mr-2 text-info"></i>Edit Service Package</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Service Package</a></li>
              <li class="breadcrumb-item active">Edit Service Package</li>
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
                <h3 class="card-title text-bold">Package Information Update</h3>
              </div>
              <div class="card-body">

             <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                          <label for="service_package_name">Service Package Name <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-box-open"></i></span>
                            </div>
                            <input type="text" class="form-control font-weight-bold" id="service_package_name" placeholder="Name">
                          </div>
                      </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="cmbvehicleclass">Select Vehicle Class <span class="text-danger">*</span></label>
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
                <label for="cmbpackageitems">Select Package Items <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-plus-circle"></i></span>
                            </div>
                            <select id="cmbpackageitems" class="custom-select">
                                <option disabled selected value="">Please Select</option>
                                  </select>
                        </div>
                      </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="cmbpackageitems2">Select Free Package Items </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text text-success"><i class="fas fa-gift"></i></span>
                            </div>
                            <select id="cmbpackageitems2" class="custom-select">
                                <option disabled selected value="">Please Select</option>
                                  </select>
                        </div>
                      </div>
                </div>

                <div class="col-md-6">
                <span class="section-title"><i class="fas fa-list-ul mr-1"></i> Included Items</span>
                <table class="table table-sm table-hover table-bordered shadow-sm">
                    <thead>
                    <tr>
                        <th>Item Name</th>
                        <th class="text-center" style="width: 80px;">Action</th>
                    </tr>
                    </thead>
                    <tbody id="tbpackageitem">

                    </tbody>
                </table>
                </div>

                <div class="col-md-6">
                <span class="section-title text-success"><i class="fas fa-star mr-1"></i> Complimentary (Free) Items</span>
                <table class="table table-sm table-hover table-bordered shadow-sm">
                    <thead>
                    <tr>
                        <th>Item Name</th>
                        <th class="text-center" style="width: 80px;">Action</th>
                    </tr>
                    </thead>
                    <tbody id="tbfreepackageitem">

                    </tbody>
                </table>
                </div>
            
                <div class="col-md-6">
                <div class="form-group">
                <label for="cmbfueltype">Select Lubricant Type <span class="text-danger">*</span></label>
                        <select id="cmbfueltype" class="custom-select">
                        <option disabled selected value="">Please Select</option>
                          </select>
                      </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="cmbfiltertype">Select Filter Type <span class="text-danger">*</span></label>
                        <select id="cmbfiltertype" class="custom-select">
                        <option disabled selected value="">Please Select</option>
                          </select>
                      </div>
                </div>
          
                <div class="col-md-6">
                <table class="table table-sm table-bordered">
                    <thead>
                    <tr>
                        <th>Lubricant Type</th>
                        <th>Price (LKR)</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody id="tbfueltype">
                    
                    </tbody>
                </table>
                </div>

                <div class="col-md-6">
                <table class="table table-sm table-bordered">
                    <thead>
                    <tr>
                        <th>Filter Type</th>
                        <th>Price (LKR)</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody id="tbfiltertype">
                    
                    </tbody>
                </table>
                </div>
                    
                <div class="col-md-12 border-top mt-4 pt-3 text-right">
                    <button type="button" class="btn btn-secondary px-4 mr-2" onclick="window.history.back();">Cancel</button>
                    <button id="update_service_package_btn" type="button" class="btn btn-info px-5 shadow-sm">Update Package</button>
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
<script src="../assets/js/edit-service-package.js"></script>


<?php include_once '../includes/footer.php';?>

</body>
</html>