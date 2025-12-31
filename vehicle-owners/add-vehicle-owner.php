<?php include_once '../includes/header.php';?>

<style>
    /* AdminLTE custom tweaks */
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
            <h1 class="m-0 font-weight-bold text-dark"><i class="fas fa-user-plus mr-2 text-primary"></i>Add Vehicle Owner</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Vehicles Owners</a></li>
              <li class="breadcrumb-item active">Add Vehicle Owner</li>
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
                <h3 class="card-title text-bold">Owner Personal Information</h3>
              </div>
              <div class="card-body">

              <form id="addVehicleOwnerForm">
                <div class="row">

                  <div class="col-md-6">
                      <div class="form-group">
                            <label for="first_name">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="first_name" placeholder="Enter first name">
                        </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                            <label for="last_name">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="last_name" placeholder="Enter last name">
                        </div>
                  </div>

                  
                  <div class="col-md-6">
                      <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                              </div>
                              <input type="email" class="form-control" id="email" placeholder="email@example.com">
                            </div>
                        </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                            <label for="nic">NIC <span class="text-danger">*</span></label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                              </div>
                              <input type="text" class="form-control" id="nic" placeholder="e.g. 199012345678 or 901234567V">
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
                      <input id="phone_number" type="text" class="form-control" data-inputmask='"mask": "099 9999 999"' data-mask placeholder="07x xxxx xxx">
                    </div>
                  </div>
                  </div>


                  <div class="col-md-6">
                  <div class="form-group">
                    <label>Other Phone Number</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                      </div>
                      <input id="other_phone_number" type="text" class="form-control" data-inputmask='"mask": "099 9999 999"' data-mask placeholder="Optional">
                    </div>
                  </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                            <label for="address">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="address" placeholder="House No, Street name">
                        </div>
                  </div>

                  
                  <div class="col-md-6">
                      <div class="form-group">
                            <label for="city">City <span class="text-danger">*</span></label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-city"></i></span>
                              </div>
                              <input type="text" class="form-control" id="city" placeholder="Enter city">
                            </div>
                        </div>
                  </div>


                  <div class="col-md-12 mt-3 border-top pt-3 text-right">
                    <button type="button" class="btn btn-secondary px-4 mr-2" onclick="window.history.back();">Cancel</button>
                    <button id="add-vehicle-owner-btn" type="button" class="btn btn-primary px-5 shadow-sm">Submit Owner</button>

                    <span style="display: none;" id="btn-loading">
                        <button type="button" class="btn btn-primary px-5" disabled>
                        <div class="spinner-border spinner-border-sm" role="status">
                            <span class="visually-hidden"></span>
                        </div>
                        </button>
                    </span>
                  </div>

                </div>
              </form>

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

<script>
  $(function () {
    // Initialize InputMask if not already initialized in footer
    if ($.fn.inputmask) {
        $('[data-mask]').inputmask();
    }
  });
</script>

</body>
</html>