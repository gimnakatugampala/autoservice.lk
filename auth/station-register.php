<?php include_once '../includes/auth-header.php'; ?>

<style>
    :root {
        --primary-blue: #007bff;
        --hover-blue: #0056b3;
        --bg-light: #f8f9fa;
    }

    body.account-page {
        background-color: var(--bg-light);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }

    .login-wrapper {
        display: flex;
        min-height: 100vh;
        overflow: hidden;
    }

    /* Left Side Image */
    .login-img {
        flex: 1.2;
        display: block;
        position: relative;
    }

    .login-img img {
        width: 100%;
        height: 100vh;
        object-fit: cover;
    }

    /* Right Side Content */
    .login-content {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px;
        background: #fff;
        box-shadow: -10px 0 20px rgba(0,0,0,0.05);
    }

    .login-userset {
        width: 100%;
        max-width: 440px;
        animation: fadeInRight 0.8s ease-out;
    }

    .login-logo {
        margin-bottom: 25px;
    }

    .login-logo h4 {
        font-weight: 800;
        color: var(--primary-blue);
        letter-spacing: -0.5px;
        margin-bottom: 0;
    }

    .login-userheading h3 {
        font-size: 26px;
        font-weight: 700;
        color: #1b1b1b;
        margin-bottom: 8px !important;
    }

    .login-userheading h4 {
        font-size: 15px;
        color: #6c757d;
        margin-bottom: 30px !important;
        font-weight: 400;
    }

    /* Form Fields */
    .form-login {
        margin-bottom: 18px;
    }

    .form-login label {
        font-weight: 600;
        font-size: 13.5px;
        color: #444;
        margin-bottom: 8px;
        display: block;
    }

    .form-addons, .pass-group {
        position: relative;
    }

    .form-addons input, .pass-group input {
        width: 100%;
        padding: 11px 15px;
        padding-right: 45px;
        border: 1px solid #ced4da;
        border-radius: 8px;
        font-size: 14.5px;
        transition: all 0.3s;
        background-color: #fff;
    }

    /* Specialized File Input Styling */
    input[type="file"] {
        padding: 8px 12px;
        font-size: 13px;
        color: #6c757d;
    }

    .form-addons input:focus, .pass-group input:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.15);
        outline: none;
    }

    .form-addons img {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        filter: grayscale(1);
        opacity: 0.5;
    }

    .toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #adb5bd;
        transition: color 0.2s;
    }

    .toggle-password:hover {
        color: var(--primary-blue);
    }

    /* Button Styling */
    .btn-login {
        background-color: var(--primary-blue);
        color: #fff !important;
        width: 100%;
        padding: 12px;
        font-weight: 700;
        border-radius: 8px;
        border: none;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-login:hover {
        background-color: var(--hover-blue);
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        transform: translateY(-1px);
    }

    .signinform h4 {
        font-size: 14px;
        margin-top: 25px;
        color: #6c757d;
    }

    .signinform .hover-a {
        color: var(--primary-blue);
        font-weight: 700;
        text-decoration: none;
        margin-left: 5px;
    }

    .signinform .hover-a:hover {
        text-decoration: underline;
    }

    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(30px); }
        to { opacity: 1; transform: translateX(0); }
    }

    /* Responsive Adjustments */
    @media (max-width: 991px) {
        .login-img { display: none; }
        .login-content { padding: 20px; }
    }
</style>

<body class="account-page">
    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                
                <div class="login-img">
                    <img src="../assets/img/system/station_register.jpg" alt="Register Background">
                </div>

                <div class="login-content">
                    <div class="login-userset">
                        <div class="login-logo">
                            <div class="d-flex align-items-center">
                                <img width="45" src="../assets/img/system/autoservice_logo.jpg" alt="Logo" class="rounded shadow-sm">
                                <h4 class="ml-2">autoservice.lk</h4>
                            </div>
                        </div>

                        <div class="login-userheading">
                            <h3>Create an Account</h3>
                            <h4>Register your service station to get started</h4>
                        </div>

                        <form id="stationRegisterForm" enctype="multipart/form-data">
                            <div class="form-login">
                                <label>Service Station Name</label>
                                <div class="form-addons">
                                    <input id="station_name" type="text" placeholder="e.g. Elite Auto Care" required>
                                    <img src="../assets/img/icons/users1.svg" alt="icon">
                                </div>
                            </div>
                            
                            <div class="form-login">
                                <label>Station Logo (Identity)</label>
                                <div class="form-addons">
                                    <input id="station_logo" accept="image/*" type="file" required>
                                </div>
                            </div>
                            
                            <div class="form-login">
                                <label>Business Email Address</label>
                                <div class="form-addons">
                                    <input id="email" type="email" placeholder="contact@station.com" required>
                                    <img src="../assets/img/icons/mail.svg" alt="icon">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-login">
                                        <label>Password</label>
                                        <div class="pass-group">
                                            <input id="password" type="password" class="pass-input" placeholder="••••••••" required>
                                            <span class="fas toggle-password fa-eye-slash"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-login">
                                        <label>Confirm Password</label>
                                        <div class="pass-group">
                                            <input id="con_password" type="password" class="pass-input" placeholder="••••••••" required>
                                            <span class="fas toggle-password fa-eye-slash"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-login mt-2">
                                <button type="button" id="station_register_btn" class="btn btn-login">Create Account</button>

                                <div style="display: none;" id="btn-loading">
                                    <button type="button" class="btn btn-login" disabled>
                                        <span class="spinner-border spinner-border-sm mr-2" role="status"></span>
                                        Processing...
                                    </button>
                                </div>
                            </div>

                            <div class="signinform text-center">
                                <h4>Already have a station? <a href="../auth/station-login.php" class="hover-a">Sign In</a></h4>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include_once '../includes/auth-footer.php'; ?>
    <script src="../assets/js/station_register.js"></script>
    
 <script>
        $(document).ready(function() {
            // --- Existing Toggle Logic ---
            $(document).on('click', '.toggle-password', function() {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $(this).siblings(".pass-input");
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });

            // --- NEW: Trigger Submit on Enter Key ---
            // Listen for keypress on all input fields inside the form
            $('#stationRegisterForm input').keypress(function(e) {
                // Check if the key is 'Enter' (code 13)
                if (e.which == 13) {
                    e.preventDefault(); // Prevent default form submission if any
                    $('#station_register_btn').click(); // Trigger the button click
                }
            });
        });
    </script>

    
</body>
</html>