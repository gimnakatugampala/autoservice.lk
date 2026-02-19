<?php include_once '../includes/header.php';?>
<?php include_once '../api/cancel-jobcard-list.php';?>

<style>
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

    /* ── Invoice Modal Styles ── */
    #invoiceModal .modal-dialog { max-width: 860px; }

    #invoiceModal .modal-content {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.18);
    }

    .inv-header {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 60%, #0f3460 100%);
        color: #fff;
        padding: 28px 32px 22px;
    }

    .inv-header .station-logo {
        width: 70px;
        height: 70px;
        object-fit: contain;
        border-radius: 8px;
        background: #fff;
        padding: 6px;
    }

    .inv-header .station-logo-placeholder {
        width: 70px; height: 70px;
        border-radius: 8px;
        background: rgba(255,255,255,0.15);
        display: flex; align-items: center; justify-content: center;
        font-size: 28px; color: rgba(255,255,255,0.6);
    }

    .inv-header h4 { font-size: 1.4rem; font-weight: 700; margin: 0; }
    .inv-header .inv-meta { font-size: 0.78rem; opacity: 0.75; }
    .inv-header .inv-code {
        font-size: 1rem; font-weight: 700;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 6px; padding: 4px 12px;
        letter-spacing: 1px;
    }

    .inv-badge-canceled {
        display: inline-block;
        background: #dc3545;
        color: #fff;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 3px 10px;
        border-radius: 20px;
    }

    .inv-section-title {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: #6c757d;
        margin-bottom: 8px;
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 4px;
    }

    .inv-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        padding: 20px 32px;
        background: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }

    .inv-info-block .label {
        font-size: 0.72rem;
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    .inv-info-block .value {
        font-size: 0.9rem;
        color: #212529;
        font-weight: 500;
        margin-top: 1px;
    }

    .inv-items-wrap { padding: 20px 32px; }

    #inv-items-table thead th {
        background: #1a1a2e;
        color: #fff;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        border: none;
        padding: 10px 12px;
    }

    #inv-items-table tbody td {
        font-size: 0.84rem;
        vertical-align: middle;
        padding: 9px 12px;
        border-color: #f0f0f0;
    }

    #inv-items-table tbody tr:hover { background: #f8f9ff; }

    .inv-totals {
        padding: 0 32px 24px;
    }

    .inv-totals-box {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 16px 20px;
        max-width: 320px;
        margin-left: auto;
    }

    .inv-totals-box .row-line {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
        margin-bottom: 6px;
        color: #495057;
    }

    .inv-totals-box .row-line.grand {
        font-size: 1.05rem;
        font-weight: 800;
        color: #1a1a2e;
        border-top: 2px solid #1a1a2e;
        padding-top: 8px;
        margin-top: 4px;
    }

    .inv-footer-bar {
        background: #1a1a2e;
        color: rgba(255,255,255,0.55);
        font-size: 0.72rem;
        text-align: center;
        padding: 10px;
        letter-spacing: 0.5px;
    }

    /* Spinner overlay inside modal */
    #inv-loading {
        position: absolute;
        inset: 0;
        background: rgba(255,255,255,0.88);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        border-radius: 12px;
    }

    .btn-view-invoice {
        border: none;
        background: linear-gradient(135deg, #0f3460, #16213e);
        color: #fff;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 6px;
        cursor: pointer;
        transition: opacity 0.2s;
        white-space: nowrap;
    }
    .btn-view-invoice:hover { opacity: 0.85; color: #fff; }
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
      </div>
    </section>

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
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($jobcards as $row) : ?>
                    <tr>
                      <td class="font-weight-bold text-muted"><?php echo $row["job_card_code"]; ?></td>
                      <td class="text-uppercase"><?php echo $row["first_name"]; ?> <?php echo $row["last_name"]; ?></td>
                      <td><i class="fas fa-phone-alt mr-1 text-muted small"></i> <?php echo $row["phone"]; ?></td>
                      <td><span class="badge badge-light border px-2 py-1"><?php echo $row["vehicle_number"]; ?></span></td>
                      <td>
                          <span class="badge badge-secondary shadow-none">
                            <?php echo $row["JOB_CARD_TYPE"]; ?>
                          </span>
                      </td>
                      <td class="text-muted small"><i class="far fa-calendar-alt mr-1"></i> <?php echo $row["JOB_CARD_PLACED_DATE"]; ?></td>
                      <td class="text-danger font-weight-bold"><i class="fas fa-times-circle mr-1"></i> <?php echo $row["CANCELED_DATE"]; ?></td>
                      <td>
                        <button class="btn-view-invoice" onclick="viewJobCardDetails('<?php echo htmlspecialchars($row['job_card_code'], ENT_QUOTES); ?>')">
                          <i class="fas fa-eye mr-1"></i> View Details
                        </button>
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
  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<!-- ════════════════════════════════════════
     INVOICE DETAILS MODAL
═══════════════════════════════════════════ -->
<div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content" style="position:relative;">

      <!-- Loading overlay -->
      <div id="inv-loading">
        <div class="text-center">
          <div class="spinner-border text-primary" style="width:3rem;height:3rem;" role="status"></div>
          <div class="mt-2 text-muted font-weight-bold" style="font-size:0.85rem;">Loading details…</div>
        </div>
      </div>

      <!-- Modal Header Bar -->
      <div class="inv-header">
        <div class="d-flex align-items-center justify-content-between">
          <div class="d-flex align-items-center">
            <div id="inv-logo-wrap" class="mr-3"></div>
            <div>
              <h4 id="inv-station-name">—</h4>
              <div class="inv-meta" id="inv-station-address">—</div>
              <div class="inv-meta" id="inv-station-contact">—</div>
            </div>
          </div>
          <div class="text-right">
            <div class="inv-badge-canceled mb-2">Canceled</div>
            <div class="inv-code" id="inv-code">—</div>
            <div class="inv-meta mt-1" id="inv-invoice-code">—</div>
          </div>
        </div>
      </div>

      <!-- Info Grid -->
      <div class="inv-info-grid">
        <!-- Customer -->
        <div>
          <div class="inv-section-title"><i class="fas fa-user mr-1"></i> Customer</div>
          <div class="inv-info-block mb-2">
            <div class="label">Name</div>
            <div class="value" id="inv-cust-name">—</div>
          </div>
          <div class="inv-info-block mb-2">
            <div class="label">Phone</div>
            <div class="value" id="inv-cust-phone">—</div>
          </div>
          <div class="inv-info-block">
            <div class="label">Address</div>
            <div class="value" id="inv-cust-address">—</div>
          </div>
        </div>
        <!-- Vehicle -->
        <div>
          <div class="inv-section-title"><i class="fas fa-car mr-1"></i> Vehicle</div>
          <div class="inv-info-block mb-2">
            <div class="label">Vehicle No.</div>
            <div class="value" id="inv-veh-number">—</div>
          </div>
          <div class="inv-info-block mb-2">
            <div class="label">Make / Model</div>
            <div class="value" id="inv-veh-makemodel">—</div>
          </div>
          <div class="inv-info-block mb-2">
            <div class="label">Engine No. / Chassis No.</div>
            <div class="value" id="inv-veh-ids">—</div>
          </div>
          <div class="d-flex" style="gap:24px;">
            <div class="inv-info-block">
              <div class="label">Mileage</div>
              <div class="value" id="inv-veh-mileage">—</div>
            </div>
            <div class="inv-info-block">
              <div class="label">Next Service</div>
              <div class="value" id="inv-veh-next">—</div>
            </div>
            <div class="inv-info-block">
              <div class="label">Job Type</div>
              <div class="value" id="inv-job-type">—</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Items Table -->
      <div class="inv-items-wrap">
        <div class="inv-section-title"><i class="fas fa-list mr-1"></i> Services & Items</div>
        <div class="table-responsive">
          <table class="table table-bordered" id="inv-items-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Code</th>
                <th>Description</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Unit Price</th>
                <th class="text-right">Discount</th>
                <th class="text-right">Total</th>
              </tr>
            </thead>
            <tbody id="inv-items-body">
              <!-- populated by JS -->
            </tbody>
          </table>
        </div>
      </div>

      <!-- Totals -->
      <div class="inv-totals">
        <div class="inv-totals-box">
          <div class="row-line">
            <span>Subtotal</span>
            <span id="inv-subtotal">0.00</span>
          </div>
          <div class="row-line">
            <span id="inv-vat-label">VAT (0%)</span>
            <span id="inv-vat-amount">0.00</span>
          </div>
          <div class="row-line grand">
            <span>Grand Total</span>
            <span id="inv-grand-total">0.00</span>
          </div>
        </div>
      </div>

      <!-- Footer Bar -->
      <div class="inv-footer-bar">
        Generated by the Service Management System &nbsp;|&nbsp; This is a CANCELED job card record
      </div>

      <!-- Close Button -->
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"
        style="position:absolute;top:14px;right:18px;color:#fff;opacity:0.85;font-size:1.4rem;z-index:20;">
        <span aria-hidden="true">&times;</span>
      </button>

    </div><!-- /.modal-content -->
  </div>
</div>
<!-- ════════════════════════════════════════ -->

<?php include_once '../includes/footer.php';?>

<script>
  $(function () {
    if (!$.fn.DataTable.isDataTable('#example1')) {
        $("#example1").DataTable({
          "responsive": true, 
          "lengthChange": true, 
          "autoWidth": false,
          "order": [[6, "desc"]]
        });
    }
  });

  // ── Currency formatter ──
  function fmt(n) {
    return parseFloat(n || 0).toLocaleString('en-US', {minimumFractionDigits:2, maximumFractionDigits:2});
  }

  // ── XSS-safe string escape ──
  function escHtml(s) {
    return String(s || '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
  }

  // ── Open modal & fetch details ──
  function viewJobCardDetails(job_card_code) {
    // Reset & show modal with loader
    $('#inv-items-body').html('');
    resetInvoiceFields();
    $('#inv-loading').show();
    $('#invoiceModal').modal('show');

    $.ajax({
      url: '../api/get-invoice-details.php',
      type: 'POST',
      data: { job_card_code: job_card_code },   // pass code — always unique & reliable
      dataType: 'json',
      success: function(res) {
        $('#inv-loading').hide();
        if (!res.success) {
          Swal.fire ? Swal.fire('Error', res.message, 'error') : alert('Error: ' + res.message);
          $('#invoiceModal').modal('hide');
          return;
        }
        populateModal(res.data, res.items, res.totals);
      },
      error: function(xhr, status, err) {
        $('#inv-loading').hide();
        alert('Request failed: ' + err);
        $('#invoiceModal').modal('hide');
      }
    });
  }

  function resetInvoiceFields() {
    ['inv-station-name','inv-station-address','inv-station-contact',
     'inv-code','inv-invoice-code','inv-cust-name','inv-cust-phone',
     'inv-cust-address','inv-veh-number','inv-veh-makemodel','inv-veh-ids',
     'inv-veh-mileage','inv-veh-next','inv-job-type',
     'inv-subtotal','inv-vat-amount','inv-grand-total'].forEach(function(id){
      $('#'+id).text('—');
    });
    $('#inv-logo-wrap').html('<div class="inv-logo-placeholder"><i class="fas fa-tools"></i></div>');
  }

  function populateModal(d, items, totals) {
    // Station
    $('#inv-station-name').text(d.service_name || '—');
    $('#inv-station-address').text([d.st_address, d.st_city].filter(Boolean).join(', ') || '—');
    $('#inv-station-contact').text([d.st_phone, d.st_email].filter(Boolean).join('  |  ') || '—');

    // Logo
    if (d.logo) {
      $('#inv-logo-wrap').html('<img src="../uploads/logos/' + d.logo + '" class="station-logo" onerror="this.style.display=\'none\'">');
    } else {
      $('#inv-logo-wrap').html('<div class="inv-header station-logo-placeholder"><i class="fas fa-tools"></i></div>');
    }

    // Codes
    $('#inv-code').text(d.job_card_code || '—');
    $('#inv-invoice-code').text(d.invoice_code ? 'Invoice: ' + d.invoice_code : 'No Invoice');

    // Customer
    $('#inv-cust-name').text(((d.first_name || '') + ' ' + (d.last_name || '')).trim() || '—');
    $('#inv-cust-phone').text(d.vo_phone || '—');
    $('#inv-cust-address').text(d.vo_address || '—');

    // Vehicle
    $('#inv-veh-number').text(d.vehicle_number || '—');
    $('#inv-veh-makemodel').text([d.make_name, d.model_name].filter(Boolean).join(' / ') || '—');
    $('#inv-veh-ids').text(
      [d.engine_number ? 'Eng: ' + d.engine_number : null, d.chassis_number ? 'Ch: ' + d.chassis_number : null]
        .filter(Boolean).join('  |  ') || '—'
    );
    $('#inv-veh-mileage').text(d.current_mileage ? d.current_mileage + ' km' : '—');
    $('#inv-veh-next').text(d.next_mileage ? d.next_mileage + ' km' : '—');
    $('#inv-job-type').text(d.job_type || '—');

    // ── Build items table ───────────────────────────────────────────────
    // item_type values from API:
    //   Normal rows : 'Washer' | 'Repair' | 'Product'
    //   Package rows: 'Service Package'  (is_package=true)
    //   Sub-item rows: 'Package Item' | 'Free Item' | 'Fuel' | 'Filter'  (is_sub_item=true)

    var badgeCfg = {
      'Washer':          { cls: 'badge-info',    icon: 'fas fa-spray-can'   },
      'Repair':          { cls: 'badge-warning',  icon: 'fas fa-wrench'      },
      'Product':         { cls: 'badge-success',  icon: 'fas fa-box'         },
      'Service Package': { cls: 'badge-primary',  icon: 'fas fa-layer-group' },
      'Package Item':    { cls: 'badge-secondary',icon: 'fas fa-check'       },
      'Free Item':       { cls: 'badge-success',  icon: 'fas fa-gift'        },
      'Fuel':            { cls: 'badge-dark',     icon: 'fas fa-oil-can'     },
      'Filter':          { cls: 'badge-secondary',icon: 'fas fa-filter'      },
    };

    var tbody  = '';
    var rowNum = 0;

    if (items && items.length > 0) {
      items.forEach(function(item) {
        var isPackage = item.is_package  === true;
        var isSubItem = item.is_sub_item === true;
        var isFree    = item.is_free     === true;
        var lineTotal = parseFloat(((item.qty * item.price) - item.discount).toFixed(2));
        var cfg       = badgeCfg[item.item_type] || { cls: 'badge-secondary', icon: 'fas fa-tag' };

        /* ── Service Package header ── */
        if (isPackage) {
          tbody +=
            '<tr style="background:#16213e;color:#fff;">' +
              '<td colspan="7" class="py-2 font-weight-bold" style="font-size:0.82rem;letter-spacing:.8px;">' +
                '<i class="fas fa-layer-group mr-2" style="opacity:.7;"></i>' +
                'SERVICE PACKAGE &nbsp;—&nbsp; ' +
                '<span style="font-size:1rem;">' + escHtml(item.name) + '</span>' +
                '<span class="float-right" style="font-size:0.72rem;opacity:.6;font-weight:400;font-family:monospace;">' + escHtml(item.code) + '</span>' +
              '</td>' +
            '</tr>';

        /* ── Sub-items (Package Item, Free Item, Fuel, Filter) ── */
        } else if (isSubItem) {
          rowNum++;
          var rowBg    = isFree ? '#f6fff8' : '#f8f9fa';
          var nameTd   = isFree
            ? '<i class="fas fa-gift mr-1 text-success"></i><em>' + escHtml(item.name) + '</em> <span class="badge badge-success" style="font-size:0.65rem;">FREE</span>'
            : '<i class="' + cfg.icon + ' mr-1 text-muted" style="font-size:0.75rem;"></i>' + escHtml(item.name);
          var priceTd  = item.price > 0 ? fmt(item.price) : (isFree ? '<span class="text-success">0.00</span>' : '—');
          var totalTd  = lineTotal > 0   ? '<strong>' + fmt(lineTotal) + '</strong>'
                                         : (isFree ? '<span class="text-success">0.00</span>' : '—');
          tbody +=
            '<tr style="background:' + rowBg + ';">' +
              '<td class="text-muted pl-4" style="font-size:0.75rem;">' + rowNum + '</td>' +
              '<td><span class="badge ' + cfg.cls + '" style="font-size:0.65rem;">' + escHtml(item.item_type) + '</span></td>' +
              '<td style="padding-left:32px;">' + nameTd + '</td>' +
              '<td class="text-center">' + (item.price > 0 ? fmt(item.qty) : '—') + '</td>' +
              '<td class="text-right">' + priceTd + '</td>' +
              '<td class="text-right text-danger">' + (item.discount > 0 ? '- ' + fmt(item.discount) : '—') + '</td>' +
              '<td class="text-right">' + totalTd + '</td>' +
            '</tr>';

        /* ── Normal rows: Washer / Repair / Product ── */
        } else {
          rowNum++;
          tbody +=
            '<tr>' +
              '<td class="text-muted">' + rowNum + '</td>' +
              '<td><span class="badge ' + cfg.cls + '" style="font-size:0.65rem;">' +
                '<i class="' + cfg.icon + ' mr-1"></i>' + escHtml(item.item_type) +
              '</span></td>' +
              '<td class="font-weight-bold">' + escHtml(item.name) + '</td>' +
              '<td class="text-center">' + fmt(item.qty) + '</td>' +
              '<td class="text-right">' + fmt(item.price) + '</td>' +
              '<td class="text-right text-danger">' + (item.discount > 0 ? '- ' + fmt(item.discount) : '—') + '</td>' +
              '<td class="text-right font-weight-bold text-dark">' + fmt(lineTotal) + '</td>' +
            '</tr>';
        }
      });
    } else {
      tbody = '<tr><td colspan="7" class="text-center text-muted py-4">' +
                '<i class="fas fa-inbox mr-2"></i>No items found for this job card.' +
              '</td></tr>';
    }
    $('#inv-items-body').html(tbody);

    // Totals
    $('#inv-subtotal').text(fmt(totals.subtotal));
    $('#inv-vat-label').text('VAT (' + fmt(totals.vat_percent) + '%)');
    $('#inv-vat-amount').text(fmt(totals.vat_amount));
    $('#inv-grand-total').text(fmt(totals.grand_total));
  }
</script>

</body>
</html>