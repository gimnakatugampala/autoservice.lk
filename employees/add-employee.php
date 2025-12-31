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
            <h1 class="m-0 font-weight-bold text-dark"><i class="fas fa-user-plus mr-2 text-primary"></i>Add Employee</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Employees</a></li>
              <li class="breadcrumb-item active">Add Employee</li>
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
                <h3 class="card-title text-bold">Personal & Account Information</h3>
              </div>
              <div class="card-body">

              <form id="addEmployeeForm">
                <div class="row">

                  <div class="col-md-6">
                      <div class="form-group">
                            <label for="first_name">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="first_name" placeholder="First Name">
                        </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                            <label for="last_name">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="last_name" placeholder="Last Name">
                        </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                            <label for="nic">NIC <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <input type="text" class="form-control" id="nic" placeholder="National Identity Number">
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
                                <input type="email" class="form-control" id="email" placeholder="Email Address">
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
                      <input id="phone_number" type="text" class="form-control" data-inputmask='"mask": "099 9999 999"' data-mask placeholder="Primary Phone">
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
                      <input id="other_phone_number" type="text" class="form-control" data-inputmask='"mask": "099 9999 999"' data-mask placeholder="Secondary Phone">
                    </div>
                  </div>
                  </div>

                  <div class="col-md-6">
                  <div class="form-group">
                    <label>Date of Birth</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                          <input id="dob" type="text" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="Select Date"/>
                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                  </div>
                  </div>

                  <div class="col-md-6">
                  <div class="form-group">
                    <label>User Type <span class="text-danger">*</span></label>
                    <select id="cmbusertypes" class="form-control select2" style="width: 100%;">
                      </select>
                  </div>
                  </div>

                  <div class="col-md-6">
                  <div class="form-group">
                    <label>Password <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" id="pass" placeholder="Password">
                    </div>
                  </div>
                  </div>

                  <div class="col-md-6">
                  <div class="form-group">
                    <label>Confirm Password <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-shield-alt"></i></span>
                        </div>
                        <input type="password" class="form-control" id="con_pass" placeholder="Confirm Password">
                    </div>
                  </div>
                  </div>

                  <div class="col-md-12 mt-4 border-top pt-3 text-right">
                    <button type="button" class="btn btn-secondary px-4 mr-2" onclick="window.history.back();">Cancel</button>
                    <button id="btn_add_employee" type="button" class="btn btn-primary px-5 shadow-sm font-weight-bold">Submit Employee</button>

                    <span style="display: none;" id="btn-loading">
                          <button type="button" class="btn btn-primary px-5" disabled>
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden"></span>
                            </div>
                            Processing...
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
    // Standard AdminLTE initialization for Datepicker & Select2
    $(function () {
        if ($.fn.select2) {
            $('.select2').select2({ theme: 'bootstrap4' });
        }
        if ($.fn.datetimepicker) {
            $('#reservationdate').datetimepicker({ format: 'L' });
        }
        if ($.fn.inputmask) {
            $('[data-mask]').inputmask();
        }
    });
</script>

</body>
</html>