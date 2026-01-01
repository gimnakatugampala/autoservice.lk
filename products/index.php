<?php include_once '../includes/header.php';?>
<?php include_once '../api/product-list.php';?>

<style>
    /* AdminLTE professional standards for Lists */
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
            <h1 class="m-0 font-weight-bold text-dark"><i class="fas fa-boxes mr-2 text-muted"></i>Product Inventory</h1>
          </div>
          <div class="col-sm-3">
            <a href="../products/add-product.php" class="btn btn-block bg-gradient-primary elevation-2">
                <i class="fas fa-plus-circle mr-1"></i> Add New Product
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
                <h3 class="card-title text-bold">Master Product List</h3>
                <div class="card-tools">
                   <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                <table id="example1" class="table table-hover table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th style="width: 10%; padding-left: 20px;">ID</th>
                    <th>Product Name</th>
                    <th><i class="fas fa-shield-alt mr-1 text-muted"></i> Warranty</th>
                    <th>Category</th>
                    <th class="text-center">QTY Available</th>
                    <th class="text-center">Actions</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php foreach ($product as $row) : ?>
                    <tr>
                      <td style="padding-left: 20px;" class="text-muted font-italic">#<?php echo  $row["code"]; ?></td>
                      <td class="font-weight-bold text-dark">
                          <i class="fas fa-cube text-gray mr-2" style="font-size: 0.8rem;"></i>
                          <?php echo  $row["product_name"]; ?>
                      </td>
                      <td>
                          <span class="badge badge-light border"><?php echo  $row["warrenty"]; ?> Years</span>
                      </td>
                      <td>
                          <span class="badge badge-info shadow-none" style="font-size: 0.75rem;">
                            <?php echo  $row["product_cat_name"]; ?>
                          </span>
                      </td>
                      <td class="text-center font-weight-bold">
                          <?php 
                            $qty = (int)$row["quantity"];
                            $qtyClass = ($qty <= 5) ? 'text-danger' : 'text-dark';
                          ?>
                          <span class="<?php echo $qtyClass; ?>"><?php echo  $row["quantity"]; ?></span>
                      </td>
                      <td class="text-center">
                        <a href="../products/edit-product.php?code=<?php echo  $row["code"]; ?>" 
                           class="btn btn-info btn-action-sm shadow-sm" 
                           data-toggle="tooltip" 
                           title="Edit Product">
                           <i class="fas fa-pen fa-xs"></i>
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>

                  </tbody>
                </table>
              </div>
              <div class="card-footer bg-white small text-muted text-right italic">
                Showing inventory data directly from the product warehouse.
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