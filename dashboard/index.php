<?php include_once '../includes/header.php';?>

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

  .content-wrapper {
    background: var(--bg) !important;
  }

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

  .stat-trend {
    font-size: 11px;
    display: flex; align-items: center; gap: 4px;
    color: var(--text-muted);
  }
  .trend-up   { color: var(--success); }
  .trend-down { color: var(--danger); }

  /* ── GRID LAYOUTS ── */
  .db-grid-2col {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 16px;
    margin-bottom: 16px;
  }

  .db-grid-3col {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 16px;
  }

  .db-footer-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 16px;
  }

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
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: var(--surface);
  }

  .db-panel-title {
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    color: var(--text-dim);
    display: flex; align-items: center; gap: 8px;
  }
  .db-panel-title i { font-size: 11px; }

  .db-panel-action {
    font-size: 11px;
    color: var(--accent4);
    cursor: pointer;
    text-decoration: none;
    font-weight: 600;
    transition: opacity 0.2s;
  }
  .db-panel-action:hover { opacity: 0.65; color: var(--accent4); text-decoration: none; }

  /* ── JOB CARD TABLE ── */
  .jc-table { width: 100%; border-collapse: collapse; }

  .jc-table thead th {
    padding: 9px 16px;
    font-size: 10px;
    letter-spacing: 1.3px;
    text-transform: uppercase;
    color: var(--text-muted);
    font-weight: 600;
    background: var(--surface2);
    border-bottom: 1px solid var(--border);
    white-space: nowrap;
  }

  .jc-table tbody tr {
    border-bottom: 1px solid var(--border);
    transition: background 0.12s;
    cursor: pointer;
  }
  .jc-table tbody tr:hover { background: var(--surface2); }
  .jc-table tbody tr:last-child { border-bottom: none; }

  .jc-table tbody td {
    padding: 11px 16px;
    font-size: 12.5px;
    vertical-align: middle;
    color: var(--text);
  }

  .jc-code {
    font-weight: 700;
    color: var(--accent4);
    font-size: 12.5px;
    letter-spacing: 0.3px;
  }

  .owner-name { font-weight: 500; color: var(--text); }
  .owner-phone { font-size: 11px; color: var(--text-muted); margin-top: 1px; }

  .plate {
    display: inline-block;
    background: var(--surface3);
    border: 1px solid var(--border-bright);
    border-radius: 4px;
    padding: 2px 8px;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 1px;
    color: var(--text);
  }

  .db-badge {
    display: inline-block;
    padding: 3px 9px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.8px;
    text-transform: uppercase;
  }
  .db-badge-service  { background: rgba(11,170,124,0.10); color: #0baa7c; }
  .db-badge-repair   { background: rgba(58,108,244,0.10); color: #3a6cf4; }
  .db-badge-wash     { background: rgba(232,148,26,0.12); color: #c47a10; }
  .db-badge-all      { background: rgba(109,40,217,0.10); color: #7c3aed; }
  .db-badge-pending  { background: rgba(245,158,11,0.10); color: #b45309; }
  .db-badge-done     { background: rgba(25,135,84,0.10);  color: #198754; }
  .db-badge-canceled { background: rgba(220,53,69,0.10);  color: #dc3545; }

  .date-text { font-size: 11.5px; color: var(--text-muted); }

  /* ── ACTIVITY FEED ── */
  .db-activity-list { padding: 4px 0; }

  .db-activity-item {
    display: flex;
    align-items: flex-start;
    gap: 11px;
    padding: 11px 18px;
    border-bottom: 1px solid var(--border);
    transition: background 0.12s;
  }
  .db-activity-item:hover { background: var(--surface2); }
  .db-activity-item:last-child { border-bottom: none; }

  .db-activity-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    margin-top: 5px;
    flex-shrink: 0;
  }

  .db-activity-content { flex: 1; min-width: 0; }
  .db-activity-title { font-size: 12px; font-weight: 500; color: var(--text); line-height: 1.4; }
  .db-activity-sub   { font-size: 11px; color: var(--text-muted); margin-top: 2px; }
  .db-activity-time  { font-size: 10px; color: var(--text-muted); white-space: nowrap; }

  /* ── BAR CHART ── */
  .chart-wrap { padding: 18px 18px 0; }

  .db-bar-chart {
    display: flex;
    align-items: flex-end;
    gap: 8px;
    height: 110px;
  }

  .db-bar-col {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;
    height: 100%;
    justify-content: flex-end;
  }

  .db-bar {
    width: 100%;
    border-radius: 5px 5px 0 0;
    position: relative;
    min-height: 4px;
    cursor: pointer;
    transition: filter 0.15s, opacity 0.15s;
  }
  .db-bar:hover { filter: brightness(1.12); }

  .db-bar-label { font-size: 9.5px; color: var(--text-muted); letter-spacing: 0.3px; }

  .db-bar-tooltip {
    position: absolute;
    top: -26px; left: 50%;
    transform: translateX(-50%);
    background: var(--text);
    color: #fff;
    border-radius: 5px;
    padding: 3px 7px;
    font-size: 10px;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.12s;
    font-weight: 600;
  }
  .db-bar:hover .db-bar-tooltip { opacity: 1; }

  /* ── QUICK STATS GRID ── */
  .db-quick-stats {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    padding: 14px 16px;
  }

  .db-q-stat {
    background: var(--surface2);
    border: 1px solid var(--border);
    border-radius: 9px;
    padding: 13px 10px;
    text-align: center;
    transition: box-shadow 0.2s;
  }
  .db-q-stat:hover { box-shadow: 0 2px 8px rgba(0,0,0,0.08); }

  .db-q-stat-val {
    font-size: 26px;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 4px;
  }

  .db-q-stat-label {
    font-size: 9.5px;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: var(--text-muted);
    font-weight: 600;
  }

  /* ── DONUT ── */
  .db-donut-wrap {
    padding: 18px 18px 14px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 14px;
  }

  .db-donut-container {
    position: relative;
    width: 120px; height: 120px;
    display: flex; align-items: center; justify-content: center;
  }

  .db-donut-svg { transform: rotate(-90deg); }

  .db-donut-center {
    position: absolute;
    inset: 0;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    text-align: center;
  }

  .db-donut-legend {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 7px;
  }

  .db-legend-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 12px;
    color: var(--text-dim);
  }

  .db-legend-dot-label { display: flex; align-items: center; gap: 8px; }
  .db-legend-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
  .db-legend-pct { font-weight: 700; font-size: 13px; }

  /* ── PROGRESS LIST ── */
  .db-progress-list {
    padding: 14px 18px;
    display: flex;
    flex-direction: column;
    gap: 13px;
  }

  .db-prog-item { display: flex; flex-direction: column; gap: 5px; }
  .db-prog-top { display: flex; justify-content: space-between; align-items: center; }
  .db-prog-name { font-size: 12px; color: var(--text-dim); }
  .db-prog-val { font-size: 12px; font-weight: 700; }

  .db-prog-bar-bg {
    height: 5px;
    border-radius: 5px;
    background: var(--surface3);
    overflow: hidden;
  }
  .db-prog-bar-fill {
    height: 100%;
    border-radius: 5px;
    transition: width 1s cubic-bezier(0.4,0,0.2,1);
  }

  /* ── LIVE BADGE ── */
  .db-live-badge {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: 11px; font-weight: 600;
    color: var(--accent3);
    letter-spacing: 0.8px;
    text-transform: uppercase;
    margin-left: 10px;
  }
  .db-live-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--accent3);
    animation: dbPulse 2s infinite;
  }
  @keyframes dbPulse {
    0%,100% { opacity:1; transform:scale(1); }
    50%      { opacity:0.4; transform:scale(1.4); }
  }

  /* Status indicator */
  .status-row { display: flex; align-items: center; gap: 6px; }
  .status-indicator { width: 6px; height: 6px; border-radius: 50%; }

  /* ── ALERT PANEL ── */
  .db-alert-scroll { max-height: 220px; overflow-y: auto; }
  .db-alert-scroll::-webkit-scrollbar { width: 3px; }
  .db-alert-scroll::-webkit-scrollbar-thumb { background: var(--surface3); border-radius: 3px; }

  /* ── REVENUE FOOTER ── */
  .db-chart-footer {
    display: flex;
    justify-content: space-between;
    padding: 8px 18px 16px;
    font-size: 11px;
    color: var(--text-muted);
    border-top: 1px solid var(--border);
    margin-top: 10px;
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
            <div class="stat-value" id="cnt-pending">0</div>
            <div class="stat-trend">
              <i class="fas fa-arrow-up trend-up"></i>
              <span class="trend-up">+4</span>&nbsp;from yesterday
            </div>
          </div>
          <div class="stat-card green">
            <div class="stat-glow"></div>
            <div class="stat-icon-wrap"><i class="fas fa-check-double"></i></div>
            <div class="stat-label">Completed Today</div>
            <div class="stat-value" id="cnt-completed">0</div>
            <div class="stat-trend">
              <i class="fas fa-arrow-up trend-up"></i>
              <span class="trend-up">+2</span>&nbsp;from yesterday
            </div>
          </div>
          <div class="stat-card blue">
            <div class="stat-glow"></div>
            <div class="stat-icon-wrap"><i class="fas fa-car"></i></div>
            <div class="stat-label">Vehicles Registered</div>
            <div class="stat-value" id="cnt-vehicles">0</div>
            <div class="stat-trend">
              <i class="fas fa-arrow-up trend-up"></i>
              <span class="trend-up">+12</span>&nbsp;this month
            </div>
          </div>
          <div class="stat-card red">
            <div class="stat-glow"></div>
            <div class="stat-icon-wrap"><i class="fas fa-ban"></i></div>
            <div class="stat-label">Canceled Jobs</div>
            <div class="stat-value" id="cnt-canceled">0</div>
            <div class="stat-trend">
              <i class="fas fa-arrow-down"></i>
              <span class="trend-up">−1</span>&nbsp;from yesterday
            </div>
          </div>
        </div>

        <!-- ── ROW 2: Job Cards + Activity ── -->
        <div class="db-grid-2col">

          <!-- Pending Job Cards -->
          <div class="db-panel">
            <div class="db-panel-header">
              <span class="db-panel-title"><i class="fas fa-clock text-warning"></i> Pending Job Cards</span>
              <a href="../job-cards/" class="db-panel-action">View All →</a>
            </div>
            <div style="overflow-x:auto;">
              <table class="jc-table">
                <thead>
                  <tr>
                    <th>Code</th>
                    <th>Owner</th>
                    <th>Vehicle</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody id="jc-table-body"></tbody>
              </table>
            </div>
          </div>

          <!-- Activity Feed -->
          <div class="db-panel">
            <div class="db-panel-header">
              <span class="db-panel-title"><i class="fas fa-bolt text-warning"></i> Recent Activity</span>
            </div>
            <div class="db-activity-list" id="db-activity-feed"></div>
          </div>

        </div>

        <!-- ── ROW 3: Revenue + Donut + Quick Metrics ── -->
        <div class="db-grid-3col">

          <!-- Revenue Bar Chart -->
          <div class="db-panel">
            <div class="db-panel-header">
              <span class="db-panel-title"><i class="fas fa-chart-bar text-primary"></i> Monthly Revenue</span>
              <span class="db-panel-action">LKR</span>
            </div>
            <div class="chart-wrap">
              <div class="db-bar-chart" id="db-bar-chart"></div>
            </div>
            <div class="db-chart-footer">
              <span>YTD: <strong style="color:var(--accent); font-size:14px;">LKR 2.84M</strong></span>
              <span>Monthly Avg: <strong style="color:var(--text-dim);">LKR 237K</strong></span>
            </div>
          </div>

          <!-- Job Type Donut -->
          <div class="db-panel">
            <div class="db-panel-header">
              <span class="db-panel-title"><i class="fas fa-chart-pie text-info"></i> Job Type Split</span>
              <span class="db-panel-action">This Month</span>
            </div>
            <div class="db-donut-wrap">
              <div class="db-donut-container">
                <svg class="db-donut-svg" width="120" height="120" viewBox="0 0 120 120" id="db-donut-svg"></svg>
                <div class="db-donut-center">
                  <div style="font-size:22px; font-weight:700; color:var(--text); line-height:1;">148</div>
                  <div style="font-size:9.5px; color:var(--text-muted); letter-spacing:0.5px; margin-top:2px;">TOTAL</div>
                </div>
              </div>
              <div class="db-donut-legend" id="db-donut-legend"></div>
            </div>
          </div>

          <!-- Quick Metrics -->
          <div class="db-panel">
            <div class="db-panel-header">
              <span class="db-panel-title"><i class="fas fa-tachometer-alt"></i> Quick Metrics</span>
            </div>
            <div class="db-quick-stats">
              <div class="db-q-stat">
                <div class="db-q-stat-val" style="color:var(--accent3);">47</div>
                <div class="db-q-stat-label">Products</div>
              </div>
              <div class="db-q-stat">
                <div class="db-q-stat-val" style="color:var(--accent4);">12</div>
                <div class="db-q-stat-label">Employees</div>
              </div>
              <div class="db-q-stat">
                <div class="db-q-stat-val" style="color:var(--accent);">8</div>
                <div class="db-q-stat-label">Suppliers</div>
              </div>
              <div class="db-q-stat">
                <div class="db-q-stat-val" style="color:#7c3aed;">23</div>
                <div class="db-q-stat-label">Pkg Items</div>
              </div>
              <div class="db-q-stat">
                <div class="db-q-stat-val" style="color:var(--warning);">5</div>
                <div class="db-q-stat-label">Low Stock</div>
              </div>
              <div class="db-q-stat">
                <div class="db-q-stat-val" style="color:var(--success);">3</div>
                <div class="db-q-stat-label">Washers</div>
              </div>
            </div>
          </div>

        </div>

        <!-- ── ROW 4: Service Breakdown + PO Status + Inventory Alerts ── -->
        <div class="db-footer-row">

          <!-- Service Breakdown -->
          <div class="db-panel">
            <div class="db-panel-header">
              <span class="db-panel-title"><i class="fas fa-layer-group text-success"></i> Service Breakdown</span>
            </div>
            <div class="db-progress-list" id="db-service-breakdown"></div>
          </div>

          <!-- Purchase Orders -->
          <div class="db-panel">
            <div class="db-panel-header">
              <span class="db-panel-title"><i class="fas fa-shopping-cart text-primary"></i> Purchase Orders</span>
              <a href="../purchase-order/" class="db-panel-action">View All →</a>
            </div>
            <div class="db-progress-list" id="db-po-status"></div>
          </div>

          <!-- Inventory Alerts -->
          <div class="db-panel">
            <div class="db-panel-header">
              <span class="db-panel-title"><i class="fas fa-exclamation-triangle text-warning"></i> Inventory Alerts</span>
            </div>
            <div class="db-activity-list db-alert-scroll" id="db-inventory-alerts"></div>
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
/* ── MOCK DATA ── */
const mockPending = [
  { code:'JC-2024-0041', owner:'Kasun Perera',    phone:'0771234567', plate:'CAB-1234', type:'Service', date:'20 Feb 2026' },
  { code:'JC-2024-0040', owner:'Nilufar Rashid',  phone:'0712345678', plate:'WP-8891',  type:'Repair',  date:'20 Feb 2026' },
  { code:'JC-2024-0039', owner:'Saman Fernando',  phone:'0760001122', plate:'NW-4456',  type:'All',     date:'19 Feb 2026' },
  { code:'JC-2024-0038', owner:'Priya Jayasinghe',phone:'0779988776', plate:'SG-2231',  type:'Wash',    date:'19 Feb 2026' },
  { code:'JC-2024-0037', owner:'Rathna Silva',    phone:'0701122334', plate:'EW-7710',  type:'Repair',  date:'18 Feb 2026' },
  { code:'JC-2024-0036', owner:'Amali Gunatilake',phone:'0754455667', plate:'CP-6643',  type:'Service', date:'18 Feb 2026' },
];

const activity = [
  { color:'#0baa7c', title:'Job Card JC-2024-0041 opened',       sub:'Service Package — Toyota Corolla',    time:'2m ago'  },
  { color:'#3a6cf4', title:'Invoice INV-20240219 generated',      sub:'LKR 12,450 — Kasun Perera',           time:'14m ago' },
  { color:'#e8941a', title:'Car wash completed',                  sub:'WP-8891 — Nilufar Rashid',            time:'31m ago' },
  { color:'#dc3545', title:'Job Card JC-2024-0035 canceled',     sub:'Saman Fernando',                      time:'1h ago'  },
  { color:'#7c3aed', title:'New purchase order PO-2024-0017',    sub:'Supplier: Lanka Lubricants Ltd',       time:'2h ago'  },
  { color:'#198754', title:'Payment received',                    sub:'LKR 8,200 — EW-7710',                 time:'3h ago'  },
  { color:'#f59e0b', title:'Low stock alert: Engine Oil 5W30',   sub:'Only 3 units remaining',              time:'4h ago'  },
];

const monthlyRevenue = [
  { month:'Jul', val:198 }, { month:'Aug', val:224 }, { month:'Sep', val:187 },
  { month:'Oct', val:256 }, { month:'Nov', val:290 }, { month:'Dec', val:312 },
  { month:'Jan', val:198 }, { month:'Feb', val:165 },
];

const jobTypeSplit = [
  { label:'Service',   pct:38, color:'#0baa7c' },
  { label:'Repair',    pct:29, color:'#3a6cf4' },
  { label:'Wash',      pct:18, color:'#e8941a' },
  { label:'All Types', pct:15, color:'#7c3aed' },
];

const serviceBreakdown = [
  { name:'Engine Service', val:'LKR 485K', pct:65, color:'#0baa7c' },
  { name:'Body Repair',    val:'LKR 340K', pct:46, color:'#3a6cf4' },
  { name:'Car Wash',       val:'LKR 128K', pct:17, color:'#e8941a' },
  { name:'Tire & Wheel',   val:'LKR 220K', pct:30, color:'#7c3aed' },
  { name:'Electrical',     val:'LKR 175K', pct:23, color:'#dc3545' },
];

const poStatus = [
  { name:'Pending Orders',   val:'7',  pct:35, color:'#f59e0b' },
  { name:'Completed Orders', val:'14', pct:70, color:'#198754' },
  { name:'Canceled Orders',  val:'2',  pct:10, color:'#dc3545' },
  { name:'Advance Paid',     val:'5',  pct:25, color:'#3a6cf4' },
];

const inventoryAlerts = [
  { name:'Engine Oil 5W30 (1L)',  qty:3, color:'#dc3545' },
  { name:'Air Filter — Corolla',  qty:1, color:'#dc3545' },
  { name:'Brake Pads Set',        qty:4, color:'#f59e0b' },
  { name:'Oil Filter Universal',  qty:5, color:'#f59e0b' },
  { name:'Transmission Fluid',    qty:2, color:'#dc3545' },
];

/* ── HELPERS ── */
function typeBadge(t) {
  const m = { Service:'db-badge-service', Repair:'db-badge-repair', Wash:'db-badge-wash', All:'db-badge-all' };
  return `<span class="db-badge ${m[t]||'db-badge-all'}">${t}</span>`;
}

function animateCounter(el, target, dur=800) {
  const start = performance.now();
  (function tick(now) {
    const p = Math.min((now - start) / dur, 1);
    el.textContent = Math.floor(p * target);
    if (p < 1) requestAnimationFrame(tick);
    else el.textContent = target;
  })(start);
}

/* ── BUILDERS ── */
function buildTable() {
  document.getElementById('jc-table-body').innerHTML = mockPending.map(r => `
    <tr>
      <td><span class="jc-code">${r.code}</span></td>
      <td>
        <div class="owner-name">${r.owner}</div>
        <div class="owner-phone">${r.phone}</div>
      </td>
      <td><span class="plate">${r.plate}</span></td>
      <td>${typeBadge(r.type)}</td>
      <td><span class="date-text">${r.date}</span></td>
      <td>
        <div class="status-row">
          <div class="status-indicator" style="background:#f59e0b;"></div>
          <span class="db-badge db-badge-pending">Pending</span>
        </div>
      </td>
    </tr>`).join('');
}

function buildActivity() {
  document.getElementById('db-activity-feed').innerHTML = activity.map(a => `
    <div class="db-activity-item">
      <div class="db-activity-dot" style="background:${a.color};"></div>
      <div class="db-activity-content">
        <div class="db-activity-title">${a.title}</div>
        <div class="db-activity-sub">${a.sub}</div>
      </div>
      <div class="db-activity-time">${a.time}</div>
    </div>`).join('');
}

function buildBarChart() {
  const max = Math.max(...monthlyRevenue.map(d => d.val));
  document.getElementById('db-bar-chart').innerHTML = monthlyRevenue.map((d, i) => {
    const h = Math.round((d.val / max) * 100);
    const isLast = i === monthlyRevenue.length - 1;
    const color = isLast
      ? 'linear-gradient(180deg,#e8941a,#c94a10)'
      : 'linear-gradient(180deg,rgba(58,108,244,0.55),rgba(58,108,244,0.25))';
    return `
      <div class="db-bar-col">
        <div class="db-bar" style="height:${h}%; background:${color};">
          <div class="db-bar-tooltip">LKR ${d.val}K</div>
        </div>
        <div class="db-bar-label">${d.month}</div>
      </div>`;
  }).join('');
}

function buildDonut() {
  const svg = document.getElementById('db-donut-svg');
  const r = 46, cx = 60, cy = 60;
  const circ = 2 * Math.PI * r;
  let offset = 0;
  const circles = jobTypeSplit.map(seg => {
    const dash = (seg.pct / 100) * circ;
    const c = `<circle cx="${cx}" cy="${cy}" r="${r}" fill="none" stroke="${seg.color}"
      stroke-width="14" stroke-dasharray="${dash} ${circ - dash}"
      stroke-dashoffset="${-offset}" stroke-linecap="butt"/>`;
    offset += dash;
    return c;
  });
  svg.innerHTML = `<circle cx="${cx}" cy="${cy}" r="${r}" fill="none" stroke="rgba(0,0,0,0.06)" stroke-width="14"/>` + circles.join('');

  document.getElementById('db-donut-legend').innerHTML = jobTypeSplit.map(seg => `
    <div class="db-legend-item">
      <div class="db-legend-dot-label">
        <div class="db-legend-dot" style="background:${seg.color};"></div>
        <span>${seg.label}</span>
      </div>
      <span class="db-legend-pct" style="color:${seg.color};">${seg.pct}%</span>
    </div>`).join('');
}

function buildProgressList(id, data) {
  document.getElementById(id).innerHTML = data.map(d => `
    <div class="db-prog-item">
      <div class="db-prog-top">
        <span class="db-prog-name">${d.name}</span>
        <span class="db-prog-val" style="color:${d.color};">${d.val}</span>
      </div>
      <div class="db-prog-bar-bg">
        <div class="db-prog-bar-fill" data-pct="${d.pct}" style="width:0%; background:${d.color};"></div>
      </div>
    </div>`).join('');
}

function buildAlerts() {
  document.getElementById('db-inventory-alerts').innerHTML = inventoryAlerts.map(a => `
    <div class="db-activity-item">
      <div class="db-activity-dot" style="background:${a.color};"></div>
      <div class="db-activity-content">
        <div class="db-activity-title">${a.name}</div>
        <div class="db-activity-sub" style="color:${a.color};">${a.qty} unit${a.qty===1?'':'s'} remaining</div>
      </div>
      <i class="fas fa-exclamation-triangle" style="color:${a.color}; font-size:11px; margin-top:4px;"></i>
    </div>`).join('');
}

/* ── INIT ── */
$(function() {
  // Date
  const d = new Date();
  document.getElementById('db-current-date').textContent =
    d.toLocaleDateString('en-GB', { weekday:'long', day:'numeric', month:'long', year:'numeric' });

  buildTable();
  buildActivity();
  buildBarChart();
  buildDonut();
  buildProgressList('db-service-breakdown', serviceBreakdown);
  buildProgressList('db-po-status', poStatus);
  buildAlerts();

  // Animate counters
  setTimeout(() => {
    animateCounter(document.getElementById('cnt-pending'),   12);
    animateCounter(document.getElementById('cnt-completed'), 7);
    animateCounter(document.getElementById('cnt-vehicles'),  184);
    animateCounter(document.getElementById('cnt-canceled'),  3);
  }, 300);

  // Animate progress bars
  setTimeout(() => {
    document.querySelectorAll('.db-prog-bar-fill').forEach(el => {
      el.style.width = el.dataset.pct + '%';
    });
  }, 500);
});
</script>

</body>
</html>