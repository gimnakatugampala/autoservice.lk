<?php include_once '../includes/header.php';?>
<?php include_once '../api/service-station-item-list.php';?>

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
        margin: 0 2px;
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
            <h1 class="m-0 font-weight-bold text-dark">Service Packages Items List</h1>
          </div>
          <div class="col-sm-3">
            <a href="../service-packages/add-service-package-item.php" class="btn btn-primary btn-block elevation-2">
                <i class="fas fa-plus-circle mr-1"></i> Add Item
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
                <h3 class="card-title text-bold"><i class="fas fa-list mr-2 text-primary"></i> Package Components</h3>
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
                    <th style="width: 100px;">ID</th>
                    <th>Item Name</th>
                    <th>Created Date</th>
                    <th class="text-center" style="width: 150px;">Actions</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php if(isset($service_package_objects) && (is_array($service_package_objects) || is_object($service_package_objects))): ?>
                    <?php foreach ($service_package_objects as $row) : ?>
                      <tr>
                        <td class="text-muted font-italic">#<?php echo  $row["code"]; ?></td>
                        <td class="font-weight-bold">
                            <i class="fas fa-wrench text-gray mr-2" style="font-size: 0.8rem;"></i>
                            <?php echo  $row["name"]; ?>
                        </td>
                        <td>
                            <span class="text-muted"><i class="far fa-calendar-alt mr-1"></i> <?php echo  $row["created_date"]; ?></span>
                        </td>
                        <td class="text-center">
                          <a href="../service-packages/edit-service-package-item.php?code=<?php echo  $row["code"]; ?>" 
                             class="btn btn-info btn-action-sm shadow-sm" 
                             data-toggle="tooltip" 
                             title="Edit Item">
                             <i class="fas fa-pen fa-xs"></i>
                          </a>
                        <button type="button" 
                              class="btn btn-danger btn-action-sm shadow-sm btn-delete" 
                              data-id="<?php echo $row['id']; ?>" 
                              data-toggle="tooltip" 
                              title="Delete Item">
                          <i class="fas fa-trash fa-xs"></i>
                      </button>
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

  <aside class="control-sidebar control-sidebar-dark"></aside>
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


<script src="../assets/js/service-package-items-list.js"></script>

</body>
</html>