<?php include_once '../includes/header.php';?>
<?php include_once '../api/vehiclelist.php';?>

<style>
    /* Styling to match AdminLTE professional standards */
    .content-wrapper { background-color: #f4f6f9; }
    .card-primary.card-outline { border-top: 3px solid #007bff; }
    
    /* Vehicle plate aesthetic */
    .plate-badge {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        padding: 4px 10px;
        border-radius: 4px;
        font-family: 'Source Code Pro', monospace;
        font-weight: 700;
        color: #212529;
        display: inline-block;
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.075);
    }

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
          <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold">Vehicle List</h1>
          </div>
          <div class="col-sm-6 text-right">
            <a href="../vehicles/add-vehicle.php" class="btn btn-primary elevation-2">
                <i class="fas fa-plus-circle mr-1"></i> Add Vehicle
            </a>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="card card-primary card-outline shadow-sm">
              <div class="card-header">
                <h3 class="card-title">Vehicles</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
                </div>
              </div>
              
              <div class="card-body">
                <table id="example1" class="table table-hover table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Vehicle Number</th>
                    <th>Vehicle Class</th>
                    <th>Vehicle Make</th>
                    <th>Model</th>
                    <th>Owner</th>
                    <th class="text-center">Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(isset($vehicles) && (is_array($vehicles) || is_object($vehicles))): ?>
                    <?php foreach ($vehicles as $row) : ?>
                      <tr>
                        <td class="text-muted">#<?php echo $row["vehicle_code"]; ?></td>
                        <td>
                            <span class="plate-badge"><?php echo $row["vehicle_number"]; ?></span>
                        </td>
                        <td>
                            <span class="badge badge-info shadow-none"><?php echo $row["vehicle_class_name"]; ?></span>
                        </td>
                        <td class="font-weight-bold"><?php echo $row["vehicle_make_name"]; ?></td>
                        <td><?php echo $row["vehicle_model_name"]; ?></td>
                        <td>
                            <i class="far fa-user text-muted mr-1"></i>
                            <?php echo $row["vo_first_name"] .' ' .$row["vo_last_name"]; ?>
                        </td>
                        <td class="text-center">
                          <a href="../vehicles/edit-vehicle.php?code=<?php echo $row['vehicle_code'];?>" 
                             class="btn btn-info btn-action-sm shadow-sm" 
                             data-toggle="tooltip" 
                             title="Edit Vehicle">
                             <i class="fas fa-pen fa-xs"></i>
                          </a>
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
    // Initialize DataTable safely
    if (!$.fn.DataTable.isDataTable('#example1')) {
        $("#example1").DataTable({
          "responsive": true, 
          "lengthChange": true, 
          "autoWidth": false,
          "order": [[0, "desc"]], // Show newest first based on ID
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    }
    
    // Enable Bootstrap tooltips
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>
</body>
</html>