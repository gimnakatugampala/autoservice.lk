<?php include_once '../includes/header.php';?>

<style>
    /* Custom AdminLTE tweaks for Edit Page */
    .content-wrapper { background-color: #f4f6f9; }
    .card-info.card-outline { border-top: 3px solid #17a2b8; }
    .form-group label { font-weight: 600; color: #495057; }
    .input-group-text { background-color: #f8f9fa; color: #17a2b8; }
    
    /* Current image display */
    .current-vehicle-img {
        max-width: 120px;
        border: 2px solid #eee;
        border-radius: 8px;
        margin-bottom: 10px;
        display: block;
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
            <h1 class="m-0 font-weight-bold text-dark"><i class="fas fa-edit mr-2 text-info"></i>Edit Vehicle</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Vehicles</a></li>
              <li class="breadcrumb-item active">Edit Vehicle</li>
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
                <h3 class="card-title text-bold">Update Vehicle Information</h3>
              </div>
              <div class="card-body">

              <form id="vehicleEditForm" enctype="multipart/form-data">
                <div class="row">

                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="vehicle_number">Vehicle Number <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                            </div>
                            <input type="text" class="form-control font-weight-bold" id="vehicle_number" placeholder="KY-3038" oninput="convertToUppercase(this)">
                          </div>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="engine_number">Engine Number </label>
                          <input oninput="convertToUppercase(this)" type="text" class="form-control" id="engine_number" placeholder="Engine Number">
                      </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Vehicle Class <span class="text-danger">*</span></label>
                      <select id="cmbvehicleclass" class="form-control select2" style="width: 100%;">
                        </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="vehicle_img">Vehicle Image</label>
                        <div id="image_preview_section"></div>
                        <div class="input-group">
                          <div class="custom-file">
                            <input accept="image/*" type="file" class="custom-file-input" id="vehicle_img">
                            <label class="custom-file-label" for="vehicle_img">Replace Image</label>
                          </div>
                        </div>
                      </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Vehicle Make <span class="text-danger">*</span></label>
                      <select id="cmbvehiclemanufacturer" class="form-control select2" style="width: 100%;">
                        </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Manufacturer Country <span class="text-danger">*</span></label>
                      <select id="cmbvehiclecountry" class="form-control select2" style="width: 100%;">
                        </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Model <span class="text-danger">*</span></label>
                      <select id="cmbvehiclemodel" class="form-control select2" style="width: 100%;">
                        </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Fuel Type <span class="text-danger">*</span></label>
                      <select id="cmbvehiclefueltype"  class="form-control select2" style="width: 100%;">
                        </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Select Vehicle Owner <span class="text-danger">*</span></label>
                      <select id="cmbvehicleowner" class="form-control select2" style="width: 100%;">
                        </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Year <span class="text-danger">*</span></label>
                      <select id="cmbvehicleyear" class="form-control select2" style="width: 100%;">
                        </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="chassis_number">Chassis Number </label>
                          <input oninput="convertToUppercase(this)" type="text" class="form-control" id="chassis_number" placeholder="Chassis Number">
                      </div>
                  </div>


                  <div class="col-md-6">
                      <div class="form-group">
                      <label>Vehicle Color <span class="text-danger">*</span></label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-palette"></i></span>
                        </div>
                        <input oninput="convertToUppercase(this)" type="text" class="form-control" id="vehicle_color" placeholder="Color">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 mt-3 border-top pt-3">
                    <div class="float-right">
                      <button type="button" class="btn btn-secondary px-4 mr-2" onclick="window.history.back();">Cancel</button>
                      <button id="btn_edit_vehicle" type="button" class="btn btn-info px-4 shadow-sm">Update Vehicle</button>
                    </div>
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
<script src="../assets/js/touppercaseinput.js"></script>
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../assets/js/getvehicles.js"></script>

<?php include_once '../includes/footer.php';?>

<script>
    // Maintain the Bootstrap custom file input functionality
    $(document).ready(function () {
      if(typeof bsCustomFileInput !== 'undefined') {
        bsCustomFileInput.init();
      }
    });
</script>

</body>
</html>