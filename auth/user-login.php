<?php include_once '../includes/header.php';?>

<style>
    body.login-page {
        background-color: #f4f6f9;
        height: 100vh;
    }
    .login-box {
        width: 400px;
    }
    .card-primary.card-outline {
        border-top: 3px solid #007bff;
    }
    .station-brand-img {
        width: 75px;
        height: 75px;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .form-group label {
        font-weight: 600;
        color: #495057;
        font-size: 0.9rem;
    }
    .input-group-text {
        background-color: #ffffff;
        color: #007bff;
        border-left: none;
    }
    .form-control {
        border-right: none;
    }
    .form-control:focus {
        border-color: #007bff;
        box-shadow: none;
    }
    .form-control:focus + .input-group-append .input-group-text {
        border-color: #007bff;
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
    .toggle-password {
        cursor: pointer;
    }
    /* Forgot password modal tweaks */
    #forgotPasswordModal .modal-header {
        border-bottom: 3px solid #007bff;
    }
    #forgotPasswordModal .modal-footer {
        border-top: none;
    }
    #fp-success-box, #fp-error-box {
        display: none;
    }
</style>

<body class="hold-transition login-page d-flex align-items-center justify-content-center">
<div class="login-box">
    <div class="login-logo mb-4">
        <div class="text-center">
            <img class="station-brand-img rounded-circle mb-2"
                 src="<?php echo (isset($_SESSION["station_img"])) ? '../uploads/stations/' . $_SESSION["station_img"] : '../assets/img/no-image.png'; ?>"
                 alt="Station Logo">
            <h4 class="text-dark"><b><?php echo $_SESSION["station_name"] ?? 'Service Station'; ?></b></h4>
        </div>
    </div>

    <div class="card card-outline card-primary shadow-lg">
        <div class="card-body login-card-body p-4">
            <h4 class="text-center font-weight-bold mb-1">Employee Portal</h4>
            <p class="login-box-msg text-muted small mb-4">Sign in to access your workspace</p>

            <form id="employeeLoginForm">
                <div class="form-group mb-3">
                    <label for="email">Email Address</label>
                    <div class="input-group">
                        <input id="email" type="email" class="form-control" placeholder="name@station.com" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <div class="d-flex justify-content-between">
                        <label for="password">Password</label>
                    </div>
                    <div class="input-group">
                        <input id="password" type="password" class="form-control" placeholder="••••••••" required>
                        <div class="input-group-append">
                            <div class="input-group-text toggle-password" onclick="toggleEmployeePass()">
                                <span class="fas fa-eye" id="eye-icon"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col-7">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">Remember Me</label>
                        </div>
                    </div>
                    <div class="col-5">
                        <button id="btn_user_login" type="button" class="btn btn-primary btn-block rounded-pill">
                            Sign In <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                        <button id="btn-loading" style="display: none;" type="button" class="btn btn-primary btn-block rounded-pill" disabled>
                            <span class="spinner-border spinner-border-sm mr-1" role="status"></span>
                            Wait...
                        </button>
                    </div>
                </div>
            </form>

            <div class="mt-4 text-center">
                <p class="mb-1">
                    <!-- Forgot Password trigger -->
                    <a href="#" class="text-sm text-primary font-weight-bold" data-toggle="modal" data-target="#forgotPasswordModal">
                        <i class="fas fa-key mr-1"></i>Forgot Password?
                    </a>
                </p>
                <p class="mb-0 mt-2">
                    <a href="../auth/station-login.php" class="text-sm text-muted">Switch to Station Login</a>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════
     FORGOT PASSWORD MODAL
════════════════════════════════════════════════ -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg">

            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="forgotPasswordModalLabel">
                    <i class="fas fa-lock-open text-primary mr-2"></i>Reset Password
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body p-4">
                <!-- Instruction text -->
                <p class="text-muted small mb-3">
                    Enter your registered email address. We'll send you a link to reset your password.
                </p>

                <!-- Success alert -->
                <div id="fp-success-box" class="alert alert-success">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span id="fp-success-msg"></span>
                </div>

                <!-- Error alert -->
                <div id="fp-error-box" class="alert alert-danger">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span id="fp-error-msg"></span>
                </div>

                <div id="fp-form-area">
                    <div class="form-group mb-0">
                        <label for="fp-email" class="font-weight-bold">Email Address</label>
                        <div class="input-group">
                            <input id="fp-email" type="email" class="form-control" placeholder="name@station.com" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope text-primary"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer d-flex justify-content-between px-4 pb-4">
                <button type="button" class="btn btn-light rounded-pill px-4" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Cancel
                </button>
                <button id="btn-fp-submit" type="button" class="btn btn-primary rounded-pill px-4" onclick="submitForgotPassword()">
                    <i class="fas fa-paper-plane mr-1"></i> Send Reset Link
                </button>
                <button id="btn-fp-loading" style="display:none;" type="button" class="btn btn-primary rounded-pill px-4" disabled>
                    <span class="spinner-border spinner-border-sm mr-1"></span> Sending...
                </button>
            </div>

        </div>
    </div>
</div>
<!-- END FORGOT PASSWORD MODAL -->

<script>
    function toggleEmployeePass() {
        const passInput = document.getElementById('password');
        const eyeIcon   = document.getElementById('eye-icon');
        if (passInput.type === "password") {
            passInput.type = "text";
            eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            passInput.type = "password";
            eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // Enter key support
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('#email, #password').forEach(input => {
            input.addEventListener("keypress", function (event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    document.getElementById("btn_user_login").click();
                }
            });
        });

        // Reset modal state whenever it opens
        document.getElementById('forgotPasswordModal').addEventListener('show.bs.modal', resetForgotModal);
    });

    function setLoginLoading(isLoading) {
        document.getElementById('btn_user_login').style.display = isLoading ? 'none' : 'block';
        document.getElementById('btn-loading').style.display    = isLoading ? 'block' : 'none';
    }

    // ── Forgot Password ────────────────────────────────────────────────────
    function resetForgotModal() {
        document.getElementById('fp-email').value        = '';
        document.getElementById('fp-success-box').style.display = 'none';
        document.getElementById('fp-error-box').style.display   = 'none';
        document.getElementById('fp-form-area').style.display   = 'block';
        document.getElementById('btn-fp-submit').style.display  = 'inline-block';
        document.getElementById('btn-fp-loading').style.display = 'none';
    }

    function submitForgotPassword() {
        const email = document.getElementById('fp-email').value.trim();

        if (!email) {
            showFpError('Please enter your email address.');
            return;
        }

        // Simple email format check
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showFpError('Please enter a valid email address.');
            return;
        }

        // Show loading state
        document.getElementById('btn-fp-submit').style.display  = 'none';
        document.getElementById('btn-fp-loading').style.display = 'inline-block';
        document.getElementById('fp-success-box').style.display = 'none';
        document.getElementById('fp-error-box').style.display   = 'none';

        fetch('../api/forgot-password.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email: email })
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('btn-fp-loading').style.display = 'none';

            if (data.success) {
                document.getElementById('fp-form-area').style.display  = 'none';
                document.getElementById('fp-success-msg').textContent  = data.message;
                document.getElementById('fp-success-box').style.display = 'block';
            } else {
                document.getElementById('btn-fp-submit').style.display = 'inline-block';
                showFpError(data.message);
            }
        })
        .catch(() => {
            document.getElementById('btn-fp-loading').style.display = 'none';
            document.getElementById('btn-fp-submit').style.display  = 'inline-block';
            showFpError('Something went wrong. Please try again.');
        });
    }

    function showFpError(msg) {
        document.getElementById('fp-error-msg').textContent    = msg;
        document.getElementById('fp-error-box').style.display  = 'block';
    }

    // Allow Enter key inside the modal email field
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById('fp-email').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') { e.preventDefault(); submitForgotPassword(); }
        });
    });
</script>

<?php include_once '../includes/footer.php';?>
</body>
</html>