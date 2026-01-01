<?php include_once '../includes/header.php';?>
<?php include_once '../api/service-notification-list.php';?>

<style>
    /* Styling to match AdminLTE professional standards */
    .content-wrapper { background-color: #f4f6f9; }
    .card-warning.card-outline { border-top: 3px solid #ffc107; }
    
    .table thead th {
        border-top: 0;
        border-bottom: 2px solid #dee2e6;
        text-transform: uppercase;
        font-size: 0.8rem;
        font-weight: 700;
        color: #495057;
    }

    .btn-action-sm {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .vehicle-badge {
        font-family: 'Source Code Pro', monospace;
        letter-spacing: 1px;
        font-weight: 600;
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
            <h1 class="m-0 font-weight-bold text-dark"><i class="fas fa-bell mr-2 text-warning"></i>Send Notifications</h1>
          </div>
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Send Notifications</li>
            </ol>
           
          </div>

        </div>
      </div></section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
      
            <div class="card card-warning card-outline shadow-sm">
              <div class="card-header">
                <h3 class="card-title text-bold"><i class="fas fa-users-cog mr-1"></i> Customers Reminders</h3>
                <div class="card-tools">
                   <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-hover table-striped table-valign-middle tb_notification">
                  <thead>
                  <tr>
                    <th>Job ID</th>
                    <th>Customer Name</th>
                    <th>Vehicle Number</th>
                    <th><i class="far fa-calendar-alt mr-1"></i> Last Service</th>
                    <th>Mileage (KM)</th>
                    <th class="text-center">Actions</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php foreach ($notifications as $row) : ?>

                  <tr>
                    <td class="text-muted font-italic">#<?php echo  $row["jobcard_code"]; ?></td>
                    <td class="font-weight-bold text-dark">
                        <i class="fas fa-user-circle text-gray mr-2"></i>
                        <?php echo  $row["first_name"]; ?> <?php echo  $row["last_name"]; ?>
                    </td>
                    <td>
                        <span class="badge badge-secondary vehicle-badge px-2 py-1">
                            <?php echo  $row["vehicle_number"]; ?>
                        </span>
                    </td>
                    <td><?php echo  $row["last_serv_date"]; ?></td>
                    <td>
                        <span class="text-primary font-weight-bold">
                            <?php echo number_format($row["curr_mileage"]); ?>
                        </span>
                    </td>
                    <td class="text-center">
                    <button 
                    data-jobcardid="<?php echo  $row["jobcard_id"]; ?>" 
                    data-vo="<?php echo  $row["first_name"]; ?> <?php echo  $row["last_name"]; ?>" data-vno="<?php echo  $row["vehicle_number"]; ?>" 
                    data-phone="<?php echo  $row["vehicle_o_phone"]; ?>" 
                    type="button" class="btn btn-warning btn-action-sm notificationItem shadow-sm" 
                    data-toggle="tooltip" title="Send Reminder">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                    </td>
                  </tr>

                  <?php endforeach; ?>
                
                  </tbody>
                </table>
              </div>
              <div class="card-footer bg-white small text-muted">
                <i class="fas fa-info-circle mr-1"></i> Clicking the plane icon will initiate the service reminder notification process.
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
<script src="../plugins/jquery/jquery.min.js"></script>
<?php include_once '../includes/footer.php';?>

<script src="../assets/js/notification.js"></script>
<script>
  $(function () {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // Initialize DataTable if not already done in footer
    if (!$.fn.DataTable.isDataTable('#example1')) {
      $("#example1").DataTable({
        "responsive": true, 
        "lengthChange": true, 
        "autoWidth": false,
        "order": [[3, "desc"]] // Default sort by date
      });
    }
  });
</script>
</body>
</html>