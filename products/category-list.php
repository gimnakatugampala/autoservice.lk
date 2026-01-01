<?php include_once '../includes/header.php';?>
<?php include_once '../api/categorylist.php';?>

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
            <h1 class="m-0 font-weight-bold text-dark"><i class="fas fa-tags mr-2 text-muted"></i>Category Management</h1>
          </div>
          <div class="col-sm-3">
            <a href="../products/add-category.php" class="btn btn-block bg-gradient-primary elevation-2">
              <i class="fas fa-plus mr-1"></i> Add Category
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
                <h3 class="card-title text-bold">Categories</h3>
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
                    <th style="width: 15%; padding-left: 20px;">ID</th>
                    <th>Category Name</th>
                    <th><i class="far fa-calendar-alt mr-1"></i> Created Date</th>
                    <th class="text-center" style="width: 150px;">Actions</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php foreach ($product_category as $row) : ?>
                    <tr>
                      <td style="padding-left: 20px;" class="text-muted font-italic">#<?php echo  $row["code"]; ?></td>
                      <td class="font-weight-bold text-dark">
                        <i class="fas fa-folder text-warning mr-2" style="font-size: 0.9rem;"></i>
                        <?php echo  $row["name"]; ?>
                      </td>
                      <td>
                        <span class="badge badge-light border"><?php echo  $row["created_date"]; ?></span>
                      </td>
                      <td class="text-center">
                        <a href="../products/edit-category.php?code=<?php echo  $row["code"]; ?>" 
                           class="btn btn-info btn-action-sm shadow-sm" 
                           data-toggle="tooltip" 
                           title="Edit Category">
                           <i class="fas fa-pen fa-xs"></i>
                        </a>
                        <button type="button" 
                                class="btn btn-danger btn-action-sm shadow-sm" 
                                data-toggle="tooltip" 
                                title="Delete Category">
                          <i class="fas fa-trash fa-xs"></i>
                        </button>
                      </td>
                    </tr>
                  <?php endforeach; ?>

                  </tbody>
                </table>
              </div>
              <div class="card-footer bg-white py-3">
                 <small class="text-muted italic">* Managing categories helps in organizing products for better inventory tracking.</small>
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
    
    // Enable Bootstrap tooltips
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>

</body>
</html>