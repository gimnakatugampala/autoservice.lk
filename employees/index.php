<?php include_once '../includes/header.php';?>
<?php include_once '../api/employeelist.php';?>

<style>
    /* Styling to match AdminLTE professional standards */
    .content-wrapper { background-color: #f4f6f9; }
    .card-primary.card-outline { border-top: 3px solid #007bff; }
    
    .table thead th {
        border-top: 0;
        border-bottom: 2px solid #dee2e6;
        text-transform: uppercase;
        font-size: 0.8rem;
        font-weight: 700;
        color: #495057;
    }

    .btn-action-sm {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
    }

    .user-type-badge {
        font-size: 0.75rem;
        padding: 0.4em 0.8em;
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include_once '../includes/loader.php';?>

  <?php include_once '../includes/navbar.php'; ?>
  <?php include_once '../includes/sidebar.php';?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1 class="m-0 font-weight-bold text-dark">Employee Management</h1>
          </div>
          <div class="col-sm-2">
            <a href="../employees/add-employee.php" class="btn btn-block bg-gradient-primary elevation-2">
              <i class="fas fa-user-plus mr-1"></i> Add Employee
            </a>
          </div>
        </div>
      </div></section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
      
            <div class="card card-primary card-outline shadow-sm">
              <div class="card-header">
                <h3 class="card-title text-bold"><i class="fas fa-users mr-2"></i> Active Employees</h3>
                <div class="card-tools">
                   <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-hover table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>NIC</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>User Type</th>
                    <th class="text-center">Actions</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php foreach ($employees as $row) : ?>
                    <tr>
                      <td class="text-muted font-italic">#<?php echo $row["code"]; ?></td>
                      <td><span class="badge badge-light border"><?php echo $row["nic"]; ?></span></td>
                      <td class="font-weight-bold">
                        <i class="far fa-user-circle text-gray mr-2"></i>
                        <?php echo $row["first_name"] . ' ' . $row["last_name"]; ?>
                      </td>
                      <td><a href="mailto:<?php echo $row["email"]; ?>" class="text-lowercase"><?php echo $row["email"]; ?></a></td>
                      <td>
                        <i class="fas fa-phone-alt text-muted mr-1" style="font-size: 0.7rem;"></i>
                        <?php echo $row["contact_number"]; ?>
                      </td>
                      <td>
                        <span class="badge badge-info user-type-badge shadow-none">
                            <?php echo $row["userType"]; ?>
                        </span>
                      </td>
                      <td class="text-center">
                        <a href="../employees/edit-employee.php?code=<?php echo $row['code'];?>" 
                           class="btn btn-info btn-action-sm shadow-sm" 
                           data-toggle="tooltip" 
                           title="Edit Employee">
                          <i class="fas fa-pen fa-xs"></i>
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>

                  </tbody>
                </table>
              </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  <?php include_once '../includes/sub-footer.php';?>

  <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>
<?php include_once '../includes/footer.php';?>

<script>
  $(function () {
    if (!$.fn.DataTable.isDataTable('#example1')) {
        $("#example1").DataTable({
          "responsive": true, 
          "lengthChange": true, 
          "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    }
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>

</body>
</html>