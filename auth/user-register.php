<?php include_once '../includes/header.php';?>

<?php
require_once '../includes/db_config.php';

if (!isset($_SESSION["station_id"]) || $_SESSION["station_id"] == null) {
    header('Location: ../auth/station-login.php');
    exit(); 
} else {
    $sql = "SELECT * FROM employee WHERE service_station_id = '{$_SESSION["station_id"]}' AND user_type_id = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header('Location: ../auth/station-login.php');
        exit(); 
    }
}
?>

<style>
    body.register-page {
        background-color: #f4f6f9;
    }
    .register-box {
        width: 400px;
        margin-top: 50px;
    }
    .card {
        border-top: 3px solid #007bff;
        border-radius: 0.5rem;
    }
    .station-img-preview {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .form-group label {
        font-weight: 600;
        color: #495057;
    }
    .input-group-text {
        background-color: #ffffff;
        color: #007bff;
    }
    .btn-primary {
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .toggle-password {
        cursor: pointer;
    }
    .register-logo b {
        color: #007bff;
    }
</style>

<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <div class="text-center mb-2">
            <img class="station-img-preview rounded-circle" 
                 src="<?php echo (isset($_SESSION["station_img"])) ? '../uploads/stations/' . $_SESSION["station_img"] : '../assets/img/no-image.png'; ?>" 
                 alt="Station Logo">
        </div>
        <a href="#"><b><?php echo $_SESSION["station_name"] ?? 'Service'; ?></b> Station</a>
    </div>

    <div class="card shadow">
        <div class="card-body register-card-body">
            <h4 class="login-box-msg font-weight-bold p-0 mb-1">Admin Account</h4>
            <p class="login-box-msg text-sm mb-4">Register the primary administrator for this station</p>

            <form id="adminRegisterForm">
                <div class="form-group mb-3">
                    <label for="email">Email Address</label>
                    <div class="input-group">
                        <input id="email" type="email" class="form-control" placeholder="admin@station.com" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="pass">Create Password</label>
                    <div class="input-group">
                        <input id="pass" type="password" class="form-control" placeholder="••••••••" required>
                        <div class="input-group-append">
                            <div class="input-group-text toggle-password" onclick="togglePass('pass')">
                                <span class="fas fa-eye" id="icon-pass"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="con_pass">Confirm Password</label>
                    <div class="input-group">
                        <input id="con_pass" type="password" class="form-control" placeholder="••••••••" required>
                        <div class="input-group-append">
                            <div class="input-group-text toggle-password" onclick="togglePass('con_pass')">
                                <span class="fas fa-eye" id="icon-con_pass"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button id="btn-user-reg" type="button" class="btn btn-primary btn-block shadow-sm">
                            <i class="fas fa-user-plus mr-2"></i> Complete Registration
                        </button>

                        <button id="btn-loading" style="display: none;" type="button" class="btn btn-primary btn-block shadow-sm" disabled>
                            <span class="spinner-border spinner-border-sm mr-2" role="status"></span>
                            Creating Account...
                        </button>
                    </div>
                </div>
            </form>

            <div class="social-auth-links text-center mt-4">
                <p class="text-muted text-sm">Wrong station? <a href="../auth/station-login.php" class="text-primary font-weight-bold">Sign Out</a></p>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePass(id) {
        const input = document.getElementById(id);
        const icon = document.getElementById('icon-' + id);
        if (input.type === "password") {
            input.type = "text";
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = "password";
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // Logic for button swaping (usually called from your register.js)
    function showLoading() {
        document.getElementById('btn-user-reg').style.display = 'none';
        document.getElementById('btn-loading').style.display = 'block';
    }
</script>

<?php include_once '../includes/footer.php';?>
</body>
</html>