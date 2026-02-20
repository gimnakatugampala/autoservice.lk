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

// ── Handle POST (new password submission) ──────────────────────────────────
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
        // ── SHA1 to match the existing auth system in this project ──────────
        $hashed = sha1($new_password);

        $stmt = $conn->prepare("UPDATE employee SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashed, $employee_id);
        $updated = $stmt->execute();
        $stmt->close();

        if ($updated) {
            // Delete the used token so it can't be reused
            $stmt = $conn->prepare("DELETE FROM employee_password_resets WHERE employee_id = ?");
            $stmt->bind_param("i", $employee_id);
            $stmt->execute();
            $stmt->close();

            $success_msg = 'Your password has been reset successfully. You can now sign in with your new password.';
            $token_valid = false; // Hide the form
        } else {
            $submit_error = 'Something went wrong updating your password. Please try again.';
        }
    }
}

include_once '../includes/header.php';
?>

<style>
    body.login-page {
        background-color: #f4f6f9;
        min-height: 100vh;
    }
    .reset-box {
        width: 430px;
    }
    .card-primary.card-outline {
        border-top: 3px solid #007bff;
    }
    .form-group label {
        font-weight: 600;
        color: #495057;
        font-size: 0.9rem;
    }
    .input-group-text {
        background: #fff;
        color: #007bff;
        border-left: none;
        cursor: pointer;
    }
    .form-control {
        border-right: none;
    }
    .form-control:focus {
        border-color: #007bff;
        box-shadow: none;
    }
    .btn-primary {
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s;
    }
    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,123,255,0.3);
    }
    /* Password strength bar */
    #strength-bar-wrap { height: 6px; border-radius: 3px; background: #e9ecef; margin-top: 6px; overflow: hidden; }
    #strength-bar      { height: 100%; width: 0; border-radius: 3px; transition: width 0.3s, background 0.3s; }
    #strength-label    { font-size: 11px; color: #888; margin-top: 3px; }
    #match-msg         { font-size: 11px; margin-top: 3px; }
</style>

<body class="hold-transition login-page d-flex align-items-center justify-content-center">
<div class="reset-box">

    <div class="text-center mb-4">
        <i class="fas fa-shield-alt fa-3x text-primary"></i>
        <h4 class="text-dark mt-2"><b>Reset Your Password</b></h4>
    </div>

    <div class="card card-outline card-primary shadow-lg">
        <div class="card-body p-4">

            <?php if (!empty($success_msg)): ?>
            <!-- ✅ Success -->
            <div class="text-center py-3">
                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                <p class="text-success font-weight-bold mb-3"><?php echo htmlspecialchars($success_msg); ?></p>
                <a href="../auth/user-login.php" class="btn btn-primary rounded-pill px-5">
                    <i class="fas fa-sign-in-alt mr-1"></i> Go to Login
                </a>
            </div>

            <?php elseif (!$token_valid): ?>
            <!-- ❌ Invalid / expired token -->
            <div class="text-center py-3">
                <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                <p class="text-danger font-weight-bold"><?php echo htmlspecialchars($error_msg); ?></p>
                <p class="text-muted small">Go back to the login page and use the <strong>Forgot Password?</strong> link to request a new reset link.</p>
                <a href="../auth/user-login.php" class="btn btn-primary rounded-pill px-5 mt-2">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Login
                </a>
            </div>

            <?php else: ?>
            <!-- 🔑 Reset form -->
            <p class="text-muted small mb-4">Choose a strong new password for your employee account.</p>

            <?php if (!empty($submit_error)): ?>
            <div class="alert alert-danger py-2">
                <i class="fas fa-exclamation-circle mr-1"></i>
                <?php echo htmlspecialchars($submit_error); ?>
            </div>
            <?php endif; ?>

            <form method="POST" action="?token=<?php echo urlencode($token); ?>" id="resetForm">

                <!-- New Password -->
                <div class="form-group mb-3">
                    <label for="new_password">New Password</label>
                    <div class="input-group">
                        <input id="new_password" name="new_password" type="password"
                               class="form-control" placeholder="Min. 8 characters" required
                               oninput="checkStrength(this.value)">
                        <div class="input-group-append">
                            <div class="input-group-text" onclick="toggleVis('new_password','eye1')">
                                <span class="fas fa-eye" id="eye1"></span>
                            </div>
                        </div>
                    </div>
                    <div id="strength-bar-wrap"><div id="strength-bar"></div></div>
                    <div id="strength-label">Enter a password</div>
                </div>

                <!-- Confirm Password -->
                <div class="form-group mb-4">
                    <label for="confirm_password">Confirm New Password</label>
                    <div class="input-group">
                        <input id="confirm_password" name="confirm_password" type="password"
                               class="form-control" placeholder="Re-enter your password" required
                               oninput="checkMatch()">
                        <div class="input-group-append">
                            <div class="input-group-text" onclick="toggleVis('confirm_password','eye2')">
                                <span class="fas fa-eye" id="eye2"></span>
                            </div>
                        </div>
                    </div>
                    <div id="match-msg"></div>
                </div>

                <button type="submit" id="btn-submit" class="btn btn-primary btn-block rounded-pill">
                    <i class="fas fa-save mr-1"></i> Set New Password
                </button>
            </form>

            <div class="text-center mt-3">
                <a href="../auth/user-login.php" class="text-muted small">
                    <i class="fas fa-arrow-left mr-1"></i>Back to Login
                </a>
            </div>

            <?php endif; ?>

        </div>
    </div>
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
        const bar   = document.getElementById('strength-bar');
        const label = document.getElementById('strength-label');
        let score = 0;
        if (val.length >= 8)              score++;
        if (/[A-Z]/.test(val))            score++;
        if (/[0-9]/.test(val))            score++;
        if (/[^A-Za-z0-9]/.test(val))    score++;

        const levels = [
            { w: '0%',    color: '#dee2e6', text: 'Enter a password' },
            { w: '25%',   color: '#dc3545', text: 'Weak' },
            { w: '50%',   color: '#fd7e14', text: 'Fair' },
            { w: '75%',   color: '#ffc107', text: 'Good' },
            { w: '100%',  color: '#28a745', text: 'Strong' },
        ];
        const lvl = val.length === 0 ? 0 : Math.min(score, 4);
        bar.style.width       = levels[lvl].w;
        bar.style.background  = levels[lvl].color;
        label.textContent     = levels[lvl].text;
        label.style.color     = levels[lvl].color;

        checkMatch(); // re-check match when password changes
    }

    function checkMatch() {
        const pwd  = document.getElementById('new_password').value;
        const conf = document.getElementById('confirm_password').value;
        const msg  = document.getElementById('match-msg');
        if (conf === '') {
            msg.textContent = '';
            return;
        }
        if (conf === pwd) {
            msg.textContent  = '✓ Passwords match';
            msg.style.color  = '#28a745';
        } else {
            msg.textContent  = '✗ Passwords do not match';
            msg.style.color  = '#dc3545';
        }
    }

    // Prevent submit if passwords don't match
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