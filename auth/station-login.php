<?php include_once '../includes/auth-header.php'; ?>

<style>
.login-page {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.login-box {
    width: 400px;
}

.card {
    border: none;
    border-radius: 1rem;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
}

.card-header {
    background: transparent;
    border: none;
    padding: 2rem 2rem 0;
}

.card-body {
    padding: 2rem;
}

.brand-logo {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
}

.brand-logo img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.brand-text {
    font-size: 1.75rem;
    font-weight: 700;
    color: #333;
    margin-left: 1rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.login-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
    text-align: center;
}

.login-subtitle {
    color: #6c757d;
    text-align: center;
    margin-bottom: 2rem;
    font-size: 0.95rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    font-weight: 500;
    color: #495057;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.form-control {
    border-radius: 0.5rem;
    border: 1px solid #e0e0e0;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
}

.input-group-text {
    border-radius: 0.5rem 0 0 0.5rem;
    border: 1px solid #e0e0e0;
    background: #f8f9fa;
    color: #667eea;
}

.input-group .form-control {
    border-left: none;
    border-radius: 0 0.5rem 0.5rem 0;
}

.input-group:focus-within .input-group-text {
    border-color: #667eea;
    background: #667eea;
    color: white;
}

.btn-login {
    width: 100%;
    padding: 0.75rem;
    font-weight: 600;
    border-radius: 0.5rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    font-size: 1rem;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    color: white;
}

.btn-login:active {
    transform: translateY(0);
}

.forgot-password {
    text-align: right;
    margin-top: -0.5rem;
    margin-bottom: 1.5rem;
}

.forgot-password a {
    color: #667eea;
    font-size: 0.875rem;
    text-decoration: none;
    transition: color 0.3s ease;
}

.forgot-password a:hover {
    color: #764ba2;
    text-decoration: underline;
}

.signup-link {
    text-align: center;
    margin-top: 1.5rem;
    color: #6c757d;
    font-size: 0.95rem;
}

.signup-link a {
    color: #667eea;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.3s ease;
}

.signup-link a:hover {
    color: #764ba2;
    text-decoration: underline;
}

.spinner-border-sm {
    width: 1rem;
    height: 1rem;
}

#btn-loading .btn-login {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    opacity: 0.7;
    cursor: not-allowed;
}

/* Password visibility toggle */
.toggle-password {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #6c757d;
    z-index: 10;
    transition: color 0.3s ease;
}

.toggle-password:hover {
    color: #667eea;
}

.password-wrapper {
    position: relative;
}

.password-wrapper .form-control {
    padding-right: 45px;
}

/* Animation for form elements */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card {
    animation: fadeInUp 0.6s ease;
}
</style>

<body class="login-page">
    <div class="login-box">
        <div class="card">
            <div class="card-header">
                <div class="brand-logo">
                    <img src="../assets/img/system/autoservice_logo.jpg" alt="AutoService Logo">
                    <h4 class="brand-text">autoservice.lk</h4>
                </div>
                <h3 class="login-title">Welcome Back</h3>
                <p class="login-subtitle">Sign in to your service station account</p>
            </div>
            
            <div class="card-body">
                <form id="loginForm">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                            <input type="email" 
                                   class="form-control" 
                                   id="email" 
                                   placeholder="Enter your email"
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="password-wrapper">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </div>
                                <input type="password" 
                                       class="form-control" 
                                       id="password" 
                                       placeholder="Enter your password"
                                       required>
                            </div>
                            <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
                        </div>
                    </div>

                    <div class="forgot-password">
                        <a href="forgetpassword.html">Forgot Password?</a>
                    </div>

                    <button type="submit" id="btn_station_login" class="btn btn-login">
                        Sign In
                    </button>

                    <span style="display: none;" id="btn-loading">
                        <button type="button" class="btn btn-login" disabled>
                            <span class="spinner-border spinner-border-sm" role="status"></span>
                            <span class="ml-2">Signing in...</span>
                        </button>
                    </span>
                </form>

                <div class="signup-link">
                    Don't have an account? <a href="../auth/station-register.php">Sign Up</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Prevent form submission on Enter (will be handled by your existing JS)
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
        });
    </script>

    <?php include_once '../includes/auth-footer.php'; ?>
</body>
</html>