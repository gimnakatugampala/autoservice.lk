<?php include_once '../includes/header.php';?>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --blue:        #007bff;
        --blue-dark:   #0056b3;
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

    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body.login-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--surface);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    /* Soft background blobs */
    body.login-page::before {
        content: '';
        position: fixed;
        top: -120px; left: -120px;
        width: 480px; height: 480px;
        background: radial-gradient(circle, var(--blue-light) 0%, transparent 70%);
        pointer-events: none;
        z-index: 0;
    }
    body.login-page::after {
        content: '';
        position: fixed;
        bottom: -100px; right: -100px;
        width: 380px; height: 380px;
        background: radial-gradient(circle, var(--blue-light) 0%, transparent 70%);
        pointer-events: none;
        z-index: 0;
    }

    /* ── CARD ── */
    .emp-card {
        position: relative;
        z-index: 1;
        width: 420px;
        background: var(--white);
        border-radius: 20px;
        box-shadow: 0 8px 48px rgba(0,0,0,0.10), 0 1.5px 0 var(--border);
        padding: 40px 44px 36px;
        animation: slideUp 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    /* Top blue accent line */
    .emp-card::before {
        content: '';
        position: absolute;
        top: 0; left: 44px; right: 44px;
        height: 3px;
        background: linear-gradient(90deg, var(--blue), #0062d6);
        border-radius: 0 0 4px 4px;
    }

    /* ── STATION BRANDING ── */
    .station-brand {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 28px;
        padding-bottom: 24px;
        border-bottom: 1px solid var(--border);
    }

    .station-logo-wrap {
        width: 72px;
        height: 72px;
        border-radius: 18px;
        overflow: hidden;
        border: 2.5px solid var(--border);
        box-shadow: 0 4px 16px rgba(0,0,0,0.10);
        margin-bottom: 12px;
        flex-shrink: 0;
    }
    .station-logo-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .station-name {
        font-size: 16px;
        font-weight: 800;
        color: var(--text-1);
        letter-spacing: -0.4px;
        text-align: center;
        line-height: 1.2;
        margin-bottom: 4px;
    }

    .station-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: var(--blue-light);
        color: var(--blue);
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        padding: 3px 10px;
        border-radius: 100px;
    }
    .station-badge .dot {
        width: 5px; height: 5px;
        background: var(--blue);
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    /* ── HEADING ── */
    .emp-heading {
        margin-bottom: 22px;
    }
    .emp-heading h3 {
        font-size: 20px;
        font-weight: 800;
        color: var(--text-1);
        letter-spacing: -0.5px;
        margin-bottom: 4px;
        line-height: 1.2;
    }
    .emp-heading p {
        font-size: 13px;
        color: var(--text-2);
        font-weight: 400;
        margin: 0;
    }

    /* ── FIELDS ── */
    .field-block { margin-bottom: 14px; }

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
        padding: 11px 40px 11px 14px;
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
    .field-wrap input::placeholder { color: var(--text-3); }
    .field-wrap input:focus {
        outline: none;
        border-color: var(--blue);
        background: #fafcff;
        box-shadow: 0 0 0 3px var(--blue-glow);
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

    /* ── ROW: remember + button ── */
    .form-row-action {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 6px;
        gap: 12px;
    }

    .remember-wrap {
        display: flex;
        align-items: center;
        gap: 7px;
        flex-shrink: 0;
    }
    .remember-wrap input[type="checkbox"] {
        width: 15px; height: 15px;
        accent-color: var(--blue);
        cursor: pointer;
    }
    .remember-wrap label {
        font-size: 12.5px;
        color: var(--text-2);
        font-weight: 500;
        cursor: pointer;
        margin: 0;
        white-space: nowrap;
    }

    /* ── SIGN IN BUTTON ── */
    .btn-login {
        position: relative;
        flex: 1;
        padding: 11px 18px;
        background: linear-gradient(135deg, var(--blue) 0%, #0062d6 100%);
        color: #fff;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13.5px;
        font-weight: 700;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        overflow: hidden;
        transition: transform 0.18s, box-shadow 0.18s;
        box-shadow: 0 4px 16px rgba(0,102,255,0.28);
        white-space: nowrap;
    }
    .btn-login::after {
        content: '';
        position: absolute;
        top: 0; left: -100%; width: 60%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        transition: left 0.5s;
    }
    .btn-login:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,102,255,0.38); }
    .btn-login:hover::after { left: 160%; }
    .btn-login:active { transform: translateY(0); }

    .btn-loading-state {
        display: none;
        flex: 1;
        padding: 11px 18px;
        background: var(--blue-light);
        color: var(--blue);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13.5px;
        font-weight: 700;
        border: 1.5px solid var(--blue-mid);
        border-radius: 10px;
        cursor: not-allowed;
        white-space: nowrap;
        text-align: center;
    }

    /* ── LINKS ── */
    .emp-links {
        margin-top: 20px;
        padding-top: 18px;
        border-top: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        gap: 8px;
        align-items: center;
    }

    .emp-links a {
        font-size: 13px;
        font-weight: 600;
        color: var(--blue);
        text-decoration: none;
        transition: color 0.2s;
    }
    .emp-links a:hover { color: var(--blue-dark); text-decoration: underline; }

    .emp-links .switch-link {
        font-size: 12.5px;
        font-weight: 400;
        color: var(--text-3);
    }
    .emp-links .switch-link a {
        font-weight: 600;
        color: var(--text-2);
    }
    .emp-links .switch-link a:hover { color: var(--text-1); }

    /* ── MODAL ── */
    #forgotPasswordModal { z-index: 99999 !important; }
    .modal-backdrop { z-index: 99998 !important; }

    #forgotPasswordModal .modal-content {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 24px 64px rgba(0,0,0,0.18);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    #forgotPasswordModal .modal-header {
        background: linear-gradient(135deg, var(--blue) 0%, #0055cc 100%);
        border-bottom: none;
        padding: 20px 26px;
    }
    #forgotPasswordModal .modal-title {
        font-size: 16px;
        font-weight: 700;
        color: #fff;
    }
    #forgotPasswordModal .modal-header .close {
        color: rgba(255,255,255,0.8);
        opacity: 1;
        font-size: 20px;
        transition: color 0.2s;
    }
    #forgotPasswordModal .modal-header .close:hover { color: #fff; }

    #forgotPasswordModal .modal-body {
        padding: 22px 26px;
        background: #fff;
    }
    #forgotPasswordModal .modal-body p {
        font-size: 13px;
        color: var(--text-2);
        line-height: 1.6;
        margin-bottom: 16px;
    }
    #forgotPasswordModal label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: var(--text-1);
        margin-bottom: 6px;
    }
    #fp-email {
        width: 100%;
        padding: 11px 14px;
        border: 1.5px solid var(--border);
        border-radius: 10px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13.5px;
        color: var(--text-1);
        transition: border-color 0.2s, box-shadow 0.2s;
        box-sizing: border-box;
    }
    #fp-email::placeholder { color: var(--text-3); }
    #fp-email:focus {
        outline: none;
        border-color: var(--blue);
        box-shadow: 0 0 0 3px var(--blue-glow);
    }

    #fp-success-box {
        display: none;
        background: #f0fff4;
        border: 1.5px solid #9ae6b4;
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 13px;
        color: var(--success);
        margin-bottom: 14px;
    }
    #fp-error-box {
        display: none;
        background: #fff5f5;
        border: 1.5px solid #feb2b2;
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 13px;
        color: var(--danger);
        margin-bottom: 14px;
    }

    #forgotPasswordModal .modal-footer {
        background: #f8fafc;
        border-top: 1px solid var(--border);
        padding: 16px 26px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .fp-btn-cancel {
        padding: 8px 18px;
        background: var(--white);
        border: 1.5px solid var(--border);
        border-radius: 8px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-2);
        cursor: pointer;
        transition: all 0.2s;
    }
    .fp-btn-cancel:hover { border-color: #c0cce0; color: var(--text-1); }

    .fp-btn-primary {
        padding: 8px 20px;
        background: linear-gradient(135deg, var(--blue), #0055cc);
        border: none;
        border-radius: 8px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 700;
        color: #fff;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 2px 10px rgba(0,102,255,0.25);
    }
    .fp-btn-primary:hover { box-shadow: 0 4px 16px rgba(0,102,255,0.38); transform: translateY(-1px); }

    .fp-btn-loading {
        display: none;
        padding: 8px 20px;
        background: var(--blue-light);
        color: var(--blue);
        border: 1.5px solid var(--blue-mid);
        border-radius: 8px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 700;
        cursor: not-allowed;
    }

    /* ── ANIMATIONS ── */
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50%       { opacity: 0.6; transform: scale(0.88); }
    }

    @media (max-width: 480px) {
        .emp-card { width: 100%; margin: 16px; padding: 28px 24px 24px; box-sizing: border-box; }
    }
</style>

<body class="login-page">

    <div class="emp-card">

        <!-- Station Branding -->
        <div class="station-brand">
            <div class="station-logo-wrap">
                <img src="<?php echo (isset($_SESSION['station_img'])) ? '../uploads/stations/' . $_SESSION['station_img'] : '../assets/img/no-image.png'; ?>"
                     alt="Station Logo">
            </div>
            <div class="station-name"><?php echo htmlspecialchars($_SESSION['station_name'] ?? 'Service Station'); ?></div>
            <div class="station-badge"><span class="dot"></span> Employee Portal</div>
        </div>

        <!-- Heading -->
        <div class="emp-heading">
            <h3>Welcome Back</h3>
            <p>Sign in to access your workspace</p>
        </div>

        <!-- Form -->
        <form id="employeeLoginForm" autocomplete="off">

            <div class="field-block">
                <label for="email">Email Address</label>
                <div class="field-wrap">
                    <input id="email" type="email" placeholder="name@station.com" required autocomplete="email">
                    <span class="field-icon"><i class="fas fa-envelope"></i></span>
                </div>
            </div>

            <div class="field-block">
                <label for="password">Password</label>
                <div class="field-wrap">
                    <input id="password" type="password" placeholder="••••••••" required autocomplete="current-password">
                    <span class="toggle-password" onclick="toggleEmployeePass()">
                        <i class="fas fa-eye-slash" id="eye-icon"></i>
                    </span>
                </div>
            </div>

            <div class="form-row-action">
                <div class="remember-wrap">
                    <input type="checkbox" id="remember">
                    <label for="remember">Remember Me</label>
                </div>
                <button id="btn_user_login" type="button" class="btn-login">
                    Sign In &nbsp;→
                </button>
                <button id="btn-loading" type="button" class="btn-loading-state" disabled>
                    <span class="spinner-border spinner-border-sm mr-1" role="status"></span> Wait…
                </button>
            </div>

        </form>

        <!-- Links -->
        <div class="emp-links">
            <a href="#" data-toggle="modal" data-target="#forgotPasswordModal">
                <i class="fas fa-key mr-1"></i> Forgot Password?
            </a>
            <span class="switch-link">Not an employee? <a href="../auth/station-login.php">Station Login →</a></span>
        </div>

    </div>

    <!-- FORGOT PASSWORD MODAL -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:420px;">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-key mr-2"></i>Reset Password</h5>
                    <button type="button" class="close" onclick="$('#forgotPasswordModal').modal('hide')"><span>&times;</span></button>
                </div>

                <div class="modal-body">
                    <p>Enter your registered email and we'll send you a link to reset your password.</p>
                    <div id="fp-success-box"><i class="fas fa-check-circle mr-2"></i><span id="fp-success-msg"></span></div>
                    <div id="fp-error-box"><i class="fas fa-exclamation-circle mr-2"></i><span id="fp-error-msg"></span></div>
                    <div id="fp-form-area">
                        <label for="fp-email">Email Address</label>
                        <input id="fp-email" type="email" placeholder="name@station.com">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="fp-btn-cancel" onclick="$('#forgotPasswordModal').modal('hide')">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </button>
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

<?php include_once '../includes/footer.php';?>

<script>
    function toggleEmployeePass() {
        var input = document.getElementById('password');
        var icon  = document.getElementById('eye-icon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Enter key → submit
        ['email','password'].forEach(function(id) {
            document.getElementById(id).addEventListener('keypress', function(e) {
                if (e.key === 'Enter') { e.preventDefault(); document.getElementById('btn_user_login').click(); }
            });
        });

        // Reset modal on open
        document.getElementById('forgotPasswordModal').addEventListener('show.bs.modal', function () {
            document.getElementById('fp-email').value = '';
            document.getElementById('fp-success-box').style.display = 'none';
            document.getElementById('fp-error-box').style.display   = 'none';
            document.getElementById('fp-form-area').style.display   = 'block';
            document.getElementById('btn-fp-submit').style.display  = 'inline-block';
            document.getElementById('btn-fp-loading').style.display = 'none';
        });

        // Enter in modal email
        document.getElementById('fp-email').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') { e.preventDefault(); submitForgotPassword(); }
        });
    });

    function submitForgotPassword() {
        var email = document.getElementById('fp-email').value.trim();
        if (!email) { showFpError('Please enter your email address.'); return; }
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { showFpError('Please enter a valid email address.'); return; }

        document.getElementById('btn-fp-submit').style.display  = 'none';
        document.getElementById('btn-fp-loading').style.display = 'inline-block';
        document.getElementById('fp-success-box').style.display = 'none';
        document.getElementById('fp-error-box').style.display   = 'none';

        fetch('../api/forgot-password.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email: email })
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            document.getElementById('btn-fp-loading').style.display = 'none';
            if (data.success) {
                document.getElementById('fp-form-area').style.display   = 'none';
                document.getElementById('fp-success-msg').textContent   = data.message;
                document.getElementById('fp-success-box').style.display = 'block';
            } else {
                document.getElementById('btn-fp-submit').style.display = 'inline-block';
                showFpError(data.message);
            }
        })
        .catch(function() {
            document.getElementById('btn-fp-loading').style.display = 'none';
            document.getElementById('btn-fp-submit').style.display  = 'inline-block';
            showFpError('Something went wrong. Please try again.');
        });
    }

    function showFpError(msg) {
        document.getElementById('fp-error-msg').textContent   = msg;
        document.getElementById('fp-error-box').style.display = 'block';
    }
</script>
</body>
</html>