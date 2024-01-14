
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

              <div class="card-body p-0">

                <div class="bs-stepper">
                  <div class="row bs-stepper-header" role="tablist">
                    <!-- your steps here -->
                    <div class="col-md-1">
                      <div class="step" data-target="#search-vehicle-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="search-vehicle-part" id="search-vehicle-part-trigger">
                          <span class="bs-stepper-circle">1</span>
                          <span class="bs-stepper-label">Search Vehicle</span>
                        </button>
                      </div>
                    </div>

                    <div class="line"></div>
                    <div class="col-md-2">
                    <div class="step" data-target="#vehicle-report-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="vehicle-report-part" id="vehicle-report-part-trigger">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Vehicle Condition Report</span>
                      </button>
                    </div>
                    </div>

                    <div class="line"></div>
                    <div class="col-md-2">
                    <div class="step" data-target="#service-package-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="service-package-part" id="service-package-part-trigger">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">Service Packages</span>
                      </button>
                    </div>
                    </div>

                    <div class="line"></div>
                    <div class="col-md-2">
                    <div class="step" data-target="#maintenance-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="maintenance-part" id="maintenance-part-trigger">
                        <span class="bs-stepper-circle">4</span>
                        <span class="bs-stepper-label">Maintenance Packages</span>
                      </button>
                    </div>
                    </div>

                    <div class="line"></div>
                    <div class="col-md-1">
                    <div class="step" data-target="#select-products-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="select-products-part" id="select-products-part-trigger">
                        <span class="bs-stepper-circle">5</span>
                        <span class="bs-stepper-label">Select Products</span>
                      </button>
                    </div>
                    </div>

                    <div class="line"></div>
                    <div class="col-md-2">
                    <div class="step" data-target="#generate-invoice-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="generate-invoice-part" id="generate-invoice-part-trigger">
                        <span class="bs-stepper-circle">6</span>
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
                        <select class="custom-select" id="exampleSelectBorder">
                          <option>Search Vehicle</option>
                          <option>Value 1</option>
                          <option>Value 2</option>
                          <option>Value 3</option>
                        </select>
              
                      </div>
                    </div>
                    
                    <!-- No Vehicle Selected -->
                    <!-- <div class="d-flex justify-content-center my-4">
                          <h6>OR</h6>
                    </div>

                    <div class="d-flex justify-content-center mt-4 text-center">
                      <p class="w-25">If you can't find the vehicle in the list <b>create vehicle</b> before checkout</p>
                    </div>

                    <div class="d-flex justify-content-center text-center">
                      <a href="../vehicles/add-vehicle.php" type="button" class="btn btn-outline-primary">Create Vehicle</a>
                    </div> -->


                    <!-- Vehicle Selected -->
                    <div class="row my-4">
                      <div class="col-md-5 mx-auto">
                        <div class="card p-3 py-4 border border-dark text-center">
                            <img class="rounded-circle mx-auto" style="object-fit: cover;" width="50%" height="170" src="https://hips.hearstapps.com/hmg-prod/images/2019-toyota-prius-limited-1545163015.jpg?crop=0.819xw:1.00xh;0.104xw,0&resize=768:*" alt="Vehicle">

                            <div class="mx-auto my-2">

                              <div class="d-flex align-items-center">

                                <span class="m-0 p-0 d-flex align-items-center text-secondary mr-2">
                                  <span class="mr-1">Color: </span>
                                  <div class="border inline" style="width:11px;height:11px;background-color:crimson;border-radius:50%" ></div>
                                </span>

                                <span class="h4 m-0 p-0"><b>KY-3038</b></span>
                              </div>

                              <p class="m-0 p-0 text-secondary">Gimna Katugampala</p>
                              <p class="m-0 p-0 text-secondary">+94 764961707</p>
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="d-flex justify-content-center mt-4 text-center">
                      <div class="w-25">
                        <p class="m-0 p-0"><b>This is not what your  looking for ?</b></p>
                        <p class="m-0 p-0 text-secondary">You can create new vehicle</p>
                      </div>
                    </div>

                    <div class="d-flex justify-content-center text-center my-2">
                      <a href="../vehicles/add-vehicle.php" type="button" class="btn btn-outline-primary">Create Vehicle</a>
                    </div>
               
                      <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                    </div>

                         <!-- Vehicle Report - Step 2 -->
                      <div id="vehicle-report-part" class="content" role="tabpanel" aria-labelledby="vehicle-report-part-trigger">

                      <div class="row">
                      <!-- 1 -->
                    <div class="col-md-10 table-responsive p-0 mx-auto my-2">
                      <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>Interior</th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                        <tbody>

                          <tr>
                            <td>Lights (Head,Brake,Turn)</td>
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

                          <tr>
                            <td>Windshield / Glass</td>
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

                        <!-- 2 -->
                    <div class="col-md-10 table-responsive p-0 mx-auto my-2">
                      <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>Brakes</th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                        <tbody>

                          <tr>
                            <td>Brake Pads /Shoes</td>
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
                      <button class="btn btn-primary" onclick="stepper.next()">Next</button>

                     
                    </div>

                    <!-- Search Service Packages  - Step 3 -->
                  <div id="service-package-part" class="content" role="tabpanel" aria-labelledby="service-package-part-trigger">
                 
                    <div class="row">
                      <div class="col-md-12">

                      <h5 class="text-center"><b>Select Service Packages</b></h5>
                      <select class="custom-select mb-4" id="exampleSelectBorder">
                          <option>Search Service Packages</option>
                          <option>Value 1</option>
                          <option>Value 2</option>
                          <option>Value 3</option>
                        </select>

                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Service Package Name</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>

                        <span>
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
                          </span>

                          <span>
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
                          </span>
                      
                        </tbody>
                      </table>

                      </div>
                    </div>

                      <h4><b>Total - LKR 30,000/=</b></h4>

                      <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                      <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                    </div>


                  
                  
                    <!-- Maintenance Packages  - Step 4 -->
                <div id="maintenance-part" class="content" role="tabpanel" aria-labelledby="maintenance-part-trigger">

                  <div class="row">

                      <div class="col-md-12">
                      <h5 class="text-center"><b>Select Maintenance Packages</b></h5>
                      <select class="custom-select mb-4" id="exampleSelectBorder">
                          <option>Search Maintenance Packages</option>
                          <option>Value 1</option>
                          <option>Value 2</option>
                          <option>Value 3</option>
                        </select>

                      </div>
                  </div>

                  <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Maintenance Package Name</th>
                      <th>Price (LKR)</th>
                      <th>Discount (LKR)</th>
                      <th>Total (LKR)</th>
                      <th>Actions</th>
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
                        <p class="h6">400.00</p>
                      </td>

                      <td>  
                      <button type="button" class="btn bg-gradient-danger"><i class="fas fa-trash"></i></button>
                      </td>

                    </tr>

                    <tr>
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
                        <p class="h6">400.00</p>
                      </td>

                      <td>  
                      <button type="button" class="btn bg-gradient-danger"><i class="fas fa-trash"></i></button>
                      </td>

                    </tr>

                  </tbody>
                </table>

                <h4><b>Total - LKR 14,000/=</b></h4>

                  <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                  <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                </div>


                 <!-- Select Products  - Step 5 -->
                <div id="select-products-part" class="content" role="tabpanel" aria-labelledby="select-products-part-trigger">

                 <div class="row">

                  <div class="col-md-12">
                  <h5 class="text-center"><b>Select Products</b></h5>
                  <select class="custom-select mb-4" id="exampleSelectBorder">
                      <option>Search Products</option>
                      <option>Value 1</option>
                      <option>Value 2</option>
                      <option>Value 3</option>
                    </select>

                  </div>
                  </div>


                 <table class="table table-striped">
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
                  <tbody>

                  <tr>
                      <td>1.</td>
                      <td>Head Light</td>

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

                    </tr>

                    <tr>
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

                    </tr>

                  </tbody>
                </table>

                <h4><b>Total - LKR 25,000/=</b></h4>

                 <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                 <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                  <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                 </div>


                      <!-- Generate Invoice  - Step 6 -->
                    <div id="generate-invoice-part" class="content" role="tabpanel" aria-labelledby="generate-invoice-part-trigger">

                    <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> autoservice.lk.
                    <small class="float-right">Date: 2/10/2014</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>Admin, Inc.</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (804) 123-5432<br>
                    Email: info@almasaeedstudio.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>John Doe</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (555) 539-1037<br>
                    Email: john.doe@example.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #007612</b><br>
                  <br>
                  <b>Order ID:</b> 4F3S8J<br>
                  <b>Payment Due:</b> 2/22/2014<br>
                  <b>Account:</b> 968-34567
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Qty</th>
                      <th>Product</th>
                      <th>Serial #</th>
                      <th>Description</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>1</td>
                      <td>Call of Duty</td>
                      <td>455-981-221</td>
                      <td>El snort testosterone trophy driving gloves handsome</td>
                      <td>$64.50</td>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>Need for Speed IV</td>
                      <td>247-925-726</td>
                      <td>Wes Anderson umami biodiesel</td>
                      <td>$50.00</td>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>Monsters DVD</td>
                      <td>735-845-642</td>
                      <td>Terry Richardson helvetica tousled street art master</td>
                      <td>$10.70</td>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>Grown Ups Blue Ray</td>
                      <td>422-568-642</td>
                      <td>Tousled lomo letterpress</td>
                      <td>$25.99</td>
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
                  <p class="lead">Payment Methods:</p>
                  <img src="../dist/img/credit/visa.png" alt="Visa">
                  <img src="../dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="../dist/img/credit/american-express.png" alt="American Express">
                  <img src="../dist/img/credit/paypal2.png" alt="Paypal">

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Amount Due 2/22/2014</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>$250.30</td>
                      </tr>
                      <tr>
                        <th>Tax (9.3%)</th>
                        <td>$10.34</td>
                      </tr>
                      <tr>
                        <th>Shipping:</th>
                        <td>$5.80</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>$265.24</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>

                      <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                       <button type="submit" class="btn btn-primary">Submit</button>
                  </div>


                    
          

               


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

<?php include_once '../includes/footer.php';?>

</body>
</html>
