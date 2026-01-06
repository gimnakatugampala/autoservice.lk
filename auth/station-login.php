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

    /* Responsive */
    @media (max-width: 991px) {
        .login-img { display: none; }
    }
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
                                    <h4><a href="forgetpassword.html">Forgot Password?</a></h4>
                                </div>
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
                            <h4>Don’t have an account? <a href="../auth/station-register.php" class="hover-a">Create Station Account</a></h4>
                        </div>
                    </div>
                </div>

                <div class="login-img">
                    <img src="../assets/img/system/login_station.jpg" alt="Service Station Background">
                </div>
            </div>
        </div>
    </div>

    <?php include_once '../includes/auth-footer.php'; ?>
    
<script>
        $(document).ready(function() {
            // Existing Password toggle logic
            $(document).on('click', '.toggle-password', function() {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $(".pass-input");
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });

            // --- NEW CODE: Trigger Login on Enter Key ---
            $('#email, #password').keypress(function(e) {
                // Check if the key pressed is 'Enter' (key code 13)
                if (e.which == 13) {
                    e.preventDefault(); // Stop the form from submitting normally (page reload)
                    $('#btn_station_login').click(); // Trigger the button click
                }
            });
            // ---------------------------------------------
        });
    </script>
</body>
</html>