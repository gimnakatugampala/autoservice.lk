<?php include_once '../includes/header.php';?>

<style>
    body.login-page {
        background-color: #f4f6f9;
        height: 100vh;
    }
    .login-box {
        width: 400px;
    }
    /* AdminLTE Card Accent */
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
                    <a href="../auth/station-login.php" class="text-sm text-muted">Switch to Station Login</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleEmployeePass() {
        const passInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        if (passInput.type === "password") {
            passInput.type = "text";
            eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            passInput.type = "password";
            eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // Helper to switch buttons during AJAX (Add this logic to your user-login.js)
    function setLoginLoading(isLoading) {
        const btn = document.getElementById('btn_user_login');
        const loading = document.getElementById('btn-loading');
        if (isLoading) {
            btn.style.display = 'none';
            loading.style.display = 'block';
        } else {
            btn.style.display = 'block';
            loading.style.display = 'none';
        }
    }
</script>

<?php include_once '../includes/footer.php';?>
</body>
</html>