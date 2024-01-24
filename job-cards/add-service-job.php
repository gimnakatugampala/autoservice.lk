
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
                    <div class="step" data-target="#service-package-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="service-package-part" id="service-package-part-trigger">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Service Packages</span>
                      </button>
                    </div>
                    </div>

           

                    <div class="line"></div>
                    <div class="col-md-2">
                    <div class="step" data-target="#vehicle-report-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="vehicle-report-part" id="vehicle-report-part-trigger">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">Vehicle Condition Report</span>
                      </button>
                    </div>
                    </div>

                    <div class="line"></div>
                    <div class="col-md-2">
                    <div class="step" data-target="#generate-invoice-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="generate-invoice-part" id="generate-invoice-part-trigger">
                        <span class="bs-stepper-circle">4</span>
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
                            <!-- <img class="rounded-circle mx-auto" style="object-fit: cover;" width="50%" height="170" src="https://hips.hearstapps.com/hmg-prod/images/2019-toyota-prius-limited-1545163015.jpg?crop=0.819xw:1.00xh;0.104xw,0&resize=768:*" alt="Vehicle"> -->
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
                              <p class="m-0 p-0 text-secondary">Prev Mileage : 56,000 KM</p>
                            </div>
                        </div>
                      </div>
                    </div>

                    

                    <div class="row">
                      <div class="col-md-4 mx-auto">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Current Mileage (KM)</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Current Mileage">
                      </div>
                      </div>

                      <div class="col-md-4 mx-auto">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Next Mileage (KM)</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Next Mileage">
                      </div>
                      </div>
                    </div>

                    <div class="row">

                      <div class="col-sm-6">
                          <div class="form-group">
                            <label>Paid Status</label>
                            <select class="custom-select">
                              <option>Not Paid</option>
                              <option>Advanced</option>
                              <option>Not Paid</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Status</label>
                            <select class="custom-select">
                              <option>Inprogress</option>
                              <option>Canceled</option>
                              <option>Completed</option>
                            </select>
                          </div>
                        </div>


                    </div>

                    <div class="row">
                      <div class="col-md-6 mx-auto">
                        <label>Notify Me <span class="text-danger">*</span></label>
                      </div>
                      </div>

                    <div class="row">
                      <div class="col-md-6 mx-auto">
                        <div class="row">
                      <div class="col-md-4 mx-auto">
                      <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio" checked>
                          <label for="customRadio2" class="custom-control-label">In 2 Months</label>
                        </div>
                      </div>
                      <div class="col-md-4 mx-auto">
                      <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="customRadio4" name="customRadio" checked>
                          <label for="customRadio4" class="custom-control-label">In 4 Months</label>
                        </div>
                      </div>
                      <div class="col-md-4 mx-auto">
                      <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="customRadio6" name="customRadio" checked>
                          <label for="customRadio6" class="custom-control-label">In 6 Months</label>
                        </div>
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


                      <!-- other Info - Step 2 -->
                      <div id="other-info-part" class="content" role="tabpanel" aria-labelledby="other-info-part-trigger">

              

                        

                      
                      

          

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

                
              


                
      

            


              </div>

                 <!-- Generate Invoice  - Step 6 -->
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
                        <span><b>Order No</b></span> : <span>JMW435</span><br>
                        <span><b>Customer Name</b></span> : <span class="text-uppercase">C19436&nbsp; MR GIMNA KATUGAMPALA</span><br>
                        <span><b>Address</b></span> : <span class="text-uppercase">No:6A, Megoda Kolonnawa Wellampitiya.</span><br />
                        <span><b>Contact No.</b></span> : <span class="text-uppercase">0764961707.</span><br />
                        <span><b>VAT No</b></span> : <span class="text-uppercase"></span><br />
                        <span><b>Model Code</b></span> : <span class="text-uppercase">MC0125</span><br />
                        <span><b>Make Code</b></span> : <span class="text-uppercase">HONDA</span><br />
                        <span><b>Current Mileage</b></span> : <span class="text-uppercase">19,809.00</span><br />
                        <span><b>Order Details</b></span> : <span class="text-uppercase">5th Full Service</span><br />
                        <span><b>Order Times:</b></span> : <span class="text-uppercase">7th Time</span><br />
                      </div>
                      <!-- /.col -->

                      <div class="col-sm-6 mx-auto">
                        <span><b>Invoice No</b></span> : <span class="text-uppercase">IMW1898</span><br>
                        <span><b>Invoice Date</b></span> : <span class="text-uppercase">25/03/2024</span><br>
                        <span><b>Payment Method</b></span> : <span class="text-uppercase">Cash</span><br>
                        <span><b>Vehicle No</b></span> : <span class="text-uppercase">CAT-8717</span><br>
                        <span><b>Opening Date</b></span> : <span class="text-uppercase">25/03/2024</span><br>
                        <span><b>Closing Date</b></span> : <span class="text-uppercase">25/03/2024</span><br>
                        <span><b>Nxt Serv.Mileage</b></span> : <span class="text-uppercase">25,000 KM</span><br>
                        <span><b>Chassis No</b></span> : <span class="text-uppercase">GM4-1108287</span><br>
                        <span><b>Engine No</b></span> : <span class="text-uppercase">LEB-H15258306</span><br>

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

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                      <div class="col-12">
                        <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                        <!-- <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                          Payment
                        </button>
                        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                          <i class="fas fa-download"></i> Generate PDF
                        </button> -->
                      </div>
                    </div>
                  </div>

                  <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
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
