
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
      <!-- <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div> -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
        
          <div class="invoice p-4 mb-3">
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
                        Purchase Order
                    </h5>
                </div>
                </div>

                <!-- /.col -->
                </div>

                <hr>

             <!-- info row -->
             <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>Pistona Automotive Solutions (Pvt) Ltd.</strong><br>
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
            <div class="row my-3">
                <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                    <th>Code</th>
                    <th>Item Description</th>
                    <th>QTY</th>
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
                        <td>43.00</td>
                    </tr>
                    <tr>
                    <th>Paid Amount</th>
                    <td>LKR 10.34</td>
                  </tr>
                  <tr>
                    <th>Total:</th>
                    <td><u style="text-decoration-style: double;">LKR 265.24</u></td>
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


          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
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
