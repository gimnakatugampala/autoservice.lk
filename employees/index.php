
<?php include_once '../includes/header.php';?>
<?php include_once '../api/employeelist.php';?>

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
            <h1>Employee List</h1>
          </div>
          <div class="col-sm-2">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Vehicles</li>
            </ol> -->
            <a href="../employees/add-employee.php" type="button" class="btn btn-block bg-gradient-primary"><i class="fas fa-plus"></i> Add Employee</a>
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
                <h3 class="card-title">Employees</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>NIC</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php foreach ($employees as $row) : ?>
                    <tr>
                    <td><?php echo  $row["code"]; ?></td>
                    <td><?php echo  $row["nic"]; ?></td>
                    <td><?php echo  $row["first_name"] . '' . $row["last_name"]; ?></td>
                    <td><?php echo  $row["email"]; ?></td>
                    <td><?php echo  $row["contact_number"]; ?></td>
                    <td><input type="checkbox" name="my-checkbox" checked data-bootstrap-switch></td>
                      <td>
                      <a href="../employees/employee-details.php" type="button" class="btn bg-gradient-primary"><i class="fas fa-eye"></i></a>
                      <a href="../employees/edit-employee.php?code=<?php echo $row['code'];?>" type="button" class="btn bg-gradient-info"><i class="fas fa-pen"></i></a>
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
