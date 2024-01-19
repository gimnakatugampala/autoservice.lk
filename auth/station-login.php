<?php include_once '../includes/auth-header.php'; ?>

<body class="account-page">

<div class="main-wrapper">
<div class="account-content">
<div class="login-wrapper">

<div class="login-content">
<div class="login-userset">
<div class="login-logo">
<!-- <img src="../assets/img/logo.png" alt="img"> -->
<h3>autoservice.lk</h3>

</div>
<div class="login-userheading">
<h3>Sign In</h3>
<h4>Please login to your account</h4>
</div>
<div class="form-login">
<label>Email</label>
<div class="form-addons">
<input type="text" placeholder="Enter your email address">
<img src="../assets/img/icons/mail.svg" alt="img">
</div>
</div>
<div class="form-login">
<label>Password</label>
<div class="pass-group">
<input type="password" class="pass-input" placeholder="Enter your password">
<span class="fas toggle-password fa-eye-slash"></span>
</div>
</div>
<div class="form-login">
<div class="alreadyuser">
<h4><a href="forgetpassword.html" class="hover-a">Forgot Password?</a></h4>
</div>
</div>
<div class="form-login">
<a class="btn btn-login" href="../auth/user-login.php">Sign In</a>
</div>
<div class="signinform text-center">
<h4>Don’t have an account? <a href="../auth/station-register.php" class="hover-a">Sign Up</a></h4>
</div>


</div>
</div>

<div class="login-img">
<img src="../assets/img/login.jpg" alt="img">
</div>

</div>
</div>
</div>


<?php include_once '../includes/auth-footer.php'; ?>
</body>
</html>