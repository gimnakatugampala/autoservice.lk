
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

    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       
      <div class="row">
          <div class="col-md-12">
            <div class="card card-default">

              <div class="card-body p-2">

                <div class="bs-stepper">
                  <div class="row bs-stepper-header" role="tablist">
                    <!-- your steps here -->

                    <div class="col-md-2">
                      <div class="step" data-target="#search-vehicle-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="search-vehicle-part" id="search-vehicle-part-trigger">
                          <span class="bs-stepper-circle">1</span>
                          <span class="bs-stepper-label">Search Vehicle</span>
                        </button>
                      </div>
                    </div>

                    <!-- <div class="line"></div> -->
                    <div class="col-md-2">
                    <div class="step" data-target="#vehicle-report-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="vehicle-report-part" id="vehicle-report-part-trigger">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Vehicle Report</span>
                      </button>
                    </div>
                    </div>

                    <!-- <div class="line"></div> -->
                    <div class="col-md-1">
                    <div class="step" data-target="#washer-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="washer-part" id="washer-part-trigger">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">Washer</span>
                      </button>
                    </div>
                    </div>


             
                    <!-- <div class="line"></div> -->
                    <div class="col-md-2">
                    <div class="step" data-target="#service-package-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="service-package-part" id="service-package-part-trigger">
                        <span class="bs-stepper-circle">4</span>
                        <span class="bs-stepper-label">Service Packages</span>
                      </button>
                    </div>
                    </div>

                    <!-- <div class="line"></div> -->
                    <div class="col-md-2">
                    <div class="step" data-target="#maintenance-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="maintenance-part" id="maintenance-part-trigger">
                        <span class="bs-stepper-circle">5</span>
                        <span class="bs-stepper-label">Repair Packages</span>
                      </button>
                    </div>
                    </div>

                    <!-- <div class="line"></div> -->
                    <div class="col-md-1">
                    <div class="step" data-target="#select-products-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="select-products-part" id="select-products-part-trigger">
                        <span class="bs-stepper-circle">6</span>
                        <span class="bs-stepper-label">Products</span>
                      </button>
                    </div>
                    </div>

                    

                    <!-- <div class="line"></div> -->
                    <div class="col-md-2">
                    <div class="step" data-target="#generate-invoice-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="generate-invoice-part" id="generate-invoice-part-trigger">
                        <span class="bs-stepper-circle">7</span>
                        <span class="bs-stepper-label">Generate Invoice</span>
                      </button>
                    </div>
                    </div>

                 


                   
                  </div>

        <div class="bs-stepper-content">
                    <!-- your steps content here -->


                <!-- Search Vehicle - Step 1 -->
                <div id="search-vehicle-part" class="content" role="tabpanel" aria-labelledby="search-vehicle-part-trigger">

                    <div class="row">
                      <div class="col-md-12">
                        <h5 class="text-center"><b>Search By Vehicle Number</b></h5>
                        <select class="custom-select" id="cmbsearchvehicles">
                            <option value="" selected disabled>Please Select</option>
                        </select>
              
                      </div>
                    </div>
                    
                    
                    

                    <div id="search-vehicle-content">

                        <!-- No Vehicle Selected -->
                    <div class="d-flex justify-content-center my-4">
                          <h6>OR</h6>
                    </div>

                    <div class="d-flex justify-content-center mt-4 text-center">
                      <p class="w-25">If you can't find the vehicle in the list <b>create vehicle</b> before checkout</p>
                    </div>

                    <div class="d-flex justify-content-center text-center">
                      <a href="../vehicles/add-vehicle.php" type="button" class="btn btn-outline-primary">Create Vehicle</a>
                    </div>
                    <!-- No Vehicle Selected -->

                        <!-- Vehicle Selected -->
                       
                        <!-- Vehicle Selected -->
                    </div>

                      <button id="job-card-step-1" class="btn btn-primary">Next</button>
                </div>
                

                <!-- Vehicle Report - Step 2 -->
                <div id="vehicle-report-part" class="content" role="tabpanel" aria-labelledby="vehicle-report-part-trigger">
                        <div id="vehicle-report-container" class="row">

                            <!-- 1 -->
                            <div class="col-md-10 table-responsive p-0 mx-auto my-2">
                            <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Lubricants</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td>Engine Oil</td>
                                <td> 
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio1">
                                        <label class="form-check-label">Worse</label>
                                    </div>
                                </td>

                                <td> 
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio1">
                                        <label class="form-check-label">Bad</label>
                                    </div>
                                </td>

                                <td> 
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio1">
                                        <label class="form-check-label">Ok</label>
                                    </div>
                                </td>

                                <td> 
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio1">
                                        <label class="form-check-label">Good</label>
                                    </div>
                                </td>

                                <td> 
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio1">
                                        <label class="form-check-label">Perfect</label>
                                    </div>
                                </td>

                            </tr>

                            <tr>
                                <td>Wipes</td>
                                <td> 
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio1">
                                        <label class="form-check-label">Worse</label>
                                    </div>
                                </td>

                                <td> 
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio1">
                                        <label class="form-check-label">Bad</label>
                                    </div>
                                </td>

                                <td> 
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio1">
                                        <label class="form-check-label">Ok</label>
                                    </div>
                                </td>

                                <td> 
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio1">
                                        <label class="form-check-label">Good</label>
                                    </div>
                                </td>

                                <td> 
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio1">
                                        <label class="form-check-label">Perfect</label>
                                    </div>
                                </td>

                            </tr>

                            </tbody>
                            </table>
                            </div>

                        

                    </div>



                            <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                            <button id="job-card-step-2" class="btn btn-primary" >Next</button>


                </div>
                <!-- Vehicle Report - Step 2 -->


                <!-- Washers Package - Step 3-->
                <div id="washer-part" class="content" role="tabpanel" aria-labelledby="washer-part-trigger">

                <div id="washer-part-container" class="row">
                    <!-- <div class="col-md-12">

                        <table class="table table-striped">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Washer Package Name</th>
                            <th>QTY</th>
                            <th>Unit Price (LKR)</th>
                            <th>Discount (LKR)</th>
                            <th>Total (LKR)</th>
                            </tr>
                        </thead>
                        <tbody>

                        <tr>
                        <td>1.</td>
                        <td>Lathe Work</td>

                        <td>  
                            <div class="input-group">
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            </div>
                        </td>
                        
                        <td>  
                            <div class="input-group">
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            </div>
                        </td>

                        <td>  
                            <div class="input-group">
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            </div>
                        </td>

                        <td>  
                            <p class="h6">400.00</p>
                        </td>


                        
                        </tr>

                        </tbody>
                        </table>

                        <h4><b>Total - LKR 14,000/=</b></h4>

                    </div> -->
                </div>

                        <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                        <button id="job-card-step-3" class="btn btn-primary" >Next</button>
                </div>
                <!-- Washers Package - Step 3-->


                
                <!-- Search Service Packages  - Step 4 -->
                <div id="service-package-part" class="content" role="tabpanel" aria-labelledby="service-package-part-trigger">
                        <div id="service-package-part-container" class="row">
                        <div class="col-md-12">

                        <h5 class="text-center"><b>Select Service Packages</b></h5>
                        <select class="custom-select mb-4" id="cmbservicepackages">
                        <option value="" selected disabled>Please Select Service Packages</option>
                            </select>

                        <table id="tableServicePackage" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Service Package Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody id="table-jobcard-service-packages">

                        <!-- <span>
                            <tr data-widget="expandable-table" aria-expanded="false">
                                <td>001</td>
                                <td>Toyota Car Package</td>
                                <td>
                                <button type="button" class="btn bg-gradient-danger"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr class="expandable-body">
                                <td colspan="5">
                                <p>
                                    <div class="row">

                                    <div class="col-md-6">
                                        <table class="table table-sm table-striped">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Fuel Type</th>
                                            <th>Price</th>
                                            <th>Select</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <tr>
                                            <td>1.</td>
                                            <td>Castrol/Valvoline 10W-30</td>
                                            <td>
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
                                            <td>
                                            <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio1">
                                            <label for="customRadio1" class="custom-control-label"></label>
                                            </div>
                                            </td>
                                            </tr>

                                            <tr>
                                            <td>2.</td>
                                            <td>Castrol/Valvoline 10W-30</td>
                                            <td>
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
                                            <td>
                                            <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio1">
                                            <label for="customRadio2" class="custom-control-label"></label>
                                            </div>
                                            </td>
                                            </tr>
                                        
                                            
                                        </tbody>
                                        </table>
                                    </div>
            
                                    <div class="col-md-6">
                                        <table class="table table-sm table-striped">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Filter Type</th>
                                            <th>Price</th>
                                            <th>Select</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <tr>
                                            <td>1.</td>
                                            <td>Castrol/Valvoline 10W-30</td>
                                            <td>
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
                                            <td>
                                            <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio3" name="customRadio4">
                                            <label for="customRadio3" class="custom-control-label"></label>
                                            </div>
                                            </td>
                                            </tr>

                                            <tr>
                                            <td>2.</td>
                                            <td>Castrol/Valvoline 10W-30</td>
                                            <td>
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
                                            <td>
                                            <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio4" name="customRadio4">
                                            <label for="customRadio4" class="custom-control-label"></label>
                                            </div>
                                            </td>
                                            </tr>
                                        
                                            
                                        </tbody>
                                        </table>
                                    </div>
                                    </div>

                                </p>
                                </td>
                            </tr>
                        </span> -->

                       
                            <!-- <tr data-widget="expandable-table" aria-expanded="false">
                                <td>001</td>
                                <td>Toyota Car Package</td>
                                <td>
                                <button type="button" class="btn bg-gradient-danger"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr class="expandable-body">
                                <td colspan="5">
                                <p>
                                    <div class="row">

                                    <div class="col-md-6">
                                        <table class="table table-sm table-striped">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Fuel Type</th>
                                            <th>Price</th>
                                            <th>Select</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <tr>
                                            <td>1.</td>
                                            <td>Castrol/Valvoline 10W-30</td>
                                            <td>
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
                                            <td>
                                            <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio1">
                                            <label for="customRadio1" class="custom-control-label"></label>
                                            </div>
                                            </td>
                                            </tr>

                                            <tr>
                                            <td>2.</td>
                                            <td>Castrol/Valvoline 10W-30</td>
                                            <td>
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
                                            <td>
                                            <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio1">
                                            <label for="customRadio2" class="custom-control-label"></label>
                                            </div>
                                            </td>
                                            </tr>
                                        
                                            
                                        </tbody>
                                        </table>
                                    </div>
            
                                    <div class="col-md-6">
                                        <table class="table table-sm table-striped">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Filter Type</th>
                                            <th>Price</th>
                                            <th>Select</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <tr>
                                            <td>1.</td>
                                            <td>Castrol/Valvoline 10W-30</td>
                                            <td>
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
                                            <td>
                                            <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio3" name="customRadio4">
                                            <label for="customRadio3" class="custom-control-label"></label>
                                            </div>
                                            </td>
                                            </tr>

                                            <tr>
                                            <td>2.</td>
                                            <td>Castrol/Valvoline 10W-30</td>
                                            <td>
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
                                            <td>
                                            <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio4" name="customRadio4">
                                            <label for="customRadio4" class="custom-control-label"></label>
                                            </div>
                                            </td>
                                            </tr>
                                        
                                            
                                        </tbody>
                                        </table>
                                    </div>
                                    </div>

                                </p>
                                </td>
                            </tr> -->
                        

                          
                        
                            </tbody>
                        </table>

                        </div>
                        </div>
                        <h4><b>Total - LKR <span id="service-package-total">00</span>/=</b></h4>


                        <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                        <button id="job-card-step-4" class="btn btn-primary" >Next</button>
                </div>
                <!-- Search Service Packages  - Step 4 -->


                
                <!-- Repair Packages  - Step 5 -->
                <div id="maintenance-part" class="content" role="tabpanel" aria-labelledby="maintenance-part-trigger">

                    <div id="maintenance-part-container" class="row">

                        <div class="col-md-12">
                        <h5 class="text-center"><b>Select Repair Packages</b></h5>
                        <select class="custom-select mb-4" id="cmbrepair">
                            <option value="" disabled selected>Search Repair Packages</option>
                            </select>

                        </div>
                    </div>

                    <table class="table table-striped repairTable">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Repair Package Name</th>
                        <th>Labour Hr</th>
                        <th>Unit Price (LKR)</th>
                        <th>Discount (LKR)</th>
                        <th>Total (LKR)</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="table-jobcard-repair">

                        <!-- <tr>
                        <td>1.</td>
                        <td>Lathe Work</td>

                        <td>  
                            <div class="input-group">
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            </div>
                        </td>
                        
                        <td>  
                            <div class="input-group">
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            </div>
                        </td>

                        <td>  
                            <div class="input-group">
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            </div>
                        </td>

                        <td>  
                            <p class="h6">400.00</p>
                        </td>

                        <td>  
                        <button type="button" class="btn bg-gradient-danger"><i class="fas fa-trash"></i></button>
                        </td>

                        </tr> -->

                        
                

                    

                    </tbody>
                    </table>

                    <h4><b>Total - LKR <span id="repair-final-total">00</span>/=</b></h4>

                    <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                    <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                </div>
                <!-- Repair Packages  - Step 5 -->


                <!--  Products  - Step 6 -->
                <div id="select-products-part" class="content" role="tabpanel" aria-labelledby="select-products-part-trigger">
                    <div class="row">

                    <div class="col-md-12">
                    <h5 class="text-center"><b>Select Products</b></h5>
                    <select class="custom-select mb-4" id="cmbproducts">
                        <option value="" disabled selected>Search Products</option>
                        </select>

                    </div>
                    </div>


                    <table class="table table-striped productsTable">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Products Name</th>
                        <th>QTY</th>
                        <th>Unit Price (LKR)</th>
                        <th>Discount (LKR)</th>
                        <th>Total (LKR)</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="table-jobcard-products">

                    <!-- <tr>
                        <td>1.</td>
                        <td>Head Light</td>
                        <td>  
                            <div class="input-group">
                            <input type="text" class="form-control quantityQty">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            </div>
                        </td>

                        <td>  
                            <div class="input-group">
                            <input type="text" class="form-control unitPriceProduct">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            </div>
                        </td>

                        <td>  
                            <div class="input-group">
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            </div>
                        </td>

                        <td>  
                            <p class="h6">400.00</p>
                        </td>

                        <td>  
                        <button type="button" class="btn bg-gradient-danger"><i class="fas fa-trash"></i></button>
                        </td>

                        </tr> -->

                        <!-- <tr>
                        <td>2.</td>
                        <td>Face Repair</td>

                        <td>  
                            <div class="input-group">
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            </div>
                        </td>

                        <td>  
                            <div class="input-group">
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            </div>
                        </td>

                        <td>  
                            <div class="input-group">
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            </div>
                        </td>

                        <td>  
                            <p class="h6">400.00</p>
                        </td>

                        <td>  
                        <button type="button" class="btn bg-gradient-danger"><i class="fas fa-trash"></i></button>
                        </td>

                        </tr> -->

                    </tbody>
                    </table>

                    <h4><b>Total - LKR <span id="total-final-product">00</span>/=</b></h4>

                    <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                    <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                </div>
                <!--  Products  - Step 6 -->

                <!-- Generate Invoice  - Step 7 -->
                <div id="generate-invoice-part" class="content" role="tabpanel" aria-labelledby="generate-invoice-part-trigger">

                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-md-1">
                            <img width="150" src="../dist/img/system/logo_pistona.png" alt="Station Logo">
                            </div>
                        

                            <div class="row col-md-10">
                            <div class="col-md-12">
                            <h5 class="text-center text-uppercase">
                                <b>
                                Pistona Automotive Solutions (Pvt) Ltd
                                </b>
                            </h5>
                            </div>

                            <div class="col-md-12">
                                <p class="text-center text-uppercase m-0 p-0">
                                    385/45, Major Wasantha gunarathne mw, mahara kadawatha
                                </p>
                            </div>

                            <div class="col-md-12">
                                <p class="text-center m-0 p-0">
                                    Tel: 0117600800 Fax : 0112948098
                                </p>
                            </div>

                            <div class="col-md-12">
                                <p class="text-center m-0 p-0">
                                    Email: pistonaautomotivesolutions@gmail.com
                                </p>
                            </div>
                            <div class="col-md-12">
                            <h5 class="text-center text-uppercase">
                                Invoice
                            </h5>
                            </div>
                            </div>

                            <!-- /.col -->
                        </div>

                        <hr>

                        <!-- info row -->
                        <div class="row">
                        <div class="col-sm-6 mx-auto">
                            <span><b>Job Card No</b></span> : <span id="in_jobcard_no"></span><br>
                            <span><b>Customer Name</b></span> : <span class="text-uppercase" id="in_vehicle_owner"></span><br>
                            <span><b>Address</b></span> : <span class="text-uppercase" id="in_address"></span><br />
                            <span><b>Contact No.</b></span> : <span class="text-uppercase" id="in_contact_number"></span><br />
                            <span><b>VAT No</b></span> : <span class="text-uppercase"></span><br />
                            <span><b>Model Code</b></span> : <span class="text-uppercase" id="in_model"></span><br />
                            <span><b>Make Code</b></span> : <span class="text-uppercase" id="in_make"></span><br />
                            <span><b>Current Mileage</b></span> : <span class="text-uppercase" id="in_current_mileage"></span><br />
                       
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-6 mx-auto">
                            <span><b>Invoice No</b></span> : <span class="text-uppercase" id="in_invoice_no"></span><br>
                            <span><b>Invoice Date</b></span> : <span class="text-uppercase"></span><br>
                            <span><b>Vehicle No</b></span> : <span class="text-uppercase" id="in_vehicle_no"></span><br>
                            <span><b>Opening Date</b></span> : <span class="text-uppercase" id="in_opening_date"></span><br>
                            <span><b>Closing Date</b></span> : <span class="text-uppercase"></span><br>
                            <span><b>Nxt Serv.Mileage</b></span> : <span class="text-uppercase" id="in_next_mileage"></span><br>
                            <span><b>Chassis No</b></span> : <span class="text-uppercase" id="in_chassis_no"></span><br>
                            <span><b>Engine No</b></span> : <span class="text-uppercase" id="in_engine_no"></span><br>

                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row my-3">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Code</th>
                                <th>Item Description</th>
                                <th>QTY / Labour Hr</th>
                                <th>Unit Price (LKR)</th>
                                <th>Amount (LKR)</th>
                                <th>Discount (LKR)</th>
                                <th>Total (LKR)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>00-93987-3</td>
                                <td class="text-uppercase">oil filter-micro mtw 62 (c-809)</td>
                                <td>1.5</td>
                                <td>999.98</td>
                                <td>1999.98</td>
                                <td>999.998</td>
                                <td>999.998</td>
                            </tr>
                            <tr>
                                <td>00-93987-3</td>
                                <td class="text-uppercase">oil filter-micro mtw 62 (c-809)</td>
                                <td>1.5</td>
                                <td>999.98</td>
                                <td>1999.98</td>
                                <td>999.998</td>
                                <td>999.998</td>
                            </tr>
                            
                            </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->




                        <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-6">
                        
                        </div>
                        <!-- /.col -->
                        <div class="col-6">

                            <div class="table-responsive">
                            <table class="table">
                                <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>LKR 250.30</td>
                                </tr>
                                <tr>
                                <th>VAT (9.3%) :</th>
                                <td>
                                    <div class="input-group w-50">
                                    <input type="text" class="form-control">
                                    <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                </td>
                                </tr>
                                <tr>
                                <th>Total Amount :</th>
                                <td>LKR 265.24</td>
                                </tr>
                            </table>
                            </div>
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->

                       
                    </div>

                    <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <!-- Generate Invoice  - Step 7 -->

              </div>

             




                </div>
              </div>
              <!-- /.card-body -->
           
            </div>
            <!-- /.card -->
          </div>
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

<script src="../plugins/jquery/jquery.min.js"></script>

<?php include_once '../includes/footer.php';?>

<script src="../assets/js/add-jobcard.js"></script>

</body>
</html>
