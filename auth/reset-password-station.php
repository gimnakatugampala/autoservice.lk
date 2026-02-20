<?php
require_once '../includes/db_config.php';

// ── Validate token from URL ────────────────────────────────────────────────
$token       = trim($_GET['token'] ?? '');
$token_valid = false;
$station_id  = null;
$error_msg   = '';

if (empty($token)) {
    $error_msg = 'Invalid or missing reset token.';
} else {
    $token_hash = hash('sha256', $token);

    $stmt = $conn->prepare("
        SELECT station_id, expires_at
        FROM station_password_resets
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
        $station_id  = (int) $row['station_id'];
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
        // SHA1 — matches the existing auth system
        $hashed = sha1($new_password);

        $stmt = $conn->prepare("UPDATE service_station SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashed, $station_id);
        $updated = $stmt->execute();
        $stmt->close();

        if ($updated) {
            // Delete used token
            $stmt = $conn->prepare("DELETE FROM station_password_resets WHERE station_id = ?");
            $stmt->bind_param("i", $station_id);
            $stmt->execute();
            $stmt->close();

            $success_msg = 'Your password has been reset successfully. You can now sign in with your new password.';
            $token_valid = false;
        } else {
            $submit_error = 'Something went wrong. Please try again.';
        }
    }
}

include_once '../includes/auth-header.php';
?>

<style>
    :root { --primary-blue: #007bff; }

    body.account-page {
        background-color: #f8f9fa;
        font-family: 'Inter', sans-serif;
    }
    .reset-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 16px;
    }
    .reset-box {
        width: 100%;
        max-width: 430px;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        overflow: hidden;
        animation: fadeInUp 0.6s ease-out;
    }
    .reset-header {
        background: var(--primary-blue);
        padding: 28px 32px;
        text-align: center;
    }
    .reset-header h4 {
        color: #fff;
        font-weight: 700;
        margin: 0;
        font-size: 20px;
    }
    .reset-body { padding: 32px; }

    .form-login label {
        font-weight: 600;
        font-size: 14px;
        color: #444;
        margin-bottom: 8px;
        display: block;
    }
    .pass-group { position: relative; margin-bottom: 4px; }
    .pass-group input {
        width: 100%;
        padding: 12px 45px 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        transition: all 0.3s;
        font-size: 14px;
    }
    .pass-group input:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
        outline: none;
    }
    .toggle-password {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #999;
        font-size: 15px;
    }
    .btn-reset {
        background: var(--primary-blue);
        color: #fff;
        width: 100%;
        padding: 12px;
        font-weight: 700;
        border-radius: 8px;
        border: none;
        margin-top: 8px;
        transition: background 0.3s, transform 0.2s;
        font-size: 15px;
    }
    .btn-reset:hover {
        background: #0056b3;
        transform: translateY(-1px);
    }
    .back-link {
        display: block;
        text-align: center;
        margin-top: 18px;
        font-size: 13px;
        color: #999;
        text-decoration: none;
    }
    .back-link:hover { color: var(--primary-blue); }

    /* Strength bar */
    #strength-bar-wrap { height: 5px; border-radius: 3px; background: #e9ecef; margin-top: 7px; overflow: hidden; }
    #strength-bar      { height: 100%; width: 0; border-radius: 3px; transition: width 0.3s, background 0.3s; }
    #strength-label    { font-size: 11px; color: #aaa; margin-top: 4px; }
    #match-msg         { font-size: 11px; margin-top: 4px; min-height: 16px; }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>

<body class="account-page">
<div class="reset-wrapper">
    <div class="reset-box">

        <div class="reset-header">
            <i class="fas fa-shield-alt fa-2x mb-2" style="color:rgba(255,255,255,0.85);"></i>
            <h4>Reset Station Password</h4>
        </div>

        <div class="reset-body">

            <?php if (!empty($success_msg)): ?>
            <!-- ✅ Success -->
            <div class="text-center py-2">
                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                <p class="font-weight-bold text-success mb-4"><?php echo htmlspecialchars($success_msg); ?></p>
                <a href="../auth/station-login.php" class="btn-reset" style="display:inline-block; text-decoration:none; padding: 12px 32px; width:auto;">
                    <i class="fas fa-sign-in-alt mr-1"></i> Go to Login
                </a>
            </div>

            <?php elseif (!$token_valid): ?>
            <!-- ❌ Invalid / expired -->
            <div class="text-center py-2">
                <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                <p class="font-weight-bold text-danger"><?php echo htmlspecialchars($error_msg); ?></p>
                <p class="text-muted small mb-4">
                    Go back to the login page and use <strong>Forgot Password?</strong> to request a new link.
                </p>
                <a href="../auth/station-login.php" class="btn-reset" style="display:inline-block; text-decoration:none; padding:12px 32px; width:auto;">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Login
                </a>
            </div>

            <?php else: ?>
            <!-- 🔑 Reset form -->
            <p class="text-muted small mb-4">Choose a strong new password for your station account.</p>

            <?php if (!empty($submit_error)): ?>
            <div class="alert alert-danger py-2 mb-3">
                <i class="fas fa-exclamation-circle mr-1"></i>
                <?php echo htmlspecialchars($submit_error); ?>
            </div>
            <?php endif; ?>

            <form method="POST" action="?token=<?php echo urlencode($token); ?>" id="resetForm">

                <!-- New Password -->
                <div class="form-login mb-3">
                    <label for="new_password">New Password</label>
                    <div class="pass-group">
                        <input id="new_password" name="new_password" type="password"
                               placeholder="Min. 8 characters" required
                               oninput="checkStrength(this.value)">
                        <span class="fas fa-eye-slash toggle-password" onclick="toggleVis('new_password', this)"></span>
                    </div>
                    <div id="strength-bar-wrap"><div id="strength-bar"></div></div>
                    <div id="strength-label">Enter a password</div>
                </div>

                <!-- Confirm Password -->
                <div class="form-login mb-4">
                    <label for="confirm_password">Confirm New Password</label>
                    <div class="pass-group">
                        <input id="confirm_password" name="confirm_password" type="password"
                               placeholder="Re-enter your password" required
                               oninput="checkMatch()">
                        <span class="fas fa-eye-slash toggle-password" onclick="toggleVis('confirm_password', this)"></span>
                    </div>
                    <div id="match-msg"></div>
                </div>

                <button type="submit" class="btn-reset">
                    <i class="fas fa-save mr-1"></i> Set New Password
                </button>
            </form>

            <a href="../auth/station-login.php" class="back-link">
                <i class="fas fa-arrow-left mr-1"></i> Back to Login
            </a>

            <?php endif; ?>

        </div>
    </div>
</div>

<script>
    function toggleVis(inputId, icon) {
        var inp = document.getElementById(inputId);
        if (inp.type === 'password') {
            inp.type = 'text';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        } else {
            inp.type = 'password';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        }
    }

    function checkStrength(val) {
        var bar   = document.getElementById('strength-bar');
        var label = document.getElementById('strength-label');
        var score = 0;
        if (val.length >= 8)           score++;
        if (/[A-Z]/.test(val))         score++;
        if (/[0-9]/.test(val))         score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        var levels = [
            { w: '0%',    color: '#dee2e6', text: 'Enter a password' },
            { w: '25%',   color: '#dc3545', text: 'Weak' },
            { w: '50%',   color: '#fd7e14', text: 'Fair' },
            { w: '75%',   color: '#ffc107', text: 'Good' },
            { w: '100%',  color: '#28a745', text: 'Strong' }
        ];
        var lvl = val.length === 0 ? 0 : Math.min(score, 4);
        bar.style.width      = levels[lvl].w;
        bar.style.background = levels[lvl].color;
        label.textContent    = levels[lvl].text;
        label.style.color    = levels[lvl].color;
        checkMatch();
    }

    function checkMatch() {
        var pwd  = document.getElementById('new_password').value;
        var conf = document.getElementById('confirm_password').value;
        var msg  = document.getElementById('match-msg');
        if (!conf) { msg.textContent = ''; return; }
        if (conf === pwd) {
            msg.textContent = '✓ Passwords match';
            msg.style.color = '#28a745';
        } else {
            msg.textContent = '✗ Passwords do not match';
            msg.style.color = '#dc3545';
        }
    }

    document.getElementById('resetForm')?.addEventListener('submit', function (e) {
        var pwd  = document.getElementById('new_password').value;
        var conf = document.getElementById('confirm_password').value;
        if (pwd !== conf) {
            e.preventDefault();
            checkMatch();
            document.getElementById('confirm_password').focus();
        }
    });
</script>

<?php include_once '../includes/auth-footer.php'; ?>
</body>
</html>