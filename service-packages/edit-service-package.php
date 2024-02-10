
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
            <h1>Edit Service Package</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Service Package</a></li>
              <li class="breadcrumb-item active">Edit Service Package</li>
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
                          <label for="service_package_name">Service Package Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="service_package_name" placeholder="Name">
                      </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="exampleInputEmail1">Select Vehicle Class <span class="text-danger">*</span></label>
                        <select id="cmbvehicleclass" class="custom-select">
                        <option disabled selected value="">Please Select</option>
                          <!-- <option>Car</option>
                          <option>Van</option>
                          <option>Bus</option>
                          <option>Lorry</option>
                          <option>option 5</option> -->
                        </select>
                      </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="exampleInputEmail1">Select Package Items <span class="text-danger">*</span></label>
                        <select id="cmbpackageitems" class="custom-select">
                          <option disabled selected value="">Please Select</option>
                          <!-- <option>Van</option>
                          <option>Bus</option>
                          <option>Lorry</option>
                          <option>option 5</option> -->
                        </select>
                      </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="exampleInputEmail1">Select Free Package Items </label>
                        <select id="cmbpackageitems2" class="custom-select">
                        <option disabled selected value="">Please Select</option>
                          <!-- <option>Car</option>
                          <option>Van</option>
                          <option>Bus</option>
                          <option>Lorry</option>
                          <option>option 5</option> -->
                        </select>
                      </div>
                </div>

                <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="tbpackageitem">

                    <!-- <tr>
                        <td>Engine Oil Change</td>
                        <td><button type="button" class="btn bg-gradient-danger"><i class="fas fa-trash"></i></button></td>
                    </tr>
                    <tr>
                        <td>Oil Filter Change</td>
                        <td><button type="button" class="btn bg-gradient-danger"><i class="fas fa-trash"></i></button></td>
                    </tr>
                    <tr>
                        <td>Under Wash</td>
                        <td><button type="button" class="btn bg-gradient-danger"><i class="fas fa-trash"></i></button></td>
                    </tr> -->
                    
                    </tbody>
                </table>
                </div>

                <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="tbfreepackageitem">

                    <!-- <tr>
                        <td>Diagnostic Scan Report</td>
                        <td><button type="button" class="btn bg-gradient-danger"><i class="fas fa-trash"></i></button></td>
                    </tr>
                    <tr>
                        <td>12V Battery Report</td>
                        <td><button type="button" class="btn bg-gradient-danger"><i class="fas fa-trash"></i></button></td>
                    </tr>
                    <tr>
                        <td>Free Body</td>
                        <td><button type="button" class="btn bg-gradient-danger"><i class="fas fa-trash"></i></button></td>
                    </tr> -->
                    
                    </tbody>
                </table>
                </div>
            
                <div class="col-md-6">
                <div class="form-group">
                <label for="exampleInputEmail1">Select Fuel Type <span class="text-danger">*</span></label>
                        <select id="cmbfueltype" class="custom-select">
                        <option disabled selected value="">Please Select</option>
                          <!-- <option>Car</option>
                          <option>Van</option>
                          <option>Bus</option>
                          <option>Lorry</option>
                          <option>option 5</option> -->
                        </select>
                      </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="exampleInputEmail1">Select Filter Type <span class="text-danger">*</span></label>
                        <select id="cmbfiltertype" class="custom-select">
                        <option disabled selected value="">Please Select</option>
                          <!-- <option>Car</option>
                          <option>Van</option>
                          <option>Bus</option>
                          <option>Lorry</option>
                          <option>option 5</option> -->
                        </select>
                      </div>
                </div>
          
                <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Fuel Type</th>
                        <th>Price (LKR)</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody id="tbfueltype">
<!-- 
                    <tr>
                        <td>Valvoline 0W-20</td>
                        <td class="w-50">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">LKR</span>
                            </div>
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Castrol/Valvoline 10W-30</td>
                        <td class="w-50">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">LKR</span>
                            </div>
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            </div>
                        </td>
                    </tr> -->
                    
                    </tbody>
                </table>
                </div>

                <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Filter Type</th>
                        <th>Price (LKR)</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody id="tbfiltertype">
<!-- 
                    <tr>
                        <td>Valvoline 0W-20</td>
                        <td class="w-50">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">LKR</span>
                            </div>
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Castrol/Valvoline 10W-30</td>
                        <td class="w-50">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">LKR</span>
                            </div>
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            </div>
                        </td>
                    </tr> -->
                    
                    </tbody>
                </table>
                </div>
                   
                   

        


                <div class="col-md-4">
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

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../assets/js/edit-service-package.js"></script>


<?php include_once '../includes/footer.php';?>

</body>
</html>
