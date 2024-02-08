
<?php include_once '../includes/header.php';?>
<?php include_once '../api/purchaseorderlist.php';?>

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
          <div class="col-sm-9">
            <h1>Purchase Order List</h1>
          </div>
          <div class="col-sm-3">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Vehicles</li>
            </ol> -->
            <a href="../purchase-order/add-purchase-order.php" type="button" class="btn btn-block bg-gradient-primary"><i class="fas fa-plus"></i> Add Purchase Order</a>
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
                <h3 class="card-title">Purchase Orders</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Supplier Name</th>
                    <th>Placed Date</th>
                    <th>Status</th>
                    <th>Paid Status</th>
                    <th>Completed Date</th>
                    <th>Sub Total</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php foreach ($purchase_order as $row) : ?>
                    <tr>
                      <td><?php echo  $row["POCODE"]; ?></td>
                      <td><?php echo  $row["firstname"] . " ".$row["lastname"] ; ?></td>
                      <td><?php echo  $row["POCREATEDDATE"]; ?></td>

                      <?php  if($row["status_id"] == "1") : ?>
                      <td><span class="badge badge-primary">Pending</span></td>  
                      <?php  elseif ($row["status_id"] == "2"): ?>  
                      <td><span class="badge badge-danger">Canceled</span></td>  
                      <?php  elseif ($row["status_id"] == "3"): ?>  
                      <td><span class="badge badge-success">Completed</span></td>  
                      <?php  endif; ?>

                      <?php  if($row["paid_status_id"] == "1") : ?>
                      <td><span class="badge badge-danger">Not Paid</span></td>  
                      <?php  elseif ($row["paid_status_id"] == "2"): ?>  
                      <td><span class="badge badge-warning">Advance</span></td>  
                      <?php  elseif ($row["paid_status_id"] == "3"): ?>  
                      <td><span class="badge badge-success">Paid</span></td>  
                      <?php  endif; ?>

                      <!-- <td><span class="badge badge-warning">Advance</span></td> -->
                      <td><?php echo  $row["COMDATE"]; ?></td>
                      <td><?php echo  $row["sub_total"]; ?></td>
                      <td>
                        <a href="../purchase-order/purchase-order-details.php?code=<?php echo  $row["POCODE"]; ?>" type="button" class="btn bg-gradient-primary"><i class="fas fa-eye"></i></a>
                        <a href="../purchase-order/edit-purchase-order.php?code=<?php echo  $row["POCODE"]; ?>" type="button" class="btn bg-gradient-info"><i class="fas fa-pen"></i></a>
                    </td>
                  </tr>

                <?php endforeach; ?>

                  <!-- <tr>
                    <td>001</td>
                    <td>Gimna Katugampala</td>
                    <td>2024-01-17</td>
                    <td><span class="badge badge-primary">Pending</span></td>    
                    <td><span class="badge badge-warning">Advance</span></td>
                    <td>2024-1-19</td>
                    <td>20,000.00</td>
                    <td>
                    <a href="../purchase-order/purchase-order-details.php" type="button" class="btn bg-gradient-primary"><i class="fas fa-eye"></i></a>
                    <a href="../purchase-order/edit-purchase-order.php" type="button" class="btn bg-gradient-info"><i class="fas fa-pen"></i></a>
                    </td>
                  </tr> -->
                
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
