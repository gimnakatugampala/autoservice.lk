<?php include_once '../includes/header.php';?>

<style>
    /* AdminLTE custom tweaks */
    .content-wrapper { background-color: #f4f6f9; }
    .card-primary.card-outline { border-top: 3px solid #007bff; }
    .form-group label { font-weight: 600; color: #495057; }
    .text-danger { margin-left: 2px; }
    
    /* Image preview styling */
    #img-preview-container {
        display: none;
        margin-top: 10px;
        border: 1px solid #ddd;
        padding: 5px;
        border-radius: 5px;
        max-width: 150px;
    }
    #img-preview-container img {
        width: 100%;
        border-radius: 3px;
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
            <h1 class="m-0 font-weight-bold"><i class="fas fa-car-side mr-2 text-primary"></i>Add Vehicle</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Vehicles</a></li>
              <li class="breadcrumb-item active">Add Vehicle</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="card card-primary card-outline shadow-sm">
              <div class="card-header">
                <h3 class="card-title text-bold">Vehicle Specifications</h3>
              </div>
              
              <div class="card-body">
                <form id="vehicleAddForm" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="vehicle_number">Vehicle Number <span class="text-danger">*</span></label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                          </div>
                          <input type="text" class="form-control text-bold" id="vehicle_number" placeholder="e.g. WP KY-3038" oninput="convertToUppercase(this)">
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Vehicle Class <span class="text-danger">*</span></label>
                        <select id="cmbvehicleclass" class="form-control select2" style="width: 100%;">
                          <option value="" selected disabled>Please Select</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Vehicle Make <span class="text-danger">*</span></label>
                        <select id="cmbvehiclemanufacturer" class="form-control select2" style="width: 100%;">
                          <option value="" selected disabled>Please Select</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Model <span class="text-danger">*</span></label>
                        <select id="cmbvehiclemodel" class="form-control select2" style="width: 100%;">
                          <option value="" selected disabled>Please Select</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Select Vehicle Owner <span class="text-danger">*</span></label>
                        <select id="cmbvehicleowner" class="form-control select2" style="width: 100%;">
                          <option value="" selected disabled>Please Select</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="engine_number">Engine Number</label>
                        <input oninput="convertToUppercase(this)" type="text" class="form-control" id="engine_number" placeholder="Enter engine serial number">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="vehicle_img">Vehicle Image</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input accept="image/*" type="file" class="custom-file-input" id="vehicle_img" onchange="previewImage(event)">
                            <label class="custom-file-label" for="vehicle_img">Choose file</label>
                          </div>
                        </div>
                        <div id="img-preview-container">
                            <img id="img-preview" src="#" alt="Preview">
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Manufacturer Country <span class="text-danger">*</span></label>
                        <select id="cmbvehiclecountry" class="form-control select2" style="width: 100%;">
                          <option value="" selected disabled>Please Select</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Fuel Type <span class="text-danger">*</span></label>
                        <select id="cmbvehiclefueltype" class="form-control select2" style="width: 100%;">
                          <option value="" selected disabled>Please Select</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Year <span class="text-danger">*</span></label>
                        <select id="cmbvehicleyear" class="form-control select2" style="width: 100%;">
                          <option value="" selected disabled>Please Select</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="chassis_number">Chassis Number</label>
                        <input oninput="convertToUppercase(this)" type="text" class="form-control" id="chassis_number" placeholder="Enter chassis serial number">
                      </div>

                      <div class="form-group">
                        <label>Vehicle Color <span class="text-danger">*</span></label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-palette"></i></span>
                          </div>
                          <input oninput="convertToUppercase(this)" type="text" class="form-control" id="vehicle_color" placeholder="e.g. METALLIC BLACK">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12 mt-4 border-top pt-3">
                      <div class="float-right">
                        <button type="button" class="btn btn-secondary px-4 mr-2" onclick="window.history.back();">
                            <i class="fas fa-times mr-1"></i> Cancel
                        </button>
                        
                        <button id="btn_add_vehicle" type="button" class="btn btn-primary px-5 shadow-sm font-weight-bold">
                            <i class="fas fa-check-circle mr-1"></i> Submit Vehicle
                        </button>

                        <button style="display: none;" id="btn-loading" type="button" class="btn btn-primary px-5 shadow-sm font-weight-bold" disabled>
                          <span class="spinner-border spinner-border-sm mr-2" role="status"></span>
                          Saving...
                        </button>
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
</div>

<script src="../assets/js/touppercaseinput.js"></script>

<?php include_once '../includes/footer.php';?>

<script>
    // Initialize Select2 if not already done in footer
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4'
        });
    });

    // Image Preview Helper
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('img-preview');
            output.src = reader.result;
            document.getElementById('img-preview-container').style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>
</html>