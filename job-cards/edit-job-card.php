<?php require_once '../includes/db_config.php';?>
<?php include_once '../includes/header.php';?>

<?php
$job_card_id = isset($_GET['code']) ? mysqli_real_escape_string($conn, $_GET['code']) : null;
if (!$job_card_id) {
    echo "<script>alert('No Job Card ID provided'); window.location='index.php';</script>";
    exit;
}
?>

<input type="hidden" id="edit_job_card_id" value="<?php echo $job_card_id; ?>">

<style>
.content-wrapper { height: auto !important; min-height: auto !important; }
.card, .card-body { height: auto !important; min-height: 0 !important; display: block !important; }
.bs-stepper { display: block !important; width: 100% !important; height: auto !important; margin: 0 !important; padding: 0 !important; }
.bs-stepper-header { display: flex !important; flex-wrap: wrap !important; align-items: flex-start !important; margin: 0 !important; padding: 10px 0 15px 0 !important; border-bottom: 1px solid #dee2e6; background: transparent !important; }
.bs-stepper-content { display: block !important; margin-top: 0 !important; padding: 20px 10px 10px 10px !important; height: auto !important; width: 100% !important; position: relative !important; }
.bs-stepper-content > .content { display: none; width: 100%; }
.bs-stepper-content > .content.active, .bs-stepper-content > .content.dstepper-block { display: block !important; }
.bs-stepper-header .col-md-1, .bs-stepper-header .col-md-2 { margin: 0 !important; padding: 5px !important; }
.bs-stepper .step-trigger { padding: 5px !important; display: inline-flex !important; align-items: center !important; }
.bs-stepper-label { margin-left: 5px; margin-top: 0 !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const firstStepContent = document.querySelector('#search-vehicle-part');
    if (firstStepContent) {
        firstStepContent.classList.add('active', 'dstepper-block');
        firstStepContent.style.display = 'block';
    }
    setTimeout(function() {
        document.querySelectorAll('.bs-stepper, .bs-stepper-content, .card, .card-body').forEach(function(el) {
            el.style.setProperty('height', 'auto', 'important');
            el.style.setProperty('min-height', '0px', 'important');
            el.style.setProperty('justify-content', 'flex-start', 'important');
        });
        var stepper = document.querySelector('.bs-stepper');
        if (stepper) stepper.classList.remove('d-flex');
    }, 200);
});
</script>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php include_once '../includes/loader.php';?>
  <?php include_once '../includes/navbar.php'; ?>
  <?php include_once '../includes/sidebar.php';?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"><h1>Edit Job Card</h1></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="index.php">Job Cards</a></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-body p-2">

                <div class="bs-stepper">
                  <div class="bs-stepper-header d-flex flex-wrap" role="tablist">

                    <div class="col-md-2">
                      <div class="step" data-target="#search-vehicle-part">
                        <button type="button" class="step-trigger" role="tab">
                          <span class="bs-stepper-circle">1</span>
                          <span class="bs-stepper-label">Vehicle Info</span>
                        </button>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="step" data-target="#vehicle-report-part">
                        <button type="button" class="step-trigger" role="tab">
                          <span class="bs-stepper-circle">2</span>
                          <span class="bs-stepper-label">Vehicle Report</span>
                        </button>
                      </div>
                    </div>

                    <div class="col-md-1">
                      <div class="step" data-target="#washer-part">
                        <button type="button" class="step-trigger" role="tab">
                          <span class="bs-stepper-circle">3</span>
                          <span class="bs-stepper-label">Washer</span>
                        </button>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="step" data-target="#service-package-part">
                        <button type="button" class="step-trigger" role="tab">
                          <span class="bs-stepper-circle">4</span>
                          <span class="bs-stepper-label">Service Packages</span>
                        </button>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="step" data-target="#maintenance-part">
                        <button type="button" class="step-trigger" role="tab">
                          <span class="bs-stepper-circle">5</span>
                          <span class="bs-stepper-label">Repair Packages</span>
                        </button>
                      </div>
                    </div>

                    <div class="col-md-1">
                      <div class="step" data-target="#select-products-part">
                        <button type="button" class="step-trigger" role="tab">
                          <span class="bs-stepper-circle">6</span>
                          <span class="bs-stepper-label">Products</span>
                        </button>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="step" data-target="#generate-invoice-part">
                        <button type="button" class="step-trigger" role="tab">
                          <span class="bs-stepper-circle">7</span>
                          <span class="bs-stepper-label">Generate Invoice</span>
                        </button>
                      </div>
                    </div>

                  </div><!-- /.bs-stepper-header -->

                  <div class="bs-stepper-content">

                    <!-- ===== STEP 1: Vehicle Info ===== -->
                    <div id="search-vehicle-part" class="content active dstepper-block" role="tabpanel">
                      <div class="row">
                        <div class="col-md-12">
                          <h5 class="text-center"><b>Vehicle Information</b></h5>
                        </div>
                      </div>
                      <div id="search-vehicle-content">
                        <div class="d-flex justify-content-center my-4">
                          <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                          </div>
                        </div>
                      </div>
                      <button class="btn btn-primary mt-3" id="job-card-step-1">Next</button>
                    </div>

                    <!-- ===== STEP 2: Vehicle Report ===== -->
                    <div id="vehicle-report-part" class="content" role="tabpanel">
                      <div class="row">
                        <div class="col-md-12">
                          <h5 class="text-center"><b>Vehicle Report</b></h5>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12" id="vehicle-report-container">
                          <!-- Dynamically loaded -->
                        </div>
                      </div>
                      <button class="btn btn-secondary" onclick="stepper.previous()">Previous</button>
                      <button class="btn btn-primary" id="job-card-step-2">Next</button>
                    </div>

                    <!-- ===== STEP 3: Washer ===== -->
                    <div id="washer-part" class="content" role="tabpanel">
                      <div class="row mb-2">
                        <div class="col-md-12">
                          <h5 class="text-center"><b>Washer Packages</b></h5>
                        </div>
                      </div>

                      <!-- Washer table rendered by JS (same structure as add_jobcard populateWasherTable) -->
                      <div id="washer-part-container"></div>

                      <button class="btn btn-secondary" onclick="stepper.previous()">Previous</button>
                      <button class="btn btn-primary" id="job-card-step-3">Next</button>
                    </div>

                    <!-- ===== STEP 4: Service Packages ===== -->
                    <div id="service-package-part" class="content" role="tabpanel">
                      <div class="row mb-2">
                        <div class="col-md-12">
                          <h5 class="text-center"><b>Service Packages</b></h5>
                        </div>
                      </div>

                      <!-- Dropdown — populated by JS on load, same as add_jobcard -->
                      <div class="row mb-3">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Select Service Package</label>
                            <select id="cmbservicepackages" class="custom-select">
                              <option value="" selected disabled>Please Select</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <!-- Expandable rows table — same markup as add_jobcard -->
                      <div id="service-package-part-container">
                        <div class="row">
                          <div class="col-md-12">
                            <table id="tableServicePackage" class="table table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Package Name</th>
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody id="table-jobcard-service-packages"></tbody>
                            </table>
                          </div>
                        </div>
                      </div>

                      <div id="service-package-total-container">
                        <h4><b>Total - LKR <span id="service-package-total">0.00</span>/=</b></h4>
                      </div>

                      <button class="btn btn-secondary" onclick="stepper.previous()">Previous</button>
                      <button class="btn btn-primary" id="job-card-step-4">Next</button>
                    </div>

                    <!-- ===== STEP 5: Repairs ===== -->
                    <div id="maintenance-part" class="content" role="tabpanel">
                      <div class="row mb-2">
                        <div class="col-md-12">
                          <h5 class="text-center"><b>Repair Packages</b></h5>
                        </div>
                      </div>

                      <!-- Dropdown — populated by JS on load, same as add_jobcard -->
                      <div class="row mb-3">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Select Repair</label>
                            <select id="cmbrepair" class="custom-select">
                              <option value="" selected disabled>Please Select</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <!-- Same table class as add_jobcard so shared CSS applies -->
                      <div id="maintenance-part-container">
                        <table class="table table-striped repairTable">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Repair Name</th>
                              <th>Labour Hr</th>
                              <th>Unit Price (LKR)</th>
                              <th>Discount (LKR)</th>
                              <th>Total (LKR)</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody id="table-jobcard-repair"></tbody>
                        </table>
                      </div>

                      <div id="repair-final-total-container">
                        <h4><b>Total - LKR <span id="repair-final-total">0.00</span>/=</b></h4>
                      </div>

                      <button class="btn btn-secondary" onclick="stepper.previous()">Previous</button>
                      <button class="btn btn-primary" id="job-card-step-5">Next</button>
                    </div>

                    <!-- ===== STEP 6: Products ===== -->
                    <div id="select-products-part" class="content" role="tabpanel">
                      <div class="row mb-2">
                        <div class="col-md-12">
                          <h5 class="text-center"><b>Products</b></h5>
                        </div>
                      </div>

                      <!-- Dropdown — populated by JS on load, same as add_jobcard -->
                      <div class="row mb-3">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Select Product</label>
                            <select id="cmbproducts" class="custom-select">
                              <option value="" selected disabled>Please Select</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <!-- Same table class as add_jobcard so shared CSS applies -->
                      <div id="select-products-container">
                        <table class="table table-striped productsTable">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Product Name</th>
                              <th>QTY</th>
                              <th>Unit Price (LKR)</th>
                              <th>Discount (LKR)</th>
                              <th>Total (LKR)</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody id="table-jobcard-products"></tbody>
                        </table>
                      </div>

                      <div id="total-final-product-container">
                        <h4><b>Total - LKR <span id="total-final-product">0.00</span>/=</b></h4>
                      </div>

                      <button class="btn btn-secondary" onclick="stepper.previous()">Previous</button>
                      <button class="btn btn-primary" id="job-card-step-6">Next</button>
                    </div>

                    <!-- ===== STEP 7: Invoice ===== -->
                    <div id="generate-invoice-part" class="content" role="tabpanel">
                      <div class="invoice p-3 mb-3">

                        <div class="row">
                          <div class="col-md-1">
                            <img width="150" id="station-logo" src="../dist/img/system/logo_pistona.png" alt="Station Logo">
                          </div>
                          <div class="row col-md-10">
                            <div class="col-md-12"><h5 class="text-center text-uppercase"><b id="station-name">Station Name</b></h5></div>
                            <div class="col-md-12"><p class="text-center text-uppercase m-0 p-0" id="station-address">Station Address</p></div>
                            <div class="col-md-12"><p class="text-center m-0 p-0" id="station-contact">Tel: Phone | Fax: Fax</p></div>
                            <div class="col-md-12"><p class="text-center m-0 p-0" id="station-email">Email: email@example.com</p></div>
                            <div class="col-md-12"><h5 class="text-center text-uppercase">Invoice</h5></div>
                          </div>
                        </div>

                        <hr>

                        <div class="row">
                          <div class="col-sm-4" id="invoice-customer-info"></div>
                          <div class="col-sm-4" id="invoice-vehicle-info"></div>
                          <div class="col-sm-4">
                            <p class="mb-1"><strong>Invoice Code:</strong> <span id="invoice-code">N/A</span></p>
                            <p class="mb-1"><strong>Date:</strong> <span id="invoice-date">N/A</span></p>
                            <p class="mb-1"><strong>Mileage:</strong> <span id="invoice-mileage">N/A</span></p>
                          </div>
                        </div>

                        <div class="row my-3">
                          <div class="col-12 table-responsive">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th>Code</th>
                                  <th>Item Description</th>
                                  <th>QTY / Labour Hr</th>
                                  <th>Unit Price (LKR)</th>
                                  <!-- <th>Amount (LKR)</th> -->
                                  <th>Discount (LKR)</th>
                                  <th>Total (LKR)</th>
                                </tr>
                              </thead>
                              <tbody id="tb_jobcard_items"></tbody>
                            </table>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-6"></div>
                          <div class="col-6">
                            <div class="table-responsive">
                              <table class="table">
                                <tr>
                                  <th style="width:50%">Subtotal:</th>
                                  <td>LKR <span id="in_subtotal">0.00</span></td>
                                </tr>
                                <tr>
                                  <th>VAT (%):</th>
                                  <td>
                                    <div class="input-group w-50">
                                      <input type="text" class="form-control" id="in_vat_input" value="0">
                                      <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <th>Total Amount:</th>
                                  <td>LKR <span id="in_total">0.00</span></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>

                      </div><!-- /.invoice -->

                      <button class="btn btn-secondary" onclick="stepper.previous()">Previous</button>
                      <button type="button" class="btn btn-success" id="submit_update_jobcard">
                        <i class="fas fa-save"></i> Update Job Card
                      </button>
                      <button type="button" class="btn btn-success" id="btn-loading" style="display:none;">
                        <i class="fas fa-spinner fa-spin"></i> Updating...
                      </button>
                    </div>

                  </div><!-- /.bs-stepper-content -->
                </div><!-- /.bs-stepper -->

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php include_once '../includes/sub-footer.php';?>
  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<?php include_once '../includes/footer.php';?>
<script src="../assets/js/edit-jobcard.js"></script>

</body>
</html>