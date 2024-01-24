
<?php include_once '../includes/header.php';?>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php include_once '../includes/loader.php';?>

  <!-- Navbar -->
  <?php include_once '../includes/navbar.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 <?php include_once '../includes/sidebar.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Vehicle</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Vehicles</a></li>
              <li class="breadcrumb-item active">Edit Vehicle</li>
            </ol>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
      
            <!-- /.card -->
            <div class="card">
              <div class="card-body">

              <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                          <label for="exampleInputEmail1">Vehicle Number <span class="text-danger">*</span></label>
                          <input type="email" class="form-control" id="exampleInputEmail1" placeholder="KY-3038">
                      </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                          <label for="exampleInputEmail1">Engine Number <span class="text-danger">*</span></label>
                          <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Engine Number">
                      </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                  <label>Vehicle Type <span class="text-danger">*</span></label>
                  <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                  <label>Sub Vehicle Type <span class="text-danger">*</span></label>
                  <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                  <label>Manufacturer <span class="text-danger">*</span></label>
                  <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                  <label>Manufacturer Country <span class="text-danger">*</span></label>
                  <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                  <label>Model <span class="text-danger">*</span></label>
                  <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                  <label>Fuel Type <span class="text-danger">*</span></label>
                  <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                  <label>Select Vehicle Owner <span class="text-danger">*</span></label>
                  <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                  <label>Year <span class="text-danger">*</span></label>
                  <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select>
                </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                          <label for="exampleInputEmail1">Chassis Number <span class="text-danger">*</span></label>
                          <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Chassis Number">
                      </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                    <label>Vehicle Color <span class="text-danger">*</span></label>
                    <div class="input-group my-colorpicker2">
                        <input type="text" class="form-control">

                        <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-square"></i></span>
                        </div>
                    </div>
                  <!-- /.input group -->
                </div>
                </div>


                <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputFile">Vehicle Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input accept="image/*" type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose Image</label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                <button type="button" class="btn bg-gradient-secondary">Cancel</button>
                <button type="button" class="btn bg-gradient-primary">Update</button>
                </div>

              </div>


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include_once '../includes/sub-footer.php';?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include_once '../includes/footer.php';?>

</body>
</html>
