<?php include_once '../includes/header.php';?>
<?php include_once '../api/servicepackages.php';?>

<style>
    /* AdminLTE professional standards */
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
          <div class="col-sm-9">
            <h1 class="m-0 font-weight-bold text-dark">Service Packages List</h1>
          </div>
          <div class="col-sm-3">
            <a href="../service-packages/add-service-package.php" class="btn btn-primary btn-block elevation-2">
                <i class="fas fa-plus-circle mr-1"></i> Add Service Package
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
                <h3 class="card-title text-bold"><i class="fas fa-box-open mr-2"></i> Service Packages</h3>
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
                    <th>Service Package</th>
                    <th>Vehicle Class</th>
                    <th>Created Date</th>
                    <th class="text-center">Actions</th>
                    <th class="text-center">Status</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php if(isset($service_packages) && (is_array($service_packages) || is_object($service_packages))): ?>
                    <?php foreach ($service_packages as $row) : ?>

                      
                      <tr>
                        <td class="text-muted">#<?php echo  $row["code"]; ?></td>
                        <td class="font-weight-bold"><?php echo  $row["package_name"]; ?></td>
                        <td>
                            <span class="badge badge-info px-2 py-1 shadow-none">
                                <i class="fas fa-car-side mr-1" style="font-size: 0.7rem;"></i> 
                                <?php echo  $row["vehicle_class_name"]; ?>
                            </span>
                        </td>
                        <td class="text-sm text-muted">
                            <i class="far fa-calendar-alt mr-1"></i>
                            <?php echo  $row["created_date"]; ?>
                        </td>
                        <td class="text-center">
                          <a href="../service-packages/edit-service-package.php?code=<?php echo  $row["code"]; ?>" 
                             class="btn btn-info btn-action-sm shadow-sm"
                             data-toggle="tooltip"
                             title="Edit Package">
                             <i class="fas fa-pen fa-xs"></i>
                          </a>
                        </td>
                      <td class="text-center">
    <input type="checkbox" 
           name="my-checkbox" 
           data-id="<?php echo $row['spid']; ?>" 
           <?php echo ($row['is_deleted'] == 0) ? 'checked' : ''; ?> 
           data-bootstrap-switch 
           data-off-color="danger" 
           data-on-color="success" 
           data-size="small">
</td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                
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
    // Initialize DataTable
    if (!$.fn.DataTable.isDataTable('#example1')) {
        $("#example1").DataTable({
          "responsive": true, 
          "lengthChange": true, 
          "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    }

    // Initialize Bootstrap Switch
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

    $('[data-toggle="tooltip"]').tooltip();
  })
</script>


<script src="../assets/js/service-package-status.js"></script>

</body>
</html>