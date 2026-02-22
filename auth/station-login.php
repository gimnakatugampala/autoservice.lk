<?php include_once '../includes/auth-header.php'; ?>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --blue:        #007bff;
        --blue-dark:   #0056b3;
        --blue-deeper: #003d80;
        --blue-light:  #e8f2ff;
        --blue-mid:    #c5deff;
        --blue-glow:   rgba(0,123,255,0.18);
        --white:       #ffffff;
        --surface:     #f4f7fb;
        --border:      #e2e8f0;
        --text-1:      #0f1c2e;
        --text-2:      #4a5a72;
        --text-3:      #8a9bb5;
        --danger:      #e53e3e;
        --success:     #38a169;
    }

    /* ── RESET Bootstrap wrappers ── */
    html, body.account-page { height: 100%; }

    body.account-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--surface);
        overflow: hidden;
    }

    body.account-page .main-wrapper,
    body.account-page .account-content {
        width: 100% !important;
        max-width: 100% !important;
        padding: 0 !important;
        margin: 0 !important;
        height: 100vh !important;
        display: block !important;
        overflow: hidden !important;
    }

    /* ── FULL SCREEN LAYOUT ── */
    .login-wrapper {
        display: flex !important;
        width: 100vw !important;
        height: 100vh !important;
        overflow: hidden !important;
        position: fixed;
        top: 0; left: 0;
    }

    /* ══════════════════════════
       LEFT PANEL
    ══════════════════════════ */
    .login-wrapper .login-content{
        overflow-x: hidden;
    }
    
    .login-content {
        position: relative;
        width: 460px;
        min-width: 460px;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: stretch;
        padding: 0 52px;
        background: var(--white);
        border-right: 1px solid var(--border);
        overflow: hidden;
        z-index: 2;
        box-shadow: 6px 0 40px rgba(0,0,0,0.07);
        box-sizing: border-box;
    }

    /* Decorative blobs — clipped by overflow:hidden on parent */
    .login-content::before {
        content: '';
        position: absolute;
        top: -80px; right: -100px;
        width: 280px; height: 280px;
        background: radial-gradient(circle, var(--blue-light) 0%, transparent 70%);
        pointer-events: none;
    }
    .login-content::after {
        content: '';
        position: absolute;
        bottom: -60px; left: -50px;
        width: 200px; height: 200px;
        background: radial-gradient(circle, var(--blue-light) 0%, transparent 70%);
        pointer-events: none;
    }

    .login-userset {
        position: relative;
        z-index: 1;
        width: 100%;
        transform-origin: top center;
        animation: slideIn 0.6s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    /* ── LOGO — force inline, defeat any Bootstrap overrides ── */
    .login-logo {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        flex-wrap: nowrap !important;
        gap: 10px;
        margin-bottom: 24px;
    }

    .logo-img-wrap {
        display: inline-flex !important;
        width: 38px !important;
        height: 38px !important;
        min-width: 38px !important;
        border-radius: 9px;
        overflow: hidden;
        border: 1.5px solid var(--border);
        flex-shrink: 0 !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .logo-img-wrap img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover;
        display: block !important;
        float: none !important;
    }

    .logo-text {
        display: inline !important;
        font-size: 15.5px !important;
        font-weight: 800 !important;
        color: var(--text-1) !important;
        letter-spacing: -0.4px;
        white-space: nowrap !important;
        line-height: 1;
        vertical-align: middle;
    }
    .logo-text span { color: var(--blue) !important; }

    /* ── BADGE + HEADING ── */
    .heading-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--blue-light);
        color: var(--blue);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        padding: 4px 10px;
        border-radius: 100px;
        margin-bottom: 8px;
    }
    .heading-badge .dot {
        width: 6px; height: 6px;
        background: var(--blue);
        border-radius: 50%;
        flex-shrink: 0;
        animation: pulse 2s infinite;
    }

    .login-userheading h3 {
        font-size: 24px;
        font-weight: 800;
        color: var(--text-1);
        letter-spacing: -0.6px;
        line-height: 1.2;
        margin-bottom: 5px;
    }
    .login-userheading h4 {
        font-size: 13px;
        font-weight: 400;
        color: var(--text-2);
        line-height: 1.5;
        margin-bottom: 20px;
    }

    /* ── FIELDS ── */
    .field-block { margin-bottom: 12px; }

    .field-block label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: var(--text-1);
        margin-bottom: 6px;
    }

    .field-wrap { position: relative; }

    .field-wrap input {
        width: 100%;
        padding: 12px 40px 12px 14px;
        border: 1.5px solid var(--border);
        border-radius: 10px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 14px;
        color: var(--text-1);
        background: var(--white);
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        -webkit-appearance: none;
        box-sizing: border-box;
    }
    .field-wrap input::placeholder { color: var(--text-3); }
    .field-wrap input:focus {
        outline: none;
        border-color: var(--blue);
        background: #fafcff;
        box-shadow: 0 0 0 3.5px var(--blue-glow);
    }

    .field-icon {
        position: absolute;
        right: 13px; top: 50%;
        transform: translateY(-50%);
        color: var(--text-3);
        font-size: 13px;
        pointer-events: none;
    }

    .toggle-password {
        position: absolute;
        right: 13px; top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: var(--text-3);
        font-size: 13px;
        transition: color 0.2s;
    }
    .toggle-password:hover { color: var(--blue); }

    /* ── FORGOT ── */
    .row-meta {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 14px;
        margin-top: -2px;
    }
    .forgot-link {
        font-size: 12.5px;
        font-weight: 600;
        color: var(--blue);
        text-decoration: none;
        transition: color 0.2s;
    }
    .forgot-link:hover { color: var(--blue-dark); text-decoration: underline; }

    /* ── RECAPTCHA ── */
    .recaptcha-wrap {
        margin-bottom: 14px;
        transform: scale(0.85);
        transform-origin: left center;
    }

    /* ── BUTTONS ── */
    .btn-login {
        position: relative;
        width: 100%;
        padding: 13px 20px;
        background: linear-gradient(135deg, var(--blue) 0%, #0062d6 100%);
        color: #fff;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 14px;
        font-weight: 700;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        overflow: hidden;
        transition: transform 0.18s, box-shadow 0.18s;
        box-shadow: 0 4px 18px rgba(0,102,255,0.28);
        box-sizing: border-box;
    }
    .btn-login::after {
        content: '';
        position: absolute;
        top: 0; left: -100%; width: 60%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        transition: left 0.5s;
    }
    .btn-login:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(0,102,255,0.38); }
    .btn-login:hover::after { left: 160%; }
    .btn-login:active { transform: translateY(0); }

    .btn-loading {
        display: none;
        width: 100%;
        padding: 13px 20px;
        background: var(--blue-light);
        color: var(--blue);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 14px;
        font-weight: 700;
        border: 1.5px solid var(--blue-mid);
        border-radius: 10px;
        cursor: not-allowed;
        box-sizing: border-box;
    }

    /* ── AUTH FOOTER ── */
    .auth-footer {
        margin-top: 14px;
        padding-top: 14px;
        border-top: 1px solid var(--border);
        text-align: center;
        font-size: 13px;
        color: var(--text-2);
    }
    .auth-footer a {
        color: var(--blue);
        font-weight: 700;
        text-decoration: none;
        transition: color 0.2s;
    }
    .auth-footer a:hover { color: var(--blue-dark); }

    /* ══════════════════════════
       RIGHT VISUAL PANEL
       — natural photo, dark scrim only
    ══════════════════════════ */
    .login-visual {
        flex: 1;
        position: relative;
        overflow: hidden;
        height: 100vh;
        background: #111;
    }

    /* Photo at full natural color */
    .login-visual img {
        position: absolute;
        inset: 0;
        width: 100%; height: 100%;
        object-fit: cover;
        display: block;
        opacity: 0.75;                 /* ← show photo naturally */
        transition: transform 0.1s linear;
    }

    /* Subtle dark vignette — no color cast */
    .visual-scrim {
        position: absolute; inset: 0;
        background:
            linear-gradient(to top,  rgba(0,0,0,0.82) 0%, rgba(0,0,0,0.15) 55%, transparent 100%),
            linear-gradient(to right, rgba(0,0,0,0.35) 0%, transparent 40%);
    }

    /* Thin blue accent bar on left edge of the panel */
    .visual-accent-bar {
        position: absolute;
        top: 0; left: 0;
        width: 4px; height: 100%;
        background: linear-gradient(to bottom, transparent, var(--blue), transparent);
        opacity: 0.7;
    }

    .visual-inner {
        position: absolute; inset: 0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 48px 52px;
    }

    /* Stats cards */
    .visual-cards {
        display: flex;
        flex-direction: column;
        gap: 12px;
        align-self: flex-end;
        animation: fadeSlideDown 0.8s 0.3s both;
    }

    .vcard {
        background: rgba(0,0,0,0.45);
        border: 1px solid rgba(255,255,255,0.12);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border-radius: 14px;
        padding: 14px 20px;
        min-width: 160px;
    }
    .vcard-num {
        font-size: 24px;
        font-weight: 800;
        color: #fff;
        line-height: 1;
        margin-bottom: 3px;
        letter-spacing: -0.5px;
    }
    .vcard-label {
        font-size: 11.5px;
        color: rgba(255,255,255,0.5);
    }

    /* Bottom copy */
    .visual-bottom { animation: fadeSlideUp 0.7s 0.2s both; }

    .vb-tag {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(0,123,255,0.25);
        border: 1px solid rgba(0,123,255,0.4);
        color: #90c8ff;
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 5px 12px;
        border-radius: 100px;
        margin-bottom: 18px;
    }
    .vb-tag::before {
        content: '';
        width: 6px; height: 6px;
        background: #4affb4;
        border-radius: 50%;
        box-shadow: 0 0 7px #4affb4;
        animation: pulse 2s infinite;
    }

    .visual-bottom h2 {
        font-size: 38px;
        font-weight: 800;
        color: #fff;
        line-height: 1.15;
        letter-spacing: -1px;
        margin-bottom: 14px;
        text-shadow: 0 2px 20px rgba(0,0,0,0.4);
    }
    .visual-bottom p {
        font-size: 14.5px;
        color: rgba(255,255,255,0.65);
        font-weight: 300;
        line-height: 1.65;
        max-width: 400px;
    }

    .feature-list {
        display: flex;
        gap: 10px;
        margin-top: 26px;
        flex-wrap: wrap;
    }
    .feat-item {
        display: flex;
        align-items: center;
        gap: 7px;
        background: rgba(0,0,0,0.4);
        border: 1px solid rgba(255,255,255,0.12);
        backdrop-filter: blur(8px);
        border-radius: 8px;
        padding: 7px 13px;
        font-size: 12px;
        color: rgba(255,255,255,0.75);
        font-weight: 500;
    }
    .feat-item i { color: #7dd3fc; font-size: 12px; }

    /* ══════════════════════════
       MODAL
    ══════════════════════════ */
    #fpModal { z-index: 99999 !important; }
    .modal-backdrop { z-index: 99998 !important; }

    #fpModal .modal-content {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 24px 64px rgba(0,0,0,0.18);
    }
    #fpModal .modal-header {
        background: linear-gradient(135deg, var(--blue) 0%, #0055cc 100%);
        border-bottom: none;
        padding: 22px 28px;
    }
    #fpModal .modal-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 17px;
        font-weight: 700;
        color: #fff;
    }
    #fpModal .modal-header .close {
        color: rgba(255,255,255,0.8);
        opacity: 1;
        font-size: 22px;
        transition: color 0.2s;
    }
    #fpModal .modal-header .close:hover { color: #fff; }
    #fpModal .modal-body { padding: 24px 28px; background: #fff; }
    #fpModal .modal-body .desc {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13.5px;
        color: var(--text-2);
        line-height: 1.6;
        margin-bottom: 20px;
    }
    #fpModal label {
        display: block;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 12px;
        font-weight: 600;
        color: var(--text-1);
        margin-bottom: 7px;
    }
    #fp-email-input {
        width: 100%;
        padding: 12px 14px;
        border: 1.5px solid var(--border);
        border-radius: 10px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 14px;
        color: var(--text-1);
        transition: border-color 0.2s, box-shadow 0.2s;
        box-sizing: border-box;
    }
    #fp-email-input::placeholder { color: var(--text-3); }
    #fp-email-input:focus {
        outline: none;
        border-color: var(--blue);
        box-shadow: 0 0 0 3.5px var(--blue-glow);
    }
    #fp-success-box {
        display: none;
        background: #f0fff4;
        border: 1.5px solid #9ae6b4;
        border-radius: 10px;
        padding: 13px 16px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13.5px;
        color: var(--success);
        margin-bottom: 16px;
    }
    #fp-error-box {
        display: none;
        background: #fff5f5;
        border: 1.5px solid #feb2b2;
        border-radius: 10px;
        padding: 13px 16px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13.5px;
        color: var(--danger);
        margin-bottom: 16px;
    }
    #fpModal .modal-footer {
        background: #f8fafc;
        border-top: 1px solid var(--border);
        padding: 18px 28px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .fp-btn-cancel {
        padding: 9px 20px;
        background: var(--white);
        border: 1.5px solid var(--border);
        border-radius: 8px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13.5px;
        font-weight: 600;
        color: var(--text-2);
        cursor: pointer;
        transition: all 0.2s;
    }
    .fp-btn-cancel:hover { border-color: #c0cce0; color: var(--text-1); }
    .fp-btn-primary {
        padding: 9px 22px;
        background: linear-gradient(135deg, var(--blue), #0055cc);
        border: none;
        border-radius: 8px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13.5px;
        font-weight: 700;
        color: #fff;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 2px 10px rgba(0,102,255,0.25);
    }
    .fp-btn-primary:hover { box-shadow: 0 4px 18px rgba(0,102,255,0.38); transform: translateY(-1px); }
    .fp-btn-loading {
        display: none;
        padding: 9px 22px;
        background: var(--blue-light);
        color: var(--blue);
        border: 1.5px solid var(--blue-mid);
        border-radius: 8px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13.5px;
        font-weight: 700;
        cursor: not-allowed;
    }

    /* ── ANIMATIONS ── */
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeSlideDown {
        from { opacity: 0; transform: translateY(-14px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeSlideUp {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50%       { opacity: 0.6; transform: scale(0.88); }
    }

    @media (max-width: 900px) {
        .login-visual { display: none !important; }
        .login-content { width: 100vw; min-width: unset; padding: 40px 28px; }
    }
</style>

<body class="account-page">
<div class="main-wrapper">
<div class="account-content">
<div class="login-wrapper">

    <!-- ══ LEFT PANEL ══ -->
    <div class="login-content">
        <div class="login-userset">

            <!-- Logo: image + text inline -->
            <div class="login-logo">
                <div class="logo-img-wrap">
                    <img src="../assets/img/system/autoservice_logo.jpg" alt="Logo">
                </div>
                <span class="logo-text">autoservice<span>.lk</span></span>
            </div>

            <div class="login-userheading">
                <div class="heading-badge">
                    <span class="dot"></span> Station Portal
                </div>
                <h3>Welcome Back</h3>
                <h4>Sign in to manage your service station dashboard</h4>
            </div>

            <form id="loginForm" autocomplete="off">

                <div class="field-block">
                    <label for="email">Station Email</label>
                    <div class="field-wrap">
                        <input id="email" type="email" placeholder="station@example.com" required autocomplete="email">
                        <span class="field-icon"><i class="fas fa-envelope"></i></span>
                    </div>
                </div>

                <div class="field-block">
                    <label for="password">Password</label>
                    <div class="field-wrap">
                        <input id="password" type="password" class="pass-input" placeholder="••••••••" required autocomplete="current-password">
                        <span class="fas toggle-password fa-eye-slash"></span>
                    </div>
                </div>

                <div class="row-meta">
                    <a href="#" id="btn-forgot-password" class="forgot-link">Forgot password?</a>
                </div>

                <div class="recaptcha-wrap">
                    <div class="g-recaptcha" data-sitekey="6LeS1XMsAAAAABs89_XYKP-khhboHHiYY4KnHNLy"></div>
                </div>

                <button type="button" id="btn_station_login" class="btn-login">
                    Sign In to Dashboard &nbsp;→
                </button>
                <button type="button" id="btn-loading" class="btn-loading" disabled>
                    <span class="spinner-border spinner-border-sm mr-2" role="status"></span>
                    Authenticating…
                </button>

            </form>

            <div class="auth-footer">
                Don't have an account?
                <a href="../auth/station-register.php">Create Station Account →</a>
            </div>

        </div>
    </div>

    <!-- ══ RIGHT VISUAL ══ -->
    <div class="login-visual">
        <img src="../assets/img/system/login_station.jpg" alt="Station" id="visual-img">

        <!-- Natural dark scrim — no color tint -->
        <div class="visual-scrim"></div>

        <!-- Thin blue accent line on left edge -->
        <div class="visual-accent-bar"></div>

        <div class="visual-inner">
            <!-- Stat cards: top right -->
            <div class="visual-cards">
                <div class="vcard">
                    <div class="vcard-num">2,400+</div>
                    <div class="vcard-label">Service Stations</div>
                </div>
                <div class="vcard">
                    <div class="vcard-num">98.9%</div>
                    <div class="vcard-label">Platform Uptime</div>
                </div>
            </div>

            <!-- Caption: bottom left -->
            <div class="visual-bottom">
                <div class="vb-tag">Live Dashboard</div>
                <h2>Your Station.<br>One Platform.</h2>
                <p>Manage bookings, track inventory, and grow your service business — all in one place across Sri Lanka.</p>
                <div class="feature-list">
                    <div class="feat-item"><i class="fas fa-calendar-check"></i> Booking Management</div>
                    <div class="feat-item"><i class="fas fa-boxes"></i> Inventory Tracking</div>
                    <div class="feat-item"><i class="fas fa-chart-line"></i> Revenue Analytics</div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>

<!-- FORGOT PASSWORD MODAL -->
<div class="modal fade" id="fpModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:430px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-key mr-2"></i>Reset Station Password</h5>
                <button type="button" class="close" onclick="$('#fpModal').modal('hide')"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <p class="desc">Enter the email address linked to your station account and we'll send you a password reset link.</p>
                <div id="fp-success-box"><i class="fas fa-check-circle mr-2"></i><span id="fp-success-msg"></span></div>
                <div id="fp-error-box"><i class="fas fa-exclamation-circle mr-2"></i><span id="fp-error-msg"></span></div>
                <div id="fp-form-area">
                    <label for="fp-email-input">Station Email Address</label>
                    <input id="fp-email-input" type="email" placeholder="station@example.com">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="fp-btn-cancel" onclick="$('#fpModal').modal('hide')"><i class="fas fa-times mr-1"></i> Cancel</button>
                <div>
                    <button id="btn-fp-submit" type="button" class="fp-btn-primary" onclick="submitForgotPassword()">
                        <i class="fas fa-paper-plane mr-1"></i> Send Reset Link
                    </button>
                    <button id="btn-fp-loading" type="button" class="fp-btn-loading" disabled>
                        <span class="spinner-border spinner-border-sm mr-1"></span> Sending…
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once '../includes/auth-footer.php'; ?>

<script>
$(document).ready(function () {

    // Auto-scale the form panel to always fit within viewport height
    function scaleFormToFit() {
        var panel = document.querySelector('.login-content');
        var inner = document.querySelector('.login-userset');
        if (!panel || !inner) return;
        inner.style.transform = '';
        inner.style.marginTop = '';
        var panelH = panel.clientHeight - 48;
        var innerH = inner.scrollHeight;
        if (innerH > panelH) {
            var scale = panelH / innerH;
            inner.style.transform = 'scale(' + scale + ')';
            var shrink = innerH - (innerH * scale);
            inner.style.marginTop = '-' + (shrink / 2) + 'px';
        }
    }
    scaleFormToFit();
    $(window).on('resize', scaleFormToFit);


    $(document).on('click', '.toggle-password', function () {
        $(this).toggleClass('fa-eye fa-eye-slash');
        var input = $('.pass-input');
        input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
    });

    $('#email, #password').keypress(function (e) {
        if (e.which === 13) { e.preventDefault(); $('#btn_station_login').click(); }
    });

    $('#btn-forgot-password').on('click', function (e) {
        e.preventDefault();
        $('#fpModal').modal('show');
    });

    $('#fp-email-input').keypress(function (e) {
        if (e.which === 13) { e.preventDefault(); submitForgotPassword(); }
    });

    $('#fpModal').on('show.bs.modal', function () {
        $('#fp-email-input').val('');
        $('#fp-success-box, #fp-error-box').hide();
        $('#fp-form-area').show();
        $('#btn-fp-submit').show();
        $('#btn-fp-loading').hide();
    });

    // Subtle parallax on the photo
    $(document).on('mousemove', function (e) {
        var x = (e.clientX / window.innerWidth - 0.5) * 10;
        var y = (e.clientY / window.innerHeight - 0.5) * 10;
        $('#visual-img').css('transform', 'scale(1.06) translate(' + x + 'px, ' + y + 'px)');
    });
});

function submitForgotPassword() {
    var email = $('#fp-email-input').val().trim();
    if (!email) { showFpError('Please enter your email address.'); return; }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { showFpError('Please enter a valid email address.'); return; }

    $('#btn-fp-submit').hide();
    $('#btn-fp-loading').show();
    $('#fp-success-box, #fp-error-box').hide();

    $.ajax({
        url: '../api/forgot-password-station.php',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ email: email }),
        success: function (data) {
            $('#btn-fp-loading').hide();
            if (data.success) {
                $('#fp-form-area').hide();
                $('#fp-success-msg').text(data.message);
                $('#fp-success-box').show();
            } else {
                $('#btn-fp-submit').show();
                showFpError(data.message);
            }
        },
        error: function () {
            $('#btn-fp-loading').hide();
            $('#btn-fp-submit').show();
            showFpError('Something went wrong. Please try again.');
        }
    });
}

function showFpError(msg) {
    $('#fp-error-msg').text(msg);
    $('#fp-error-box').show();
}
</script>
</body>
</html>