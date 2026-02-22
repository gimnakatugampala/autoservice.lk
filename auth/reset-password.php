<?php
require_once '../includes/db_config.php';

// ── Validate token from URL ────────────────────────────────────────────────
$token       = trim($_GET['token'] ?? '');
$token_valid = false;
$employee_id = null;
$error_msg   = '';

if (empty($token)) {
    $error_msg = 'Invalid or missing reset token.';
} else {
    $token_hash = hash('sha256', $token);

    $stmt = $conn->prepare("
        SELECT employee_id, expires_at
        FROM employee_password_resets
        WHERE token_hash = ?
        LIMIT 1
    ");
    $stmt->bind_param("s", $token_hash);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$row) {
        $error_msg = 'This reset link is invalid. Please request a new one.';
    } elseif (strtotime($row['expires_at']) < time()) {
        $error_msg = 'This reset link has expired. Please request a new one.';
    } else {
        $token_valid = true;
        $employee_id = (int) $row['employee_id'];
    }
}

// ── Handle POST ────────────────────────────────────────────────────────────
$success_msg  = '';
$submit_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $token_valid) {
    $new_password     = $_POST['new_password']     ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (strlen($new_password) < 8) {
        $submit_error = 'Password must be at least 8 characters.';
    } elseif ($new_password !== $confirm_password) {
        $submit_error = 'Passwords do not match.';
    } else {
        $hashed = sha1($new_password);

        $stmt = $conn->prepare("UPDATE employee SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashed, $employee_id);
        $updated = $stmt->execute();
        $stmt->close();

        if ($updated) {
            $stmt = $conn->prepare("DELETE FROM employee_password_resets WHERE employee_id = ?");
            $stmt->bind_param("i", $employee_id);
            $stmt->execute();
            $stmt->close();

            $success_msg = 'Your password has been reset successfully. You can now sign in with your new password.';
            $token_valid = false;
        } else {
            $submit_error = 'Something went wrong updating your password. Please try again.';
        }
    }
}

include_once '../includes/header.php';
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --blue:       #007bff;
        --blue-dark:  #0056b3;
        --blue-light: #e8f2ff;
        --blue-mid:   #c5deff;
        --blue-glow:  rgba(0,123,255,0.18);
        --white:      #ffffff;
        --surface:    #f4f7fb;
        --border:     #e2e8f0;
        --text-1:     #0f1c2e;
        --text-2:     #4a5a72;
        --text-3:     #8a9bb5;
        --danger:     #e53e3e;
        --danger-bg:  #fff5f5;
        --danger-bdr: #feb2b2;
        --success:    #38a169;
        --success-bg: #f0fff4;
        --success-bdr:#9ae6b4;
        --warning:    #d69e2e;
        --warning-bg: #fffff0;
        --warning-bdr:#faf089;
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
        /* overflow: hidden; */
    }

    /* Background blobs */
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
    .reset-card {
        position: relative;
        z-index: 1;
        width: 420px;
        background: var(--white);
        border-radius: 20px;
        box-shadow: 0 8px 48px rgba(0,0,0,0.10), 0 1.5px 0 var(--border);
        padding: 40px 44px 36px;
        animation: slideUp 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    /* Top blue accent bar */
    .reset-card::before {
        content: '';
        position: absolute;
        top: 0; left: 44px; right: 44px;
        height: 3px;
        background: linear-gradient(90deg, var(--blue), #0062d6);
        border-radius: 0 0 4px 4px;
    }

    /* ── CARD BRAND HEADER ── */
    .card-brand {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 24px;
        padding-bottom: 22px;
        border-bottom: 1px solid var(--border);
    }

    .brand-icon-wrap {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        background: var(--blue-light);
        border: 2px solid var(--blue-mid);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 12px;
        box-shadow: 0 4px 16px rgba(0,123,255,0.12);
    }
    .brand-icon-wrap i {
        font-size: 24px;
        color: var(--blue);
    }

    .brand-title {
        font-size: 17px;
        font-weight: 800;
        color: var(--text-1);
        letter-spacing: -0.4px;
        margin-bottom: 5px;
        text-align: center;
    }

    .brand-badge {
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
    .brand-badge .dot {
        width: 5px; height: 5px;
        background: var(--blue);
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    /* ── HEADING ── */
    .reset-heading {
        margin-bottom: 18px;
    }
    .reset-heading h3 {
        font-size: 18px;
        font-weight: 800;
        color: var(--text-1);
        letter-spacing: -0.4px;
        margin: 0 0 4px;
    }
    .reset-heading p {
        font-size: 13px;
        color: var(--text-2);
        margin: 0;
        line-height: 1.5;
    }

    /* ── ALERT BOX ── */
    .alert-box {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        border-radius: 10px;
        padding: 11px 14px;
        font-size: 12.5px;
        font-weight: 500;
        line-height: 1.5;
        margin-bottom: 16px;
    }
    .alert-box i { font-size: 13px; margin-top: 1px; flex-shrink: 0; }
    .alert-box.danger  { background: var(--danger-bg);  border: 1.5px solid var(--danger-bdr);  color: var(--danger); }

    /* ── STATE SCREENS ── */
    .state-screen {
        text-align: center;
        padding: 8px 0 4px;
    }
    .state-icon-wrap {
        width: 72px; height: 72px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }
    .state-icon-wrap.success { background: var(--success-bg); border: 2px solid var(--success-bdr); }
    .state-icon-wrap.warning { background: var(--warning-bg); border: 2px solid var(--warning-bdr); }
    .state-icon-wrap i { font-size: 28px; }
    .state-icon-wrap.success i { color: var(--success); }
    .state-icon-wrap.warning i { color: var(--warning); }

    .state-title {
        font-size: 16px;
        font-weight: 800;
        color: var(--text-1);
        margin-bottom: 8px;
    }
    .state-desc {
        font-size: 13px;
        color: var(--text-2);
        line-height: 1.6;
        margin-bottom: 22px;
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
    .field-wrap input.input-valid   { border-color: var(--success); }
    .field-wrap input.input-invalid { border-color: var(--danger);  }

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

    /* ── STRENGTH BAR ── */
    .strength-bar-wrap {
        display: flex;
        gap: 4px;
        margin-top: 8px;
    }
    .strength-seg {
        flex: 1;
        height: 3px;
        border-radius: 100px;
        background: var(--border);
        transition: background 0.3s;
    }
    .strength-label {
        font-size: 11px;
        font-weight: 600;
        color: var(--text-3);
        margin-top: 5px;
        min-height: 14px;
        transition: color 0.3s;
    }

    /* ── MATCH MSG ── */
    .match-msg {
        font-size: 11.5px;
        font-weight: 600;
        margin-top: 6px;
        min-height: 16px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* ── SUBMIT BUTTON ── */
    .btn-submit {
        position: relative;
        width: 100%;
        padding: 12px 18px;
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
        margin-top: 4px;
        letter-spacing: 0.3px;
    }
    .btn-submit::after {
        content: '';
        position: absolute;
        top: 0; left: -100%; width: 60%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        transition: left 0.5s;
    }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,102,255,0.38); }
    .btn-submit:hover::after { left: 160%; }
    .btn-submit:active { transform: translateY(0); }

    /* ── CTA BUTTONS ── */
    .btn-primary-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 22px;
        background: linear-gradient(135deg, var(--blue), #0062d6);
        border-radius: 10px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 700;
        color: #fff;
        text-decoration: none;
        box-shadow: 0 4px 16px rgba(0,102,255,0.28);
        transition: all 0.2s;
    }
    .btn-primary-link:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,102,255,0.38); color: #fff; text-decoration: none; }

    .btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 22px;
        border: 1.5px solid var(--border);
        border-radius: 10px;
        background: var(--white);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-2);
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-outline:hover { border-color: var(--blue); color: var(--blue); text-decoration: none; }

    /* ── CARD FOOTER ── */
    .card-footer-link {
        margin-top: 20px;
        padding-top: 18px;
        border-top: 1px solid var(--border);
        text-align: center;
    }
    .card-footer-link a {
        font-size: 13px;
        font-weight: 600;
        color: var(--text-3);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: color 0.2s;
    }
    .card-footer-link a:hover { color: var(--blue); }

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
        .reset-card { width: 100%; margin: 16px; padding: 28px 24px 24px; box-sizing: border-box; }
    }
</style>

<body class="hold-transition login-page">

<div class="reset-card">

    <!-- Brand Header -->
    <div class="card-brand">
        <div class="brand-icon-wrap">
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="brand-title">Employee Password Reset</div>
        <div class="brand-badge">
            <span class="dot"></span>
            Secure Reset
        </div>
    </div>

    <?php if (!empty($success_msg)): ?>
    <!-- ✅ Success State -->
    <div class="state-screen">
        <div class="state-icon-wrap success">
            <i class="fas fa-check"></i>
        </div>
        <div class="state-title">Password Updated!</div>
        <p class="state-desc"><?php echo htmlspecialchars($success_msg); ?></p>
        <a href="../auth/user-login.php" class="btn-primary-link">
            <i class="fas fa-sign-in-alt"></i> Go to Sign In
        </a>
    </div>

    <?php elseif (!$token_valid): ?>
    <!-- ❌ Invalid / Expired Token State -->
    <div class="state-screen">
        <div class="state-icon-wrap warning">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="state-title">Link Unavailable</div>
        <p class="state-desc">
            <?php echo htmlspecialchars($error_msg); ?><br>
            Go back to login and use <strong>Forgot Password?</strong> to request a fresh link.
        </p>
        <a href="../auth/user-login.php" class="btn-outline">
            <i class="fas fa-arrow-left"></i> Back to Login
        </a>
    </div>

    <?php else: ?>
    <!-- 🔑 Reset Form -->
    <div class="reset-heading">
        <h3>Choose a New Password</h3>
        <p>Pick a strong, unique password for your employee account.</p>
    </div>

    <?php if (!empty($submit_error)): ?>
    <div class="alert-box danger">
        <i class="fas fa-exclamation-circle"></i>
        <?php echo htmlspecialchars($submit_error); ?>
    </div>
    <?php endif; ?>

    <form method="POST" action="?token=<?php echo urlencode($token); ?>" id="resetForm">

        <!-- New Password -->
        <div class="field-block">
            <label for="new_password">New Password</label>
            <div class="field-wrap">
                <input id="new_password" name="new_password" type="password"
                       placeholder="Min. 8 characters" required
                       oninput="checkStrength(this.value)">
                <span class="toggle-password" onclick="toggleVis('new_password', 'icon-np')">
                    <i class="fas fa-eye" id="icon-np"></i>
                </span>
            </div>
            <div class="strength-bar-wrap">
                <div class="strength-seg" id="seg1"></div>
                <div class="strength-seg" id="seg2"></div>
                <div class="strength-seg" id="seg3"></div>
                <div class="strength-seg" id="seg4"></div>
            </div>
            <div class="strength-label" id="strength-label"></div>
        </div>

        <!-- Confirm Password -->
        <div class="field-block">
            <label for="confirm_password">Confirm New Password</label>
            <div class="field-wrap">
                <input id="confirm_password" name="confirm_password" type="password"
                       placeholder="Re-enter your password" required
                       oninput="checkMatch()">
                <span class="toggle-password" onclick="toggleVis('confirm_password', 'icon-cp')">
                    <i class="fas fa-eye" id="icon-cp"></i>
                </span>
            </div>
            <div class="match-msg" id="match-msg"></div>
        </div>

        <button type="submit" class="btn-submit">
            <i class="fas fa-lock" style="margin-right:7px;"></i>Set New Password
        </button>

    </form>

    <div class="card-footer-link">
        <a href="../auth/user-login.php">
            <i class="fas fa-arrow-left"></i> Back to Login
        </a>
    </div>

    <?php endif; ?>

</div>

<script>
    function toggleVis(inputId, iconId) {
        const inp  = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (inp.type === 'password') {
            inp.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            inp.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    function checkStrength(val) {
        const colors = ['#e53e3e', '#dd6b20', '#d69e2e', '#38a169'];
        const labels = ['Weak', 'Fair', 'Good', 'Strong'];
        const segs   = ['seg1', 'seg2', 'seg3', 'seg4'];
        const label  = document.getElementById('strength-label');

        let score = 0;
        if (val.length >= 8)              score++;
        if (/[A-Z]/.test(val))            score++;
        if (/[0-9]/.test(val))            score++;
        if (/[^A-Za-z0-9]/.test(val))    score++;

        segs.forEach((id, i) => {
            document.getElementById(id).style.background =
                val.length === 0 ? 'var(--border)' :
                i < score        ? colors[score - 1] : 'var(--border)';
        });

        label.textContent = val.length ? (labels[score - 1] || '') : '';
        label.style.color = val.length ? colors[score - 1] : 'var(--text-3)';

        checkMatch();
    }

    function checkMatch() {
        const pwd  = document.getElementById('new_password').value;
        const conf = document.getElementById('confirm_password');
        const msg  = document.getElementById('match-msg');

        if (!conf.value) {
            msg.innerHTML = '';
            conf.classList.remove('input-valid', 'input-invalid');
            return;
        }
        if (conf.value === pwd) {
            msg.innerHTML = '<i class="fas fa-check-circle" style="color:var(--success);"></i><span style="color:var(--success);">Passwords match</span>';
            conf.classList.add('input-valid');
            conf.classList.remove('input-invalid');
        } else {
            msg.innerHTML = '<i class="fas fa-times-circle" style="color:var(--danger);"></i><span style="color:var(--danger);">Passwords do not match</span>';
            conf.classList.add('input-invalid');
            conf.classList.remove('input-valid');
        }
    }

    document.getElementById('resetForm')?.addEventListener('submit', function (e) {
        const pwd  = document.getElementById('new_password').value;
        const conf = document.getElementById('confirm_password').value;
        if (pwd !== conf) {
            e.preventDefault();
            checkMatch();
            document.getElementById('confirm_password').focus();
        }
    });
</script>

<?php include_once '../includes/footer.php'; ?>
</body>
</html>