<?php include_once '../includes/header.php';?>
<?php include_once '../api/purchaseorderreturn.php';?>

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
        margin-right: 2px;
    }
    
    .badge-status {
        min-width: 85px;
        padding: 5px 8px;
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
            <h1 class="m-0 font-weight-bold text-dark"><i class="fas fa-undo-alt mr-2 text-muted"></i>Purchase Order Return List</h1>
          </div>
          <div class="col-sm-3">
            <a href="../return/add-pruchase-return.php" class="btn btn-block btn-primary elevation-2">
                <i class="fas fa-plus-circle mr-1"></i> Add Order Return
            </a>
          </div>

        </div>
      </div></section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
      
            <div class="card card-primary card-outline shadow-sm">
              <div class="card-header border-0">
                <h3 class="card-title text-bold"><i class="fas fa-list mr-1"></i> Return Transaction History</h3>
                <div class="card-tools">
                   <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                <table id="example1" class="table table-hover table-striped table-valign-middle m-0">
                  <thead>
                  <tr>
                    <th style="padding-left: 20px;">ID</th>
                    <th>Supplier Name</th>
                    <th><i class="far fa-calendar-alt mr-1"></i> Return Date</th>
                    <th>Status</th>
                    <th>Paid Status</th>
                    <th><i class="fas fa-calendar-check mr-1"></i> Completed</th>
                    <th>Grand Total</th>
                    <th class="text-center">Actions</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php foreach ($purchase_order_return as $row) : ?>
                    <tr>
                      <td style="padding-left: 20px;" class="font-weight-bold text-muted"><?php echo  $row["PORCODE"]; ?></td>
                      <td class="text-uppercase font-weight-bold text-dark">
                          <i class="fas fa-user-tie text-gray mr-2" style="font-size: 0.8rem;"></i>
                          <?php echo  $row["firstname"] . " ".$row["lastname"] ; ?>
                      </td>
                      <td class="small"><?php echo  $row["PORCREATEDDATE"]; ?></td>

                      <td>
                      <?php  if($row["status_id"] == "1") : ?>
                      <span class="badge badge-primary badge-status shadow-none">Pending</span>  
                      <?php  elseif ($row["status_id"] == "2"): ?>  
                      <span class="badge badge-danger badge-status shadow-none">Canceled</span>  
                      <?php  elseif ($row["status_id"] == "3"): ?>  
                      <span class="badge badge-success badge-status shadow-none">Completed</span>  
                      <?php  endif; ?>
                      </td>

                      <td>
                      <?php  if($row["paid_status_id"] == "1") : ?>
                      <span class="badge badge-danger badge-status border border-danger bg-transparent text-danger">Not Paid</span>  
                      <?php  elseif ($row["paid_status_id"] == "2"): ?>  
                      <span class="badge badge-warning badge-status">Advance</span>  
                      <?php  elseif ($row["paid_status_id"] == "3"): ?>  
                      <span class="badge badge-success badge-status">Paid</span>  
                      <?php  endif; ?>
                      </td>

                      <td class="small font-italic"><?php echo  $row["COMDATE"] ? $row["COMDATE"] : '---'; ?></td>
                      <td class="font-weight-bold text-primary">LKR <?php echo number_format($row["sub_total"], 2); ?></td>
                      <td class="text-center">
                        <a href="../return/purchase-return-details.php?code=<?php echo  $row["PORCODE"]; ?>" 
                           class="btn btn-primary btn-action-sm shadow-sm"
                           data-toggle="tooltip" title="View Details">
                            <i class="fas fa-eye fa-xs"></i>
                        </a>
                        <a href="../return/edit-purchase-return.php?code=<?php echo  $row["PORCODE"]; ?>" 
                           class="btn btn-info btn-action-sm shadow-sm"
                           data-toggle="tooltip" title="Edit Return">
                            <i class="fas fa-pen fa-xs"></i>
                        </a>
                    </td>
                    </tr>
                  <?php endforeach; ?>

                  </tbody>
                </table>
              </div>
              <div class="card-footer bg-white py-3">
                 <small class="text-muted"><i class="fas fa-info-circle mr-1"></i> Track all items returned to suppliers and the resulting balance adjustments.</small>
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
          "order": [[2, "desc"]]
        });
    }
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>

</body>
</html>