<?php include_once '../includes/header.php';?>
<?php include_once '../api/pending-jobcard-list.php';?>

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
            <h1 class="m-0 font-weight-bold text-dark">Pending Job Card List</h1>
          </div>
          <div class="col-sm-2">
            <a href="../job-cards/add-job-card.php" class="btn btn-block btn-primary elevation-2">
                <i class="fas fa-plus-circle mr-1"></i> Add Job Card
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
                <h3 class="card-title text-bold"><i class="fas fa-clock mr-2 text-warning"></i> Pending Job Cards</h3>
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
                    <th>Job Card Code</th>
                    <th>Vehicle Owner</th>
                    <th>Phone</th>
                    <th>Vehicle Number</th>
                    <th>Job Card Type</th>
                    <th>Created Date</th>
                    <th class="text-center">Actions</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php foreach ($jobcards as $row) : ?>

                  <tr>
                    <td class="font-weight-bold text-primary"><?php echo  $row["job_card_code"]; ?></td>
                    <td class="text-uppercase"><?php echo  $row["first_name"]; ?> <?php echo  $row["last_name"]; ?></td>
                    <td><i class="fas fa-phone-alt mr-1 text-muted small"></i> <?php echo  $row["phone"]; ?></td>
                    <td><span class="badge badge-secondary px-2 py-1"><?php echo  $row["vehicle_number"]; ?></span></td>
                    <td>
                        <span class="badge <?php echo ($row['JOB_CARD_TYPE'] == 'Service') ? 'badge-success' : 'badge-info'; ?> shadow-none">
                            <?php echo  $row["JOB_CARD_TYPE"]; ?>
                        </span>
                    </td>
                    <td class="text-muted"><i class="far fa-calendar-alt mr-1"></i> <?php echo  $row["JOB_CARD_PLACED_DATE"]; ?></td>
                    <td class="text-center">
                        <a href="../job-cards/edit-job-card.php?code=<?php echo $row['job_card_code'];?>" 
                           class="btn btn-info btn-action-sm shadow-sm" 
                           data-toggle="tooltip" 
                           title="Edit Job Card">
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
          "order": [[5, "desc"]] // Sort by Created Date by default
        });
    }
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>

</body>
</html>