
<?php include_once '../includes/header.php';?>
<?php include_once '../api/completed-jobcard-list.php';?>

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
          <div class="col-sm-10">
            <h1>Completed Job Card List</h1>
          </div>
          <div class="col-sm-2">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Vehicles</li>
            </ol> -->
            <a href="../job-cards/add-job-card.php" type="button" class="btn bg-gradient-primary"><i class="fas fa-plus"></i> Add Job Card</a>
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
              <div class="card-header">
                <h3 class="card-title">Completed Job Cards</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Job Card Code</th>
                    <th>Vehicle Owner Name</th>
                    <th>Phone</th>
                    <th>Vehicle Name</th>
                    <th>Job Card Type</th>
                    <th>Created Date</th>
                    <th>Completed Date</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php foreach ($jobcards as $row) : ?>

                    <tr>
                      <td><?php echo  $row["job_card_code"]; ?></td>
                      <td><?php echo  $row["first_name"]; ?> <?php echo  $row["last_name"]; ?></td>
                      <td><?php echo  $row["phone"]; ?></td>
                      <td><?php echo  $row["vehicle_number"]; ?></td>
                      <td><?php echo  $row["JOB_CARD_TYPE"]; ?></td>
                      <td><?php echo  $row["JOB_CARD_PLACED_DATE"]; ?></td>
                      <td><?php echo  $row["COMPLETED_DATE"]; ?></td>
                      <td> 
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-xl">
                      <i class="fa fa-address-book" aria-hidden="true"></i>
                      </button>
                    </td>
                    </tr>

                    <?php endforeach; ?>
                 
                
                  </tbody>
                </table>
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

  <!-- modal -->

  <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Invoice #le4Csn69bAP3eIpkYuHy</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
 
    <!-- Content Header (Page header) -->
 
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
                      <!-- title row -->
                      <div class="row">
                            <div class="col-md-1">
                            <img id="in_station_logo" width="150" src="https://img.freepik.com/premium-vector/gas-station-icon-with-fuel-concept_11481-928.jpg?semt=ais_hybrid" alt="Station Logo">
                            </div>
                        

                            <div class="row col-md-10">
                            <div class="col-md-12">
                            <h4 class="text-center text-uppercase">
                                <b id="in_station_name">
                                 ABC Service Station
                                </b>
                            </h4>
                            </div>

                            <div class="col-md-12">
                                <p id="in_station_address" class="text-center text-uppercase m-0 p-0">
                                120/5 Vidya Mawatha, Colombo 00700
                                </p>
                            </div>

                            <div class="col-md-12">
                                <p class="text-center m-0 p-0">
                                    Tel: <span id="in_station_phone">+94 764961707</span>
                                </p>
                            </div>

                            <div class="col-md-12">
                                <p class="text-center m-0 p-0">
                                    Email: <span id="in_station_email">abcservicestation@gmail.com</span>
                                </p>
                            </div>
                            <div class="col-md-12">
                            <h2 class="text-center text-uppercase">
                                Invoice
                            </h2>
                            </div>
                            </div>

                            <!-- /.col -->
                        </div>

                        <hr>

                        <!-- info row -->
                        <div class="row my-4">
                        <div class="col-sm-6 mx-auto">
                            <span><b>Job Card No</b></span> : <span id="in_jobcard_no">5n4esIAcheTUd08xYrDK</span><br>
                            <span><b>Customer Name</b></span> : <span class="text-uppercase" id="in_vehicle_owner">Gimna Katugampala</span><br>
                            <span><b>Address</b></span> : <span class="text-uppercase" id="in_address">Colombo</span><br />
                            <span><b>Contact No.</b></span> : <span class="text-uppercase" id="in_contact_number">0764961707</span><br />
                            <span><b>VAT No (%)</b></span> : <span class="text-uppercase" id="in_vat">4.5</span><br />
                            <span><b>Model Code</b></span> : <span class="text-uppercase" id="in_model">S10 Pickup 2WD</span><br />
                            <span><b>Make Code</b></span> : <span class="text-uppercase" id="in_make">Honda</span><br />
                            <span><b>Current Mileage</b></span> : <span class="text-uppercase" id="in_current_mileage">1000 KM</span><br />
                            <span><b>Employee Name</b></span> : <span class="text-uppercase" ><?php echo $_SESSION["user_emp_name"];?></span><br />
                       
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-6 mx-auto">
                            <span><b>Invoice No</b></span> : <span class="text-uppercase" id="in_invoice_no">le4Csn69bAP3eIpkYuHy</span><br>
                            <span><b>Invoice Date</b></span> : <span class="text-uppercase"></span>11-02-2025<br>
                            <span><b>Vehicle No</b></span> : <span class="text-uppercase" id="in_vehicle_no">DAH-0987</span><br>
                            <span><b>Opening Date</b></span> : <span class="text-uppercase" id="in_opening_date">11-02-2025</span><br>
                            <span><b>Closing Date</b></span> : <span class="text-uppercase">11-02-2025</span><br>
                            <span><b>Nxt Serv.Mileage</b></span> : <span class="text-uppercase" id="in_next_mileage">5500 KM</span><br>
                            <span><b>Chassis No</b></span> : <span class="text-uppercase" id="in_chassis_no">390DFG</span><br>
                            <span><b>Engine No</b></span> : <span class="text-uppercase" id="in_engine_no">234456</span><br>
                            <span><b>Job Card Type</b></span> : <span class="text-uppercase" id="in_job_card_type">Washer Only</span><br>
                            

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
                      <th>Code</th>
                      <th>Item Description</th>
                      <th>QTY / Labour Hr</th>
                      <th>Unit Price (LKR)</th>
                      <th>Discount (LKR)</th>
                      <th>Total (LKR)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>k141smgmNglR2gpiMLnJ</td>
                      <td>Wash</td>
                      <td>1</td>
                      <td>1500</td>
                      <td>0</td>
                      <td>1500.00</td>
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
                  <p class="lead">Paid Date 2/22/2014</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>LKR 250.30</td>
                      </tr>
                      <tr>
                        <th>VAT (9.3%)</th>
                        <td>10.34</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
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
                  <a  rel="noopener" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
  <!-- modal -->

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
