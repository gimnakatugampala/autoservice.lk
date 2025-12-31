<?php include_once '../includes/header.php';?>
<?php require_once '../api/my-vehicleowner-list.php' ?>

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

    /* Modal Styling Fixes */
    .modal-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
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
            <h1 class="m-0 font-weight-bold text-dark">My Vehicle Owners</h1>
          </div>
          <div class="col-sm-3">
            <a href="../vehicle-owners/add-vehicle-owner.php" class="btn btn-primary btn-block elevation-2">
                <i class="fas fa-plus-circle mr-1"></i> Add Vehicle Owner
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
                <h3 class="card-title text-bold"><i class="fas fa-users mr-2"></i> Owner Records</h3>
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
                    <th>Code</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th class="text-center">Actions</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php if(isset($vehicle_owners) && (is_array($vehicle_owners) || is_object($vehicle_owners))): ?>
                    <?php foreach ($vehicle_owners as $row) : ?>
                      <tr>
                        <td class="text-muted">#<?php echo $row["VEHICLE_OWNER_CODE"]; ?></td>
                        <td class="font-weight-bold">
                            <i class="far fa-user text-gray mr-2"></i>
                            <?php echo $row["first_name"] . ' ' . $row["last_name"]; ?>
                        </td>
                        <td><span class="text-lowercase"><?php echo $row["email"]; ?></span></td>
                        <td>
                            <i class="fas fa-phone-alt text-muted mr-1" style="font-size: 0.8rem;"></i>
                            <?php echo $row["phone"]; ?>
                        </td>
                        <td class="text-center">
                          <a href="../vehicle-owners/edit-vehicle-owner.php?code=<?php echo $row['VEHICLE_OWNER_CODE'];?>" 
                             class="btn btn-info btn-action-sm shadow-sm"
                             data-toggle="tooltip"
                             title="Edit Owner">
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
  <div class="modal fade" id="modal-lg-email">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><i class="fas fa-envelope mr-2"></i>Send Email Notification</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body p-0">
              <textarea id="summernote">
                Place <em>some</em> <u>text</u> <strong>here</strong>
              </textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary px-4"><i class="fas fa-paper-plane mr-1"></i> Send Email</button>
            </div>
          </div>
          </div>
        </div>

    <div class="modal fade" id="modal-lg-sms">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><i class="fas fa-sms mr-2"></i>Send SMS Message</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body p-0">
              <textarea id="email-note">
                Place <em>some</em> <u>text</u> <strong>here</strong>
              </textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary px-4"><i class="fas fa-paper-plane mr-1"></i> Send SMS</button>
            </div>
          </div>
          </div>
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

    // Summernote
    $('#summernote').summernote({
        height: 200,
        placeholder: 'Compose email content...'
    });
    $('#email-note').summernote({
        height: 200,
        placeholder: 'Compose SMS content...'
    });

    $('[data-toggle="tooltip"]').tooltip();
  })
</script>

</body>
</html>