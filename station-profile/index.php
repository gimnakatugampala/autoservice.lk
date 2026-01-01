<?php include_once '../includes/header.php';?>

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
            <h1><i class="fas fa-gas-pump mr-2"></i>Station Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Station Profile</a></li>
              <li id="breadcrumb_vehicle_number" class="breadcrumb-item active">Profile</li>
            </ol>
          </div>

        </div>
      </div></section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-10 mx-auto">
      
            <div class="card card-primary card-outline shadow">
              <div class="card-header">
                <h3 class="card-title text-bold"><i class="fas fa-info-circle mr-1"></i> Manage Station Information</h3>
              </div>
              <div class="card-body">

              <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                    <label for="station_name">Station Name <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-building"></i></span>
                        </div>
                        <input type="text" class="form-control" id="station_name" placeholder="Enter Station Name">
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
                    <input id="phone_number" type="text" class="form-control" data-inputmask='"mask": "099 9999 999"' data-mask>
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
                    <input id="other_phone_number" type="text" class="form-control" data-inputmask='"mask": "099 9999 999"' data-mask>
                  </div>
                </div>
                </div>


                <div class="col-sm-12">
                <div class="form-group">
                <label>Address <span class="text-danger">*</span></label>
                <textarea id="address" class="form-control" rows="3" placeholder="Enter full address..."></textarea>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                    <label for="street">Street</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-road"></i></span>
                        </div>
                        <input type="text" class="form-control" id="street" placeholder="Enter Street">
                    </div>
                  </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                    <label for="city">City</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" id="city" placeholder="Enter City">
                    </div>
                  </div>
              </div>
              
              </div> </div> <div class="card-footer text-right">
                <button type="button" class="btn btn-secondary px-4 mr-2" onclick="window.history.back();">Cancel</button>
                <button id="update_station_info" type="button" class="btn btn-primary px-5 shadow-sm">
                  <i class="fas fa-save mr-1"></i> Submit
                </button>
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
<?php include_once '../includes/footer.php';?>

</body>
</html>