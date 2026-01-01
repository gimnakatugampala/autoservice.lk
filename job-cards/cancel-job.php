<?php include_once '../includes/header.php';?>
<?php include_once '../api/cancel-jobcard-list.php';?>

<style>
    /* Styling to match AdminLTE professional standards for Canceled records */
    .content-wrapper { background-color: #f4f6f9; }
    .card-danger.card-outline { border-top: 3px solid #dc3545; }
    
    .table thead th {
        border-top: 0;
        border-bottom: 2px solid #dee2e6;
        text-transform: uppercase;
        font-size: 0.8rem;
        font-weight: 700;
        color: #495057;
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
            <h1 class="m-0 font-weight-bold text-dark"><i class="fas fa-file-excel mr-2 text-danger"></i>Cancel Job Card List</h1>
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
      
            <div class="card card-danger card-outline shadow-sm">
              <div class="card-header">
                <h3 class="card-title text-bold text-danger">
                    <i class="fas fa-ban mr-1"></i> Canceled Job Cards
                </h3>
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
                    <th>Vehicle Name</th>
                    <th>Job Card Type</th>
                    <th>Created Date</th>
                    <th>Canceled Date</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php foreach ($jobcards as $row) : ?>

                    <tr>
                      <td class="font-weight-bold text-muted"><?php echo  $row["job_card_code"]; ?></td>
                      <td class="text-uppercase"><?php echo  $row["first_name"]; ?> <?php echo  $row["last_name"]; ?></td>
                      <td><i class="fas fa-phone-alt mr-1 text-muted small"></i> <?php echo  $row["phone"]; ?></td>
                      <td><span class="badge badge-light border px-2 py-1"><?php echo  $row["vehicle_number"]; ?></span></td>
                      <td>
                          <span class="badge badge-secondary shadow-none">
                            <?php echo  $row["JOB_CARD_TYPE"]; ?>
                          </span>
                      </td>
                      <td class="text-muted small"><i class="far fa-calendar-alt mr-1"></i> <?php echo  $row["JOB_CARD_PLACED_DATE"]; ?></td>
                      <td class="text-danger font-weight-bold"><i class="fas fa-times-circle mr-1"></i> <?php echo  $row["CANCELED_DATE"]; ?></td>
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
          "order": [[6, "desc"]] // Default sort by Canceled Date
        });
    }
  });
</script>

</body>
</html>