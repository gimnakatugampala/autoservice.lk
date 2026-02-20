<?php include_once '../includes/header.php'; ?>

<style>
  /* ── LIGHT THEME OVERRIDES ── */
  :root {
    --bg: #f4f6f9;
    --surface: #ffffff;
    --surface2: #f8f9fc;
    --surface3: #eef0f5;
    --border: rgba(0,0,0,0.07);
    --border-bright: rgba(0,0,0,0.13);
    --accent: #e8941a;
    --accent2: #c94a10;
    --accent3: #0baa7c;
    --accent4: #3a6cf4;
    --text: #1a1d26;
    --text-muted: #8a92a6;
    --text-dim: #5a6278;
    --danger: #dc3545;
    --success: #198754;
    --warning: #f59e0b;
    --info: #3b82f6;
  }

  .content-wrapper { background: var(--bg) !important; }

  /* ── STAT CARDS ── */
  .stats-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 22px;
  }

  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  .stat-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 20px;
    position: relative;
    overflow: hidden;
    transition: box-shadow 0.25s, transform 0.2s;
    animation: fadeUp 0.4s ease both;
    box-shadow: 0 1px 4px rgba(0,0,0,0.06);
  }
  .stat-card:nth-child(1) { animation-delay: 0.05s; }
  .stat-card:nth-child(2) { animation-delay: 0.10s; }
  .stat-card:nth-child(3) { animation-delay: 0.15s; }
  .stat-card:nth-child(4) { animation-delay: 0.20s; }
  .stat-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.10); transform: translateY(-2px); }

  .stat-card::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    border-radius: 12px 12px 0 0;
  }
  .stat-card.orange::after { background: linear-gradient(90deg, #e8941a, #c94a10); }
  .stat-card.green::after  { background: linear-gradient(90deg, #0baa7c, #0d9063); }
  .stat-card.blue::after   { background: linear-gradient(90deg, #3a6cf4, #6d28d9); }
  .stat-card.red::after    { background: linear-gradient(90deg, #dc3545, #f97316); }

  .stat-glow {
    position: absolute;
    top: -10px; right: -10px;
    width: 90px; height: 90px;
    border-radius: 50%;
    opacity: 0.06;
    filter: blur(24px);
  }
  .stat-card.orange .stat-glow { background: #e8941a; }
  .stat-card.green  .stat-glow { background: #0baa7c; }
  .stat-card.blue   .stat-glow { background: #3a6cf4; }
  .stat-card.red    .stat-glow { background: #dc3545; }

  .stat-icon-wrap {
    width: 40px; height: 40px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px;
    margin-bottom: 14px;
  }
  .stat-card.orange .stat-icon-wrap { background: rgba(232,148,26,0.10); color: var(--accent); }
  .stat-card.green  .stat-icon-wrap { background: rgba(11,170,124,0.10); color: var(--accent3); }
  .stat-card.blue   .stat-icon-wrap { background: rgba(58,108,244,0.10); color: var(--accent4); }
  .stat-card.red    .stat-icon-wrap { background: rgba(220,53,69,0.10);  color: var(--danger); }

  .stat-label {
    font-size: 10.5px;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    color: var(--text-muted);
    font-weight: 600;
    margin-bottom: 5px;
  }
  .stat-value {
    font-family: 'Rajdhani', 'Segoe UI', sans-serif;
    font-size: 38px;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 10px;
    letter-spacing: -0.5px;
  }
  .stat-card.orange .stat-value { color: var(--accent); }
  .stat-card.green  .stat-value { color: var(--accent3); }
  .stat-card.blue   .stat-value { color: var(--accent4); }
  .stat-card.red    .stat-value { color: var(--danger); }

  .stat-trend { font-size: 11px; display: flex; align-items: center; gap: 4px; color: var(--text-muted); }
  .trend-up   { color: var(--success); }
  .trend-down { color: var(--danger); }

  /* ── GRID LAYOUTS ── */
  .db-grid-2col { display: grid; grid-template-columns: 1fr 320px; gap: 16px; margin-bottom: 16px; }
  .db-grid-3col { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 16px; }
  .db-footer-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 16px; }

  /* ── PANEL ── */
  .db-panel {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 1px 4px rgba(0,0,0,0.05);
    animation: fadeUp 0.45s ease both;
  }
  .db-panel-header {
    padding: 14px 18px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between;
    background: var(--surface);
  }
  .db-panel-title {
    font-size: 12px; font-weight: 700; letter-spacing: 1.2px;
    text-transform: uppercase; color: var(--text-dim);
    display: flex; align-items: center; gap: 8px;
  }
  .db-panel-title i { font-size: 11px; }
  .db-panel-action {
    font-size: 11px; color: var(--accent4); cursor: pointer;
    text-decoration: none; font-weight: 600; transition: opacity 0.2s;
  }
  .db-panel-action:hover { opacity: 0.65; color: var(--accent4); text-decoration: none; }

  /* ── SKELETON LOADER ── */
  .skeleton {
    background: linear-gradient(90deg, var(--surface3) 25%, var(--surface2) 50%, var(--surface3) 75%);
    background-size: 200% 100%;
    animation: shimmer 1.5s infinite;
    border-radius: 4px;
  }
  @keyframes shimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }
  .skeleton-row { height: 44px; margin: 8px 16px; border-radius: 6px; }
  .skeleton-bar { border-radius: 5px; }

  /* ── JOB CARD TABLE ── */
  .jc-table { width: 100%; border-collapse: collapse; }
  .jc-table thead th {
    padding: 9px 16px; font-size: 10px; letter-spacing: 1.3px;
    text-transform: uppercase; color: var(--text-muted); font-weight: 600;
    background: var(--surface2); border-bottom: 1px solid var(--border); white-space: nowrap;
  }
  .jc-table tbody tr { border-bottom: 1px solid var(--border); transition: background 0.12s; cursor: pointer; }
  .jc-table tbody tr:hover { background: var(--surface2); }
  .jc-table tbody tr:last-child { border-bottom: none; }
  .jc-table tbody td { padding: 11px 16px; font-size: 12.5px; vertical-align: middle; color: var(--text); }

  .jc-code { font-weight: 700; color: var(--accent4); font-size: 12.5px; letter-spacing: 0.3px; }
  .owner-name { font-weight: 500; color: var(--text); }
  .owner-phone { font-size: 11px; color: var(--text-muted); margin-top: 1px; }
  .plate {
    display: inline-block; background: var(--surface3); border: 1px solid var(--border-bright);
    border-radius: 4px; padding: 2px 8px; font-size: 11.5px; font-weight: 700;
    letter-spacing: 1px; color: var(--text);
  }
  .db-badge {
    display: inline-block; padding: 3px 9px; border-radius: 20px;
    font-size: 10px; font-weight: 700; letter-spacing: 0.8px; text-transform: uppercase;
  }
  .db-badge-service  { background: rgba(11,170,124,0.10); color: #0baa7c; }
  .db-badge-repair   { background: rgba(58,108,244,0.10); color: #3a6cf4; }
  .db-badge-wash     { background: rgba(232,148,26,0.12); color: #c47a10; }
  .db-badge-all      { background: rgba(109,40,217,0.10); color: #7c3aed; }
  .db-badge-pending  { background: rgba(245,158,11,0.10); color: #b45309; }
  .db-badge-done     { background: rgba(25,135,84,0.10);  color: #198754; }
  .db-badge-canceled { background: rgba(220,53,69,0.10);  color: #dc3545; }

  .date-text { font-size: 11.5px; color: var(--text-muted); }
  .status-row { display: flex; align-items: center; gap: 6px; }
  .status-indicator { width: 6px; height: 6px; border-radius: 50%; }

  .empty-state {
    text-align: center; padding: 32px 16px;
    color: var(--text-muted); font-size: 12px;
  }
  .empty-state i { font-size: 28px; margin-bottom: 8px; display: block; opacity: 0.4; }

  /* ── ACTIVITY FEED ── */
  .db-activity-list { padding: 4px 0; }
  .db-activity-item {
    display: flex; align-items: flex-start; gap: 11px;
    padding: 11px 18px; border-bottom: 1px solid var(--border); transition: background 0.12s;
  }
  .db-activity-item:hover { background: var(--surface2); }
  .db-activity-item:last-child { border-bottom: none; }
  .db-activity-dot { width: 7px; height: 7px; border-radius: 50%; margin-top: 5px; flex-shrink: 0; }
  .db-activity-content { flex: 1; min-width: 0; }
  .db-activity-title { font-size: 12px; font-weight: 500; color: var(--text); line-height: 1.4; }
  .db-activity-sub   { font-size: 11px; color: var(--text-muted); margin-top: 2px; }
  .db-activity-time  { font-size: 10px; color: var(--text-muted); white-space: nowrap; }

  /* ── BAR CHART ── */
  .chart-wrap { padding: 18px 18px 0; }
  .db-bar-chart { display: flex; align-items: flex-end; gap: 8px; height: 110px; }
  .db-bar-col { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 5px; height: 100%; justify-content: flex-end; }
  .db-bar {
    width: 100%; border-radius: 5px 5px 0 0; position: relative;
    min-height: 4px; cursor: pointer; transition: filter 0.15s, opacity 0.15s;
  }
  .db-bar:hover { filter: brightness(1.12); }
  .db-bar-label { font-size: 9.5px; color: var(--text-muted); letter-spacing: 0.3px; }
  .db-bar-tooltip {
    position: absolute; top: -26px; left: 50%; transform: translateX(-50%);
    background: var(--text); color: #fff; border-radius: 5px; padding: 3px 7px;
    font-size: 10px; white-space: nowrap; opacity: 0; pointer-events: none;
    transition: opacity 0.12s; font-weight: 600;
  }
  .db-bar:hover .db-bar-tooltip { opacity: 1; }

  /* ── QUICK STATS ── */
  .db-quick-stats { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; padding: 14px 16px; }
  .db-q-stat {
    background: var(--surface2); border: 1px solid var(--border);
    border-radius: 9px; padding: 13px 10px; text-align: center; transition: box-shadow 0.2s;
  }
  .db-q-stat:hover { box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
  .db-q-stat-val { font-size: 26px; font-weight: 700; line-height: 1; margin-bottom: 4px; }
  .db-q-stat-label { font-size: 9.5px; letter-spacing: 1px; text-transform: uppercase; color: var(--text-muted); font-weight: 600; }

  /* ── DONUT ── */
  .db-donut-wrap { padding: 18px 18px 14px; display: flex; flex-direction: column; align-items: center; gap: 14px; }
  .db-donut-container { position: relative; width: 120px; height: 120px; display: flex; align-items: center; justify-content: center; }
  .db-donut-svg { transform: rotate(-90deg); }
  .db-donut-center { position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
  .db-donut-legend { width: 100%; display: flex; flex-direction: column; gap: 7px; }
  .db-legend-item { display: flex; align-items: center; justify-content: space-between; font-size: 12px; color: var(--text-dim); }
  .db-legend-dot-label { display: flex; align-items: center; gap: 8px; }
  .db-legend-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
  .db-legend-pct { font-weight: 700; font-size: 13px; }

  /* ── PROGRESS LIST ── */
  .db-progress-list { padding: 14px 18px; display: flex; flex-direction: column; gap: 13px; }
  .db-prog-item { display: flex; flex-direction: column; gap: 5px; }
  .db-prog-top { display: flex; justify-content: space-between; align-items: center; }
  .db-prog-name { font-size: 12px; color: var(--text-dim); }
  .db-prog-val { font-size: 12px; font-weight: 700; }
  .db-prog-bar-bg { height: 5px; border-radius: 5px; background: var(--surface3); overflow: hidden; }
  .db-prog-bar-fill { height: 100%; border-radius: 5px; transition: width 1s cubic-bezier(0.4,0,0.2,1); }

  /* ── LIVE BADGE ── */
  .db-live-badge {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: 11px; font-weight: 600; color: var(--accent3);
    letter-spacing: 0.8px; text-transform: uppercase; margin-left: 10px;
  }
  .db-live-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--accent3); animation: dbPulse 2s infinite; }
  @keyframes dbPulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0.4;transform:scale(1.4)} }

  /* ── ALERT PANEL ── */
  .db-alert-scroll { max-height: 220px; overflow-y: auto; }
  .db-alert-scroll::-webkit-scrollbar { width: 3px; }
  .db-alert-scroll::-webkit-scrollbar-thumb { background: var(--surface3); border-radius: 3px; }

  .db-chart-footer {
    display: flex; justify-content: space-between;
    padding: 8px 18px 16px; font-size: 11px; color: var(--text-muted);
    border-top: 1px solid var(--border); margin-top: 10px;
  }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include_once '../includes/loader.php'; ?>
  <?php include_once '../includes/navbar.php'; ?>
  <?php include_once '../includes/sidebar.php'; ?>

  <div class="content-wrapper">

    <!-- PAGE HEADER -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 align-items-center">
          <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold text-dark">
              Dashboard
              <span class="db-live-badge"><span class="db-live-dot"></span> Live</span>
            </h1>
          </div>
          <div class="col-sm-6 text-right">
            <span style="font-size:12px; color:#6b7280;">
              <i class="far fa-calendar-alt mr-1"></i>
              <span id="db-current-date"></span>
            </span>
            &nbsp;
            <button onclick="loadDashboard()" class="btn btn-sm btn-outline-secondary" style="font-size:11px; padding:2px 10px;">
              <i class="fas fa-sync-alt"></i> Refresh
            </button>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">

        <!-- ── STAT CARDS ── -->
        <div class="stats-row">
          <div class="stat-card orange">
            <div class="stat-glow"></div>
            <div class="stat-icon-wrap"><i class="fas fa-clock"></i></div>
            <div class="stat-label">Pending Jobs</div>
            <div class="stat-value" id="cnt-pending">–</div>
            <div class="stat-trend"><i class="fas fa-circle-notch fa-spin" id="spin-pending" style="font-size:9px;"></i><span id="trend-pending">Loading...</span></div>
          </div>
          <div class="stat-card green">
            <div class="stat-glow"></div>
            <div class="stat-icon-wrap"><i class="fas fa-check-double"></i></div>
            <div class="stat-label">Completed Today</div>
            <div class="stat-value" id="cnt-completed">–</div>
            <div class="stat-trend"><i class="fas fa-circle-notch fa-spin" id="spin-completed" style="font-size:9px;"></i><span id="trend-completed">Loading...</span></div>
          </div>
          <div class="stat-card blue">
            <div class="stat-glow"></div>
            <div class="stat-icon-wrap"><i class="fas fa-car"></i></div>
            <div class="stat-label">Vehicles Registered</div>
            <div class="stat-value" id="cnt-vehicles">–</div>
            <div class="stat-trend"><i class="fas fa-circle-notch fa-spin" id="spin-vehicles" style="font-size:9px;"></i><span id="trend-vehicles">Loading...</span></div>
          </div>
          <div class="stat-card red">
            <div class="stat-glow"></div>
            <div class="stat-icon-wrap"><i class="fas fa-ban"></i></div>
            <div class="stat-label">Canceled Jobs</div>
            <div class="stat-value" id="cnt-canceled">–</div>
            <div class="stat-trend"><i class="fas fa-circle-notch fa-spin" id="spin-canceled" style="font-size:9px;"></i><span id="trend-canceled">Loading...</span></div>
          </div>
        </div>

        <!-- ── ROW 2: Job Cards + Activity ── -->
        <div class="db-grid-2col">

          <div class="db-panel">
            <div class="db-panel-header">
              <span class="db-panel-title"><i class="fas fa-clock text-warning"></i> Pending Job Cards</span>
              <a href="../job-cards/" class="db-panel-action">View All →</a>
            </div>
            <div style="overflow-x:auto;">
              <table class="jc-table">
                <thead>
                  <tr>
                    <th>Code</th><th>Owner</th><th>Vehicle</th><th>Type</th><th>Date</th><th>Status</th>
                  </tr>
                </thead>
                <tbody id="jc-table-body">
                  <tr><td colspan="6"><div class="skeleton skeleton-row"></div></td></tr>
                  <tr><td colspan="6"><div class="skeleton skeleton-row"></div></td></tr>
                  <tr><td colspan="6"><div class="skeleton skeleton-row"></div></td></tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="db-panel">
            <div class="db-panel-header">
              <span class="db-panel-title"><i class="fas fa-bolt text-warning"></i> Recent Activity</span>
            </div>
            <div class="db-activity-list" id="db-activity-feed">
              <div class="skeleton skeleton-row" style="margin:12px 16px;"></div>
              <div class="skeleton skeleton-row" style="margin:12px 16px;"></div>
              <div class="skeleton skeleton-row" style="margin:12px 16px;"></div>
            </div>
          </div>

        </div>

        <!-- ── ROW 3: Revenue + Donut + Quick Metrics ── -->
        <div class="db-grid-3col">

          <div class="db-panel">
            <div class="db-panel-header">
              <span class="db-panel-title"><i class="fas fa-chart-bar text-primary"></i> Monthly Revenue</span>
              <span class="db-panel-action">LKR</span>
            </div>
            <div class="chart-wrap">
              <div class="db-bar-chart" id="db-bar-chart">
                <?php for($i=0;$i<8;$i++): ?>
                  <div class="db-bar-col">
                    <div class="db-bar skeleton skeleton-bar" style="height:<?= rand(30,90) ?>%;"></div>
                    <div class="db-bar-label skeleton" style="width:24px;height:10px;"></div>
                  </div>
                <?php endfor; ?>
              </div>
            </div>
            <div class="db-chart-footer">
              <span>YTD: <strong style="color:var(--accent); font-size:14px;" id="ytd-rev">–</strong></span>
              <span>Monthly Avg: <strong style="color:var(--text-dim);" id="avg-rev">–</strong></span>
            </div>
          </div>

          <div class="db-panel">
            <div class="db-panel-header">
              <span class="db-panel-title"><i class="fas fa-chart-pie text-info"></i> Job Type Split</span>
              <span class="db-panel-action">This Month</span>
            </div>
            <div class="db-donut-wrap">
              <div class="db-donut-container">
                <svg class="db-donut-svg" width="120" height="120" viewBox="0 0 120 120" id="db-donut-svg">
                  <circle cx="60" cy="60" r="46" fill="none" stroke="var(--surface3)" stroke-width="14"/>
                </svg>
                <div class="db-donut-center">
                  <div id="donut-total" style="font-size:22px; font-weight:700; color:var(--text); line-height:1;">–</div>
                  <div style="font-size:9.5px; color:var(--text-muted); letter-spacing:0.5px; margin-top:2px;">TOTAL</div>
                </div>
              </div>
              <div class="db-donut-legend" id="db-donut-legend">
                <div class="skeleton" style="height:14px; border-radius:4px;"></div>
                <div class="skeleton" style="height:14px; border-radius:4px;"></div>
              </div>
            </div>
          </div>

          <div class="db-panel">
            <div class="db-panel-header">
              <span class="db-panel-title"><i class="fas fa-tachometer-alt"></i> Quick Metrics</span>
            </div>
            <div class="db-quick-stats" id="db-quick-stats">
              <?php for($i=0;$i<6;$i++): ?>
                <div class="db-q-stat">
                  <div class="db-q-stat-val skeleton" style="width:40px;height:28px;margin:0 auto 4px;border-radius:4px;">&nbsp;</div>
                  <div class="db-q-stat-label skeleton" style="width:60px;height:10px;margin:0 auto;border-radius:3px;">&nbsp;</div>
                </div>
              <?php endfor; ?>
            </div>
          </div>

        </div>

        <!-- ── ROW 4: Service Breakdown + PO Status + Inventory Alerts ── -->
        <div class="db-footer-row">

          <div class="db-panel">
            <div class="db-panel-header">
              <span class="db-panel-title"><i class="fas fa-layer-group text-success"></i> Service Breakdown</span>
            </div>
            <div class="db-progress-list" id="db-service-breakdown">
              <?php for($i=0;$i<4;$i++): ?>
                <div class="db-prog-item">
                  <div class="db-prog-top">
                    <div class="skeleton" style="width:80px;height:12px;border-radius:3px;"></div>
                    <div class="skeleton" style="width:50px;height:12px;border-radius:3px;"></div>
                  </div>
                  <div class="db-prog-bar-bg"><div class="db-prog-bar-fill skeleton" style="width:<?= rand(20,90) ?>%;"></div></div>
                </div>
              <?php endfor; ?>
            </div>
          </div>

          <div class="db-panel">
            <div class="db-panel-header">
              <span class="db-panel-title"><i class="fas fa-shopping-cart text-primary"></i> Purchase Orders</span>
              <a href="../purchase-order/" class="db-panel-action">View All →</a>
            </div>
            <div class="db-progress-list" id="db-po-status">
              <?php for($i=0;$i<3;$i++): ?>
                <div class="db-prog-item">
                  <div class="db-prog-top">
                    <div class="skeleton" style="width:80px;height:12px;border-radius:3px;"></div>
                    <div class="skeleton" style="width:30px;height:12px;border-radius:3px;"></div>
                  </div>
                  <div class="db-prog-bar-bg"><div class="db-prog-bar-fill skeleton" style="width:<?= rand(20,90) ?>%;"></div></div>
                </div>
              <?php endfor; ?>
            </div>
          </div>

          <div class="db-panel">
            <div class="db-panel-header">
              <span class="db-panel-title"><i class="fas fa-exclamation-triangle text-warning"></i> Inventory Alerts</span>
            </div>
            <div class="db-activity-list db-alert-scroll" id="db-inventory-alerts">
              <div class="skeleton skeleton-row" style="margin:10px 14px;"></div>
              <div class="skeleton skeleton-row" style="margin:10px 14px;"></div>
            </div>
          </div>

        </div>

      </div><!-- /container-fluid -->
    </section>
  </div><!-- /content-wrapper -->

  <?php include_once '../includes/sub-footer.php'; ?>
  <aside class="control-sidebar control-sidebar-dark"></aside>

</div><!-- /wrapper -->

<?php include_once '../includes/footer.php'; ?>

<script>
/* ═══════════════════════════════════════════════════════════════
   DASHBOARD JS  —  Database-driven version
   All data fetched from: api/dashboard_api.php?action=all
   Pass &station_id=XX to filter by service station (reads from session server-side)
═══════════════════════════════════════════════════════════════ */

/* ── CONFIG ── */
const API_BASE  = '../api/dashboard-data.php'; // adjust path as needed
const STATION_ID = <?php echo isset($_SESSION['station_id']) ? (int)$_SESSION['station_id'] : 0; ?>;
const API_URL    = `${API_BASE}?action=all&station_id=${STATION_ID}`;
const REFRESH_MS = 60_000; // auto-refresh every 60s

/* ── UTILS ── */
function timeAgo(dateStr) {
  if (!dateStr) return '–';
  const diff = Math.floor((Date.now() - new Date(dateStr).getTime()) / 1000);
  if (diff < 60)   return diff + 's ago';
  if (diff < 3600) return Math.floor(diff/60) + 'm ago';
  if (diff < 86400)return Math.floor(diff/3600) + 'h ago';
  return Math.floor(diff/86400) + 'd ago';
}

function fmtDate(dateStr) {
  if (!dateStr) return '–';
  return new Date(dateStr).toLocaleDateString('en-GB', { day:'numeric', month:'short', year:'numeric' });
}

function fmtLKR(n) {
  const num = parseFloat(n) || 0;
  if (num >= 1_000_000) return 'LKR ' + (num/1_000_000).toFixed(2) + 'M';
  if (num >= 1_000)     return 'LKR ' + Math.round(num/1000) + 'K';
  return 'LKR ' + num.toFixed(0);
}

function animateCounter(el, target, dur = 800) {
  const start = performance.now();
  (function tick(now) {
    const p = Math.min((now - start) / dur, 1);
    el.textContent = Math.floor(p * target);
    if (p < 1) requestAnimationFrame(tick);
    else el.textContent = target;
  })(start);
}

function typeBadge(t) {
  const map = {
    'Washer Only':    ['db-badge-wash',    'Wash'],
    'Repair Only':    ['db-badge-repair',  'Repair'],
    'Service Only':   ['db-badge-service', 'Service'],
    'Washers & Repair':['db-badge-all',   'W+R'],
    'Washer & Service':['db-badge-all',   'W+S'],
    'All':            ['db-badge-all',     'All'],
  };
  const [cls, label] = map[t] || ['db-badge-all', t];
  return `<span class="db-badge ${cls}">${label}</span>`;
}

/* ── STAT CARDS ── */
function renderStats(stats) {
  const spinners = ['pending','completed','vehicles','canceled'];
  spinners.forEach(k => {
    const spin = document.getElementById('spin-' + k);
    if (spin) { spin.style.display = 'none'; }
    const trend = document.getElementById('trend-' + k);
    if (trend) trend.textContent = 'Live data';
  });

  animateCounter(document.getElementById('cnt-pending'),   stats.pending);
  animateCounter(document.getElementById('cnt-completed'), stats.completed);
  animateCounter(document.getElementById('cnt-vehicles'),  stats.vehicles);
  animateCounter(document.getElementById('cnt-canceled'),  stats.canceled);
}

/* ── PENDING JOB TABLE ── */
function renderJobTable(jobs) {
  const tbody = document.getElementById('jc-table-body');
  if (!jobs || jobs.length === 0) {
    tbody.innerHTML = `<tr><td colspan="6">
      <div class="empty-state"><i class="fas fa-clipboard-check"></i>No pending job cards</div>
    </td></tr>`;
    return;
  }
  tbody.innerHTML = jobs.map(r => `
    <tr onclick="location.href='../job-cards/view.php?id=${r.id}'">
      <td><span class="jc-code">${r.job_card_code}</span></td>
      <td>
        <div class="owner-name">${r.owner_name || '–'}</div>
        <div class="owner-phone">${r.owner_phone || ''}</div>
      </td>
      <td><span class="plate">${r.plate || '–'}</span></td>
      <td>${typeBadge(r.job_type || '')}</td>
      <td><span class="date-text">${fmtDate(r.created_date)}</span></td>
      <td>
        <div class="status-row">
          <div class="status-indicator" style="background:#f59e0b;"></div>
          <span class="db-badge db-badge-pending">Pending</span>
        </div>
      </td>
    </tr>`).join('');
}

/* ── ACTIVITY FEED ── */
function renderActivity(items) {
  const feed = document.getElementById('db-activity-feed');
  if (!items || items.length === 0) {
    feed.innerHTML = `<div class="empty-state"><i class="fas fa-bolt"></i>No recent activity</div>`;
    return;
  }

  const colorMap = { job_card: '#0baa7c', invoice: '#3a6cf4', canceled: '#dc3545' };

  feed.innerHTML = items.map(a => {
    let color = colorMap[a.event_type] || '#8a92a6';
    let title = '', sub = '';

    if (a.event_type === 'job_card') {
      if (a.status === 'Canceled') { color = '#dc3545'; }
      title = `Job Card ${a.ref} — ${a.status || ''}`;
      sub   = `${a.job_type || ''} — ${a.plate || ''} · ${a.owner_name || ''}`;
    } else if (a.event_type === 'invoice') {
      color = '#3a6cf4';
      title = `Invoice ${a.ref} generated`;
      sub   = `${a.owner_name || ''} · ${a.plate || ''}`;
    }

    return `
      <div class="db-activity-item">
        <div class="db-activity-dot" style="background:${color};"></div>
        <div class="db-activity-content">
          <div class="db-activity-title">${title}</div>
          <div class="db-activity-sub">${sub}</div>
        </div>
        <div class="db-activity-time">${timeAgo(a.created_date)}</div>
      </div>`;
  }).join('');
}

/* ── BAR CHART ── */
function renderBarChart(data) {
  if (!data || data.length === 0) {
    document.getElementById('db-bar-chart').innerHTML =
      '<div class="empty-state" style="width:100%;font-size:11px;color:var(--text-muted);">No revenue data</div>';
    return;
  }
  const values = data.map(d => parseFloat(d.revenue) || 0);
  const max    = Math.max(...values, 1);
  const total  = values.reduce((a,b) => a+b, 0);
  const avg    = values.length ? total / values.length : 0;

  document.getElementById('ytd-rev').textContent = fmtLKR(total);
  document.getElementById('avg-rev').textContent  = fmtLKR(avg);

  document.getElementById('db-bar-chart').innerHTML = data.map((d, i) => {
    const h    = Math.max(Math.round((parseFloat(d.revenue) / max) * 100), 2);
    const last = i === data.length - 1;
    const color = last
      ? 'linear-gradient(180deg,#e8941a,#c94a10)'
      : 'linear-gradient(180deg,rgba(58,108,244,0.55),rgba(58,108,244,0.25))';
    return `
      <div class="db-bar-col">
        <div class="db-bar" style="height:${h}%; background:${color};">
          <div class="db-bar-tooltip">LKR ${Number(d.revenue).toLocaleString()}</div>
        </div>
        <div class="db-bar-label">${d.month_label}</div>
      </div>`;
  }).join('');
}

/* ── DONUT ── */
function renderDonut(data) {
  const svg    = document.getElementById('db-donut-svg');
  const legend = document.getElementById('db-donut-legend');

  if (!data || data.length === 0) {
    svg.innerHTML    = `<circle cx="60" cy="60" r="46" fill="none" stroke="var(--surface3)" stroke-width="14"/>`;
    document.getElementById('donut-total').textContent = '0';
    legend.innerHTML = '<div style="text-align:center;font-size:11px;color:var(--text-muted);">No data this month</div>';
    return;
  }

  const total = data.reduce((s, d) => s + (d.count || 0), 0);
  document.getElementById('donut-total').textContent = total;

  const r = 46, cx = 60, cy = 60, circ = 2 * Math.PI * r;
  let offset = 0;
  const circles = data.map(seg => {
    const dash = ((seg.pct || 0) / 100) * circ;
    const c = `<circle cx="${cx}" cy="${cy}" r="${r}" fill="none" stroke="${seg.color}"
      stroke-width="14" stroke-dasharray="${dash} ${circ - dash}"
      stroke-dashoffset="${-offset}" stroke-linecap="butt"/>`;
    offset += dash;
    return c;
  });
  svg.innerHTML = `<circle cx="${cx}" cy="${cy}" r="${r}" fill="none" stroke="rgba(0,0,0,0.06)" stroke-width="14"/>` + circles.join('');

  legend.innerHTML = data.map(seg => `
    <div class="db-legend-item">
      <div class="db-legend-dot-label">
        <div class="db-legend-dot" style="background:${seg.color};"></div>
        <span>${seg.label}</span>
      </div>
      <span class="db-legend-pct" style="color:${seg.color};">${seg.pct}%</span>
    </div>`).join('');
}

/* ── QUICK METRICS ── */
function renderQuickMetrics(m) {
  const qStats = [
    { val: m.products,  label: 'Products',  color: 'var(--accent3)' },
    { val: m.employees, label: 'Employees', color: 'var(--accent4)' },
    { val: m.suppliers, label: 'Suppliers', color: 'var(--accent)' },
    { val: m.washers,   label: 'Washers',   color: 'var(--success)' },
    { val: m.pkg_items, label: 'Pkg Items', color: '#7c3aed' },
    { val: m.low_stock, label: 'Low Stock', color: 'var(--warning)' },
  ];
  document.getElementById('db-quick-stats').innerHTML = qStats.map(s => `
    <div class="db-q-stat">
      <div class="db-q-stat-val" style="color:${s.color};">${s.val}</div>
      <div class="db-q-stat-label">${s.label}</div>
    </div>`).join('');
}

/* ── PROGRESS LIST ── */
function renderProgressList(id, data) {
  const el = document.getElementById(id);
  if (!data || data.length === 0) {
    el.innerHTML = `<div class="empty-state"><i class="fas fa-inbox"></i>No data available</div>`;
    return;
  }
  el.innerHTML = data.map(d => `
    <div class="db-prog-item">
      <div class="db-prog-top">
        <span class="db-prog-name">${d.name}</span>
        <span class="db-prog-val" style="color:${d.color};">${d.val}</span>
      </div>
      <div class="db-prog-bar-bg">
        <div class="db-prog-bar-fill" data-pct="${d.pct}" style="width:0%; background:${d.color};"></div>
      </div>
    </div>`).join('');

  // Animate
  setTimeout(() => {
    el.querySelectorAll('.db-prog-bar-fill').forEach(bar => {
      bar.style.width = bar.dataset.pct + '%';
    });
  }, 100);
}

/* ── INVENTORY ALERTS ── */
function renderAlerts(items) {
  const el = document.getElementById('db-inventory-alerts');
  if (!items || items.length === 0) {
    el.innerHTML = `<div class="empty-state"><i class="fas fa-check-circle" style="color:var(--success);"></i>All stock levels OK</div>`;
    return;
  }
  el.innerHTML = items.map(a => `
    <div class="db-activity-item">
      <div class="db-activity-dot" style="background:${a.color};"></div>
      <div class="db-activity-content">
        <div class="db-activity-title">${a.name}</div>
        <div class="db-activity-sub" style="color:${a.color};">${a.qty} unit${a.qty == 1 ? '' : 's'} remaining</div>
      </div>
      <i class="fas fa-exclamation-triangle" style="color:${a.color}; font-size:11px; margin-top:4px;"></i>
    </div>`).join('');
}

async function loadDashboard() {
  try {
    const res = await fetch(API_URL + '&_=' + Date.now());

    // Get raw text first, before trying to parse
    const text = await res.text();

    // Uncomment this line temporarily to see what the API is actually returning:
    // console.log('RAW API RESPONSE:', text);

    // Check if it looks like HTML (PHP error) instead of JSON
    if (text.trim().startsWith('<')) {
      console.error('API returned HTML instead of JSON. PHP error output:');
      console.error(text);
      showDashboardError('Server error — check console for details.');
      return;
    }

    if (!res.ok) throw new Error('HTTP ' + res.status);

    const data = JSON.parse(text);

    if (data.error) {
      console.error('API error:', data.error, '| File:', data.file, '| Line:', data.line);
      showDashboardError('API error: ' + data.error);
      return;
    }

    renderStats(data.stats || {});
    renderJobTable(data.pending_jobs || []);
    renderActivity(data.activity || []);
    renderBarChart(data.monthly_revenue || []);
    renderDonut(data.job_type_split || []);
    renderQuickMetrics(data.quick_metrics || {});
    renderProgressList('db-service-breakdown', data.service_breakdown || []);
    renderProgressList('db-po-status', data.po_status || []);
    renderAlerts(data.inventory_alerts || []);

  } catch (err) {
    console.error('Dashboard load failed:', err);
    showDashboardError('Failed to load dashboard data.');
  }
}

function showDashboardError(msg) {
  // Shows a visible banner at the top of the dashboard
  const existing = document.getElementById('db-error-banner');
  if (existing) existing.remove();

  const banner = document.createElement('div');
  banner.id = 'db-error-banner';
  banner.style.cssText = `
    background: #fee2e2; border: 1px solid #fca5a5; color: #991b1b;
    padding: 10px 18px; border-radius: 8px; margin-bottom: 16px;
    font-size: 12px; display: flex; align-items: center; gap: 10px;
  `;
  banner.innerHTML = `
    <i class="fas fa-exclamation-circle"></i>
    <span>${msg}</span>
    <span style="margin-left:auto; cursor:pointer; opacity:0.6;" onclick="this.parentElement.remove()">✕</span>
  `;

  // Insert before the stats row
  const statsRow = document.querySelector('.stats-row');
  if (statsRow) statsRow.before(banner);
}
/* ── INIT ── */
$(function () {
  // Date header
  const d = new Date();
  document.getElementById('db-current-date').textContent =
    d.toLocaleDateString('en-GB', { weekday:'long', day:'numeric', month:'long', year:'numeric' });

  // Initial load
  loadDashboard();

  // Auto-refresh
  setInterval(loadDashboard, REFRESH_MS);
});
</script>

</body>
</html>