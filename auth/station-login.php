<?php include_once '../includes/auth-header.php'; ?>

<style>
    :root {
        --primary-blue: #007bff;
        --hover-blue: #0056b3;
        --bg-light: #f8f9fa;
    }

    body.account-page {
        background-color: var(--bg-light);
        font-family: 'Inter', sans-serif;
    }

    .login-wrapper {
        display: flex;
        min-height: 100vh;
        overflow: hidden;
    }

    .login-content {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px;
        background: #fff;
    }

    .login-userset {
        width: 100%;
        max-width: 400px;
        animation: fadeInRight 0.8s ease-out;
    }

    .login-logo {
        margin-bottom: 30px;
    }

    .login-logo h4 {
        font-weight: 700;
        color: var(--primary-blue);
        letter-spacing: -0.5px;
    }

    .login-userheading h3 {
        font-size: 24px;
        font-weight: 700;
        color: #333;
        margin-bottom: 5px !important;
    }

    .login-userheading h4 {
        font-size: 15px;
        color: #777;
        margin-bottom: 25px !important;
    }

    .form-login label {
        font-weight: 600;
        font-size: 14px;
        color: #444;
        margin-bottom: 8px;
    }

    .form-addons, .pass-group {
        position: relative;
        margin-bottom: 20px;
    }

    .form-addons input, .pass-group input {
        width: 100%;
        padding: 12px 15px;
        padding-right: 45px;
        border: 1px solid #ddd;
        border-radius: 8px;
        transition: all 0.3s;
    }

    .form-addons input:focus, .pass-group input:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        outline: none;
    }

    .form-addons img {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        opacity: 0.6;
    }

    .toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #777;
    }

    .btn-login {
        background-color: var(--primary-blue);
        color: #fff;
        width: 100%;
        padding: 12px;
        font-weight: 700;
        border-radius: 8px;
        border: none;
        transition: background 0.3s, transform 0.2s;
        margin-top: 10px;
    }

    .btn-login:hover {
        background-color: var(--hover-blue);
        color: #fff;
        transform: translateY(-1px);
    }

    .alreadyuser a {
        color: var(--primary-blue);
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
    }

    .alreadyuser a:hover {
        text-decoration: underline;
    }

    .signinform h4 {
        font-size: 14px;
        margin-top: 20px;
        color: #666;
    }

    .signinform .hover-a {
        color: var(--primary-blue);
        font-weight: 700;
        text-decoration: none;
    }

    .login-img {
        flex: 1.2;
        display: block;
    }

    .login-img img {
        width: 100%;
        height: 100vh;
        object-fit: cover;
    }

    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(20px); }
        to { opacity: 1; transform: translateX(0); }
    }

    @media (max-width: 991px) {
        .login-img { display: none; }
    }

    /* ── Forgot Password Modal ── */
    #fpModal .modal-content   { border-radius: 12px; overflow: hidden; }
    #fpModal .modal-header    { background: var(--primary-blue); border-bottom: none; }
    #fpModal .modal-title     { color: #fff; font-weight: 700; }
    #fpModal .modal-header .close { color: #fff; opacity: 0.8; }
    #fpModal .modal-footer    { border-top: none; }
    #fp-email-input {
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        width: 100%;
        transition: all 0.3s;
    }
    #fp-email-input:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
        outline: none;
    }
    #fp-success-box, #fp-error-box { display: none; }
</style>

<body class="account-page">
    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset">
                        <div class="login-logo">
                            <div class="d-flex align-items-center">
                                <img width="45" src="../assets/img/system/autoservice_logo.jpg" alt="Logo" class="rounded shadow-sm">
                                <h4 class="ml-2 mb-0">autoservice.lk</h4>
                            </div>
                        </div>

                        <div class="login-userheading">
                            <h3>Welcome Back</h3>
                            <h4>Manage your service station dashboard</h4>
                        </div>

                        <form id="loginForm">
                            <div class="form-login">
                                <label>Station Email</label>
                                <div class="form-addons">
                                    <input id="email" type="email" placeholder="station@example.com" required>
                                    <img src="../assets/img/icons/mail.svg" alt="mail icon">
                                </div>
                            </div>

                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input id="password" type="password" class="pass-input" placeholder="••••••••" required>
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>

                            <div class="form-login d-flex justify-content-end">
                                <div class="alreadyuser">
                                    <!-- Opens forgot password modal -->
                                    <h4>
                                        <a href="#" id="btn-forgot-password">
                                            <i class="fas fa-key mr-1"></i>Forgot Password?
                                        </a>
                                    </h4>
                                </div>
                            </div>

                            <div class="form-login">
                                <div class="g-recaptcha" data-sitekey="6LeS1XMsAAAAABs89_XYKP-khhboHHiYY4KnHNLy"></div>
                            </div>

                            <div class="form-login">
                                <button type="button" id="btn_station_login" class="btn btn-login">Sign In</button>

                                <div style="display: none;" id="btn-loading">
                                    <button type="button" class="btn btn-login" disabled>
                                        <span class="spinner-border spinner-border-sm mr-2" role="status"></span>
                                        Authenticating...
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="signinform text-center">
                            <h4>Don't have an account?
                                <a href="../auth/station-register.php" class="hover-a">Create Station Account</a>
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="login-img">
                    <img src="../assets/img/system/login_station.jpg" alt="Service Station Background">
                </div>
            </div>
        </div>
    </div>

    <!-- ════════════════════════════════════════════
         FORGOT PASSWORD MODAL
    ═════════════════════════════════════════════ -->
    <div class="modal fade" id="fpModal" tabindex="-1" role="dialog" aria-labelledby="fpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:420px;">
            <div class="modal-content shadow-lg">

                <div class="modal-header">
                    <h5 class="modal-title" id="fpModalLabel">
                        <i class="fas fa-lock-open mr-2"></i>Reset Station Password
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body p-4">
                    <p class="text-muted small mb-3">
                        Enter the email address registered to your station account. We'll send you a link to reset your password.
                    </p>

                    <!-- Success -->
                    <div id="fp-success-box" class="alert alert-success">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span id="fp-success-msg"></span>
                    </div>

                    <!-- Error -->
                    <div id="fp-error-box" class="alert alert-danger">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span id="fp-error-msg"></span>
                    </div>

                    <div id="fp-form-area">
                        <label class="font-weight-bold" style="font-size:14px;" for="fp-email-input">Station Email Address</label>
                        <input id="fp-email-input" type="email" placeholder="station@example.com">
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between px-4 pb-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </button>
                    <button id="btn-fp-submit" type="button" class="btn btn-primary rounded-pill px-4"
                            onclick="submitForgotPassword()">
                        <i class="fas fa-paper-plane mr-1"></i> Send Reset Link
                    </button>
                    <button id="btn-fp-loading" style="display:none;" type="button"
                            class="btn btn-primary rounded-pill px-4" disabled>
                        <span class="spinner-border spinner-border-sm mr-1"></span> Sending...
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- END FORGOT PASSWORD MODAL -->

    <?php include_once '../includes/auth-footer.php'; ?>

<script>
    $(document).ready(function () {

        // Password visibility toggle
        $(document).on('click', '.toggle-password', function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $(".pass-input");
            input.attr("type", input.attr("type") === "password" ? "text" : "password");
        });

        // Enter key → login
        $('#email, #password').keypress(function (e) {
            if (e.which === 13) {
                e.preventDefault();
                $('#btn_station_login').click();
            }
        });

        // Forgot password link — explicit JS trigger works even if Bootstrap JS
        // data-attributes aren't firing due to load order
        $('#btn-forgot-password').on('click', function (e) {
            e.preventDefault();
            $('#fpModal').modal('show');
        });

        // Enter key → forgot password submit
        $('#fp-email-input').keypress(function (e) {
            if (e.which === 13) {
                e.preventDefault();
                submitForgotPassword();
            }
        });

        // Reset modal state on open
        $('#fpModal').on('show.bs.modal', function () {
            $('#fp-email-input').val('');
            $('#fp-success-box, #fp-error-box').hide();
            $('#fp-form-area').show();
            $('#btn-fp-submit').show();
            $('#btn-fp-loading').hide();
        });
    });

    // ── Forgot Password ────────────────────────────────────────────────────
    function submitForgotPassword() {
        var email = $('#fp-email-input').val().trim();

        if (!email) {
            showFpError('Please enter your email address.');
            return;
        }
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showFpError('Please enter a valid email address.');
            return;
        }

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