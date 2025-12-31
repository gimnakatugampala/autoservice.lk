<?php include_once '../includes/header.php';?>

<style>
    /* Custom AdminLTE tweaks for Edit Page */
    .content-wrapper { background-color: #f4f6f9; }
    .card-info.card-outline { border-top: 3px solid #17a2b8; }
    .form-group label { font-weight: 600; color: #495057; }
    .input-group-text { background-color: #f8f9fa; color: #17a2b8; }
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
            <h1 class="m-0 font-weight-bold text-dark"><i class="fas fa-user-edit mr-2 text-info"></i>Edit Employee</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Employees</a></li>
              <li class="breadcrumb-item active">Edit Employee</li>
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
                <h3 class="card-title text-bold">Update Employee Profile</h3>
              </div>
              <div class="card-body">

              <form id="editEmployeeForm">
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
                                  <input type="email" class="form-control" id="email" placeholder="Email">
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
                          <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                        </div>
                        <input id="other_phone_number" type="text" class="form-control" data-inputmask='"mask": "099 9999 999"' data-mask>
                      </div>
                    </div>
                    </div>

                    <div class="col-md-6">
                    <div class="form-group">
                      <label>Date of Birth</label>
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input id="dob" type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="col-md-6">
                    <div class="form-group">
                      <label>User Type</label>
                      <select id="cmbusertypes" class="form-control select2" style="width: 100%;">
                        </select>
                    </div>
                    </div>

                    <div class="col-md-6">
                    <div class="form-group">
                      <label>Password (Leave blank to keep current)</label>
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
                      <label>Confirm Password</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-shield-alt"></i></span>
                        </div>
                        <input type="password" class="form-control" id="con_pass" placeholder="Password">
                      </div>
                    </div>
                    </div>


                  <div class="col-md-12 border-top mt-3 pt-3 text-right">
                    <button type="button" class="btn btn-secondary px-4 mr-2" onclick="window.history.back();">Cancel</button>
                    <button id="btn_update_employee" type="button" class="btn btn-info px-5 shadow-sm">Update Employee</button>
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
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../assets/js/getemployees.js"></script>


<?php include_once '../includes/footer.php';?>

<script>
    $(function () {
        // Initialize Select2 if not already handled
        if ($.fn.select2) {
            $('.select2').select2({ theme: 'bootstrap4' });
        }
    });
</script>

</body>
</html>