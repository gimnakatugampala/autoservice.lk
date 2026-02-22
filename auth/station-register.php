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
       LEFT VISUAL PANEL
    ══════════════════════════ */
    .login-visual {
        flex: 1;
        position: relative;
        overflow: hidden;
        height: 100vh;
        background: #111;
    }

    .login-visual img {
        position: absolute;
        inset: 0;
        width: 100%; height: 100%;
        object-fit: cover;
        display: block;
        opacity: 0.75;
        transition: transform 0.1s linear;
    }

    .visual-scrim {
        position: absolute; inset: 0;
        background:
            linear-gradient(to top,  rgba(0,0,0,0.82) 0%, rgba(0,0,0,0.15) 55%, transparent 100%),
            linear-gradient(to left, rgba(0,0,0,0.35) 0%, transparent 40%);
    }

    .visual-accent-bar {
        position: absolute;
        top: 0; right: 0;
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

    .visual-cards {
        display: flex;
        flex-direction: column;
        gap: 12px;
        align-self: flex-start;
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
    .vcard-label { font-size: 11.5px; color: rgba(255,255,255,0.5); }

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
    .feat-item i { color: #333e42; font-size: 12px; }

    /* ══════════════════════════
       RIGHT FORM PANEL
    ══════════════════════════ */
    .login-content {
        position: relative;
        width: 500px;
        min-width: 500px;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: stretch;
        padding: 36px 52px;
        background: var(--white);
        border-left: 1px solid var(--border);
        overflow-y: auto;
        overflow-x: hidden;
        z-index: 2;
        box-shadow: -6px 0 40px rgba(0,0,0,0.07);
        box-sizing: border-box;
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none; /* IE */
    }
    /* Hide scrollbar for Chrome/Safari */
    .login-content::-webkit-scrollbar { display: none; }

    .login-content::before {
        content: '';
        position: absolute;
        top: -80px; left: -100px;
        width: 280px; height: 280px;
        background: radial-gradient(circle, var(--blue-light) 0%, transparent 70%);
        pointer-events: none;
    }
    .login-content::after {
        content: '';
        position: absolute;
        bottom: -60px; right: -50px;
        width: 200px; height: 200px;
        background: radial-gradient(circle, var(--blue-light) 0%, transparent 70%);
        pointer-events: none;
    }

    .login-userset {
        position: relative;
        z-index: 1;
        width: 100%;
        animation: slideIn 0.6s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    /* ── LOGO ── */
    .login-logo {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        flex-wrap: nowrap !important;
        gap: 10px;
        margin-bottom: 20px;
        margin-top: 70px;
    }

    .logo-text {
        display: inline !important;
        font-size: 15.5px !important;
        font-weight: 800 !important;
        color: var(--text-1) !important;
        letter-spacing: -0.4px;
        white-space: nowrap !important;
        line-height: 1;
    }
    .logo-text span { color: var(--blue) !important; }

    /* ── HEADING ── */
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
        font-size: 22px;
        font-weight: 800;
        color: var(--text-1);
        letter-spacing: -0.6px;
        line-height: 1.2;
        margin-bottom: 4px;
    }
    .login-userheading h4 {
        font-size: 13px;
        font-weight: 400;
        color: var(--text-2);
        line-height: 1.5;
        margin-bottom: 18px;
    }

    /* ── FIELDS ── */
    .field-block { margin-bottom: 12px; }

    .field-block label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: var(--text-1);
        margin-bottom: 5px;
    }

    .field-wrap { position: relative; }

    .field-wrap input {
        width: 100%;
        padding: 10px 38px 10px 13px;
        border: 1.5px solid var(--border);
        border-radius: 10px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13.5px;
        color: var(--text-1);
        background: var(--white);
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        -webkit-appearance: none;
        box-sizing: border-box;
    }
    .field-wrap input[type="file"] {
        padding: 9px 13px;
        color: var(--text-2);
        font-size: 13px;
    }
    .field-wrap input[type="file"]::-webkit-file-upload-button {
        background: var(--blue-light);
        color: var(--blue);
        border: none;
        padding: 4px 10px;
        border-radius: 6px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        margin-right: 10px;
        transition: background 0.2s;
    }
    .field-wrap input[type="file"]::-webkit-file-upload-button:hover {
        background: var(--blue-mid);
    }
    .field-wrap input::placeholder { color: var(--text-3); }
    .field-wrap input:focus {
        outline: none;
        border-color: var(--blue);
        background: #fafcff;
        box-shadow: 0 0 0 3px var(--blue-glow);
    }

    .field-icon {
        position: absolute;
        right: 12px; top: 50%;
        transform: translateY(-50%);
        color: var(--text-3);
        font-size: 13px;
        pointer-events: none;
    }

    .toggle-password {
        position: absolute;
        right: 12px; top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: var(--text-3);
        font-size: 13px;
        transition: color 0.2s;
    }
    .toggle-password:hover { color: var(--blue); }

    /* ── TWO COLUMN ROW ── */
    .field-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 12px;
    }
    .field-row .field-block { margin-bottom: 0; }

    /* ── RECAPTCHA ── */
    .recaptcha-wrap {
        margin-bottom: 12px;
        transform: scale(0.85);
        transform-origin: left center;
    }

    /* ── BUTTONS ── */
    .btn-login {
        position: relative;
        width: 100%;
        padding: 12px 20px;
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
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .btn-login::after {
        content: '';
        position: absolute;
        top: 0; left: -100%; width: 60%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        transition: left 0.5s;
    }
    .btn-login:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(0,102,255,0.38); color: #fff; }
    .btn-login:hover::after { left: 160%; }
    .btn-login:active { transform: translateY(0); }

    .btn-loading {
        display: none;
        width: 100%;
        padding: 12px 20px;
        background: var(--blue-light);
        color: var(--blue);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 14px;
        font-weight: 700;
        border: 1.5px solid var(--blue-mid);
        border-radius: 10px;
        cursor: not-allowed;
        box-sizing: border-box;
        display: none;
        align-items: center;
        justify-content: center;
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
        .login-content { width: 100vw; min-width: unset; padding: 0 28px; }
        .field-row { grid-template-columns: 1fr; }
    }
</style>

<body class="account-page">
<div class="main-wrapper">
<div class="account-content">
<div class="login-wrapper">

    <!-- ══ LEFT VISUAL ══ -->
    <div class="login-visual">
        <img src="../assets/img/system/station_register.jpg" alt="Register" id="visual-img">
        <div class="visual-scrim"></div>
        <div class="visual-accent-bar"></div>

        <div class="visual-inner">
            <div class="visual-cards">
                <div class="vcard">
                    <div class="vcard-num">Free</div>
                    <div class="vcard-label">To Register</div>
                </div>
                <div class="vcard">
                    <div class="vcard-num">5 min</div>
                    <div class="vcard-label">Setup Time</div>
                </div>
            </div>

            <div class="visual-bottom">
                <div class="vb-tag">Get Started</div>
                <h2>Join the Network.<br>Grow Your Station.</h2>
                <p>Register your service station and start managing bookings, inventory, and revenue — all from one dashboard.</p>
                <div class="feature-list">
                    <div class="feat-item"><i class="fas fa-calendar-check"></i> Smart Bookings</div>
                    <div class="feat-item"><i class="fas fa-boxes"></i> Inventory Control</div>
                    <div class="feat-item"><i class="fas fa-chart-line"></i> Live Analytics</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ══ RIGHT FORM ══ -->
    <div class="login-content">
        <div class="login-userset">

            <div class="login-logo">
                <img src="../assets/img/system/autoservice_logo.jpg" alt="Logo"
                     style="width:38px!important;height:38px!important;min-width:38px!important;min-height:38px!important;border-radius:9px;object-fit:cover!important;display:inline-block!important;flex-shrink:0;border:1.5px solid #e2e8f0;box-shadow:0 2px 8px rgba(0,0,0,0.08);float:none!important;max-width:38px!important;">
                <span class="logo-text">autoservice<span>.lk</span></span>
            </div>

            <div class="login-userheading">
                <div class="heading-badge">
                    <span class="dot"></span> New Station
                </div>
                <h3>Create an Account</h3>
                <h4>Register your service station to get started</h4>
            </div>

            <form id="stationRegisterForm" enctype="multipart/form-data">

                <div class="field-block">
                    <label for="station_name">Service Station Name</label>
                    <div class="field-wrap">
                        <input id="station_name" type="text" placeholder="e.g. Elite Auto Care" required>
                        <span class="field-icon"><i class="fas fa-building"></i></span>
                    </div>
                </div>

                <div class="field-block">
                    <label for="station_logo">Station Logo</label>
                    <div class="field-wrap">
                        <input id="station_logo" type="file" accept="image/*" required>
                    </div>
                </div>

                <div class="field-block">
                    <label for="email">Business Email Address</label>
                    <div class="field-wrap">
                        <input id="email" type="email" placeholder="contact@station.com" required>
                        <span class="field-icon"><i class="fas fa-envelope"></i></span>
                    </div>
                </div>

                <div class="field-row">
                    <div class="field-block">
                        <label for="password">Password</label>
                        <div class="field-wrap">
                            <input id="password" type="password" class="pass-input" placeholder="••••••••" required>
                            <span class="fas toggle-password fa-eye-slash"></span>
                        </div>
                    </div>
                    <div class="field-block">
                        <label for="con_password">Confirm Password</label>
                        <div class="field-wrap">
                            <input id="con_password" type="password" class="pass-input" placeholder="••••••••" required>
                            <span class="fas toggle-password fa-eye-slash"></span>
                        </div>
                    </div>
                </div>

                <div class="recaptcha-wrap">
                    <div class="g-recaptcha" data-sitekey="6LeS1XMsAAAAABs89_XYKP-khhboHHiYY4KnHNLy"></div>
                </div>

                <button type="button" id="station_register_btn" class="btn-login">
                    Create Station Account &nbsp;→
                </button>
                <button type="button" id="btn-loading" class="btn-loading" disabled>
                    <span class="spinner-border spinner-border-sm mr-2" role="status"></span>
                    Processing…
                </button>

            </form>

            <div class="auth-footer">
                Already have a station?
                <a href="../auth/station-login.php">Sign In →</a>
            </div>

        </div>
    </div>

</div>
</div>
</div>

<?php include_once '../includes/auth-footer.php'; ?>
<script src="../assets/js/station_register.js"></script>

<script>
$(document).ready(function () {

    // Password toggle
    $(document).on('click', '.toggle-password', function () {
        $(this).toggleClass('fa-eye fa-eye-slash');
        var input = $(this).siblings('.pass-input');
        input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
    });

    // Enter key → submit
    $('#stationRegisterForm input').keypress(function (e) {
        if (e.which === 13) {
            e.preventDefault();
            $('#station_register_btn').click();
        }
    });

    // Subtle parallax
    $(document).on('mousemove', function (e) {
        var x = (e.clientX / window.innerWidth - 0.5) * 10;
        var y = (e.clientY / window.innerHeight - 0.5) * 10;
        $('#visual-img').css('transform', 'scale(1.06) translate(' + x + 'px, ' + y + 'px)');
    });
});
</script>
</body>
</html>