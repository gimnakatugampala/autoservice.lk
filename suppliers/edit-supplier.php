<?php include_once '../includes/header.php';?>

<style>
    /* Styling to match AdminLTE professional standards for Edit View */
    .content-wrapper { background-color: #f4f6f9; }
    .card-info.card-outline { border-top: 3px solid #17a2b8; }
    .form-group label { font-weight: 600; color: #495057; }
    .text-danger { margin-left: 2px; }
    
    /* Input group icon styling */
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
            <h1 class="m-0 font-weight-bold text-dark"><i class="fas fa-user-edit mr-2 text-info"></i>Edit Supplier</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Suppliers</a></li>
              <li class="breadcrumb-item active">Edit Supplier</li>
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
                <h3 class="card-title text-bold">Update Supplier Information</h3>
              </div>
              <div class="card-body">

              <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                          <label for="first_name">First Name <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control shadow-none" id="first_name" placeholder="First Name">
                          </div>
                      </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                          <label for="last_name">Last Name <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control shadow-none" id="last_name" placeholder="Last Name">
                          </div>
                      </div>
                </div>

              
                <div class="col-md-6">
                    <div class="form-group">
                          <label for="email">Email <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control shadow-none" id="email" placeholder="Email">
                          </div>
                      </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                  <label>Phone Number <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input id="phone_number" type="text" class="form-control shadow-none" data-inputmask='"mask": "099 9999 999"' data-mask>
                  </div>
                </div>
                </div>


                <div class="col-md-6">
                <div class="form-group">
                  <label>Other Phone Number</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                    </div>
                    <input id="other_phone_number" type="text" class="form-control shadow-none" data-inputmask='"mask": "099 9999 999"' data-mask>
                  </div>
                </div>
                </div>

                <div class="col-md-12">
                <div class="form-group">
                        <label>Address <span class="text-danger">*</span></label>
                        <textarea id="address" class="form-control shadow-none" rows="3" placeholder="Enter ..."></textarea>
                      </div>
                </div>

    
    

          

                <div class="col-md-12 border-top pt-3 text-right">
                    <button type="button" class="btn btn-secondary px-4 mr-1" onclick="window.history.back();">Cancel</button>
                    <button id="btn_update_supplier" type="button" class="btn btn-info px-5 shadow-sm font-weight-bold">
                        <i class="fas fa-save mr-1"></i> Update
                    </button>
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
<script src="../assets/js/getsuppliers.js"></script>

<?php include_once '../includes/footer.php';?>

</body>
</html>