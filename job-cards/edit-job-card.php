<?php include_once '../includes/header.php';?>
<style>
/* 1. Header Fix - Removed .row class from selector so it actually applies */
.bs-stepper-header {
    margin: 0 !important;
    padding: 10px 0 !important;
    border-bottom: 1px solid #dee2e6;
    display: flex;
    flex-wrap: wrap;
}

/* 2. Remove default margins from columns inside the header */
.bs-stepper-header .col-md-1,
.bs-stepper-header .col-md-2 {
    margin-bottom: 0 !important;
    padding-bottom: 5px !important;
    padding-top: 5px !important;
}

/* 3. Force stepper content to stick to header */
.bs-stepper-content {
    padding: 0 !important;
    margin: 0 !important;
    margin-top: 0 !important; /* Explicitly remove top margin */
}

/* 4. Content visibility */
.bs-stepper-content > .content {
    display: none;
    padding: 15px !important;
    margin: 0 !important;
}

.bs-stepper-content > .content.active,
.bs-stepper-content > .content.dstepper-block {
    display: block !important;
}

/* 5. Specific fix for Step 1 display */
#search-vehicle-part {
    display: block !important; /* Changed from inline to block for better spacing */
}

/* 6. General Cleanup */
.bs-stepper .row {
    margin-bottom: 0 !important;
}

.bs-stepper .step {
    margin: 0 !important;
    padding: 0 !important;
}

.card-body.p-2 {
    padding: 10px !important;
}

.bs-stepper {
    margin: 0 !important;
    padding: 0 !important;
}

/* 7. Remove row margins inside content */
.bs-stepper-content .content > .row {
    margin-top: 0 !important;
}

.bs-stepper-content h5 {
    margin-top: 0 !important;
    margin-bottom: 15px !important;
}

/* 8. Fix Stepper Trigger padding */
.bs-stepper .step-trigger {
    padding: 8px 15px !important; /* Increased horizontal padding slightly */
}

/* 9. Library Override */
.bs-stepper > .bs-stepper-header + .bs-stepper-content {
    margin-top: 0 !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Wait a brief moment for Bootstrap to render
    setTimeout(function() {
        // Fix 1: Target header correctly (removed .row)
        const stepperHeader = document.querySelector('.bs-stepper-header');
        if (stepperHeader) {
            stepperHeader.style.marginBottom = '0';
            stepperHeader.style.paddingBottom = '5px';
            stepperHeader.style.borderBottom = '1px solid #dee2e6';
        }
        
        // Fix 2: Force content to have 0 top margin
        const stepperContent = document.querySelector('.bs-stepper-content');
        if (stepperContent) {
            stepperContent.style.setProperty('padding-top', '0', 'important');
            stepperContent.style.setProperty('margin-top', '0', 'important');
        }
    }, 100);
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
          <div class="col-sm-6">
            <h1>Edit Job Card</h1>
          </div>
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
                          <span class="bs-stepper-label">Search Vehicle</span>
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

                  </div>

                  <div class="bs-stepper-content">

                    <!-- STEP 1: Search Vehicle -->
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

                      <button class="btn btn-primary" id="job-card-step-1">Next</button>
                    </div>

                    <!-- STEP 2: Vehicle Report -->
                    <div id="vehicle-report-part" class="content" role="tabpanel">
                      <div class="row">
                        <div class="col-md-12">
                          <h5 class="text-center"><b>Vehicle Report</b></h5>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12" id="vehicle-report-tables">
                          <!-- Tables will be dynamically loaded here -->
                        </div>
                      </div>

                      <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                      <button class="btn btn-primary" id="job-card-step-2">Next</button>
                    </div>

                    <!-- STEP 3: Washers -->
                    <div id="washer-part" class="content" role="tabpanel">
                      <div class="row">
                        <div class="col-md-12">
                          <h5 class="text-center"><b>Washer Packages</b></h5>

                          <table class="table table-striped" id="table-jobcard-washer">
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
                            <tbody></tbody>
                          </table>

                          <h4><b>Total - LKR <span id="washer-grand-total">0.00</span></b></h4>
                        </div>
                      </div>

                      <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                      <button class="btn btn-primary" id="job-card-step-3">Next</button>
                    </div>

                    <!-- STEP 4: Service Packages -->
                    <div id="service-package-part" class="content" role="tabpanel">
                      <div class="row">
                        <div class="col-md-12">
                          <h5 class="text-center"><b>Service Packages</b></h5>

                          <table class="table table-bordered table-hover" id="table-service-packages">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Service Package Name</th>
                                <th>Total (LKR)</th>
                              </tr>
                            </thead>
                            <tbody></tbody>
                          </table>

                          <h4><b>Total - LKR <span id="service-package-grand-total">0.00</span></b></h4>
                        </div>
                      </div>

                      <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                      <button class="btn btn-primary" id="job-card-step-4">Next</button>
                    </div>

                    <!-- STEP 5: Repairs -->
                    <div id="maintenance-part" class="content" role="tabpanel">
                      <div class="row">
                        <div class="col-md-12">
                          <h5 class="text-center"><b>Repair Packages</b></h5>
                        </div>
                      </div>

                      <table class="table table-striped" id="table-jobcard-repair">
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
                        <tbody></tbody>
                      </table>

                      <h4><b>Total - LKR <span id="repair-grand-total">0.00</span></b></h4>

                      <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                      <button class="btn btn-primary" id="job-card-step-5">Next</button>
                    </div>

                    <!-- STEP 6: Products -->
                    <div id="select-products-part" class="content" role="tabpanel">
                      <div class="row">
                        <div class="col-md-12">
                          <h5 class="text-center"><b>Products</b></h5>
                        </div>
                      </div>

                      <table class="table table-striped" id="table-jobcard-products">
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
                        <tbody></tbody>
                      </table>

                      <h4><b>Total - LKR <span id="product-grand-total">0.00</span></b></h4>

                      <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                      <button class="btn btn-primary" id="job-card-step-6">Next</button>
                    </div>

                    <!-- STEP 7: Invoice Preview -->
                    <div id="generate-invoice-part" class="content" role="tabpanel">
                      <div class="invoice p-3 mb-3">
                        <!-- Title Row -->
                        <div class="row">
                          <div class="col-md-1">
                            <img width="150" id="station-logo" src="../dist/img/system/logo_pistona.png" alt="Station Logo">
                          </div>

                          <div class="row col-md-10">
                            <div class="col-md-12">
                              <h5 class="text-center text-uppercase">
                                <b id="station-name">Station Name</b>
                              </h5>
                            </div>
                            <div class="col-md-12">
                              <p class="text-center text-uppercase m-0 p-0" id="station-address">
                                Station Address
                              </p>
                            </div>
                            <div class="col-md-12">
                              <p class="text-center m-0 p-0" id="station-contact">
                                Tel: Phone | Fax: Fax
                              </p>
                            </div>
                            <div class="col-md-12">
                              <p class="text-center m-0 p-0" id="station-email">
                                Email: email@example.com
                              </p>
                            </div>
                            <div class="col-md-12">
                              <h5 class="text-center text-uppercase">Invoice</h5>
                            </div>
                          </div>
                        </div>

                        <hr>

                        <!-- Info Row -->
                        <div class="row">
                          <div class="col-sm-4" id="invoice-customer-info">
                            <!-- Customer info will be loaded here -->
                          </div>
                          <div class="col-sm-4" id="invoice-vehicle-info">
                            <!-- Vehicle info will be loaded here -->
                          </div>
                          <div class="col-sm-4">
                            <p class="mb-1"><strong>Invoice Code:</strong> <span id="invoice-code">N/A</span></p>
                            <p class="mb-1"><strong>Date:</strong> <span id="invoice-date">N/A</span></p>
                            <p class="mb-1"><strong>Mileage:</strong> <span id="invoice-mileage">N/A</span></p>
                          </div>
                        </div>

                        <!-- Table Row -->
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
                              <tbody id="invoice-items-tbody">
                                <!-- Invoice items will be loaded here -->
                              </tbody>
                            </table>
                          </div>
                        </div>

                        <!-- Total Section -->
                        <div class="row">
                          <div class="col-6"></div>
                          <div class="col-6">
                            <div class="table-responsive">
                              <table class="table">
                                <tr>
                                  <th style="width:50%">Subtotal:</th>
                                  <td>LKR <span id="invoice-subtotal">0.00</span></td>
                                </tr>
                                <tr>
                                  <th>VAT:</th>
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
                                  <td>LKR <span id="invoice-grand-total">0.00</span></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>

                      <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                      <button type="button" class="btn btn-success" id="submit_update_jobcard">
                        <i class="fas fa-save"></i> Update Job Card
                      </button>
                      <button type="button" class="btn btn-success" id="btn-loading" style="display:none;">
                        <i class="fas fa-spinner fa-spin"></i> Updating...
                      </button>
                    </div>

                  </div>
                </div>

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

<!-- Load footer scripts (which will conditionally exclude cmb scripts for this page) -->
<?php include_once '../includes/footer.php';?>

<!-- Load edit-jobcard.js AFTER footer scripts -->
<script src="../assets/js/edit-jobcard.js"></script>

</body>
</html>