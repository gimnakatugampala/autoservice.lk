<?php include_once '../includes/auth-header.php'; ?>

<body class="account-page">

<div class="main-wrapper">
<div class="account-content">
<div class="login-wrapper">
    
<div class="login-img">
<img src="../assets/img/login.jpg" alt="img">
</div>

<div class="login-content">
<div class="login-userset">
<div class="login-logo">
<!-- <img src="../assets/img/logo.png" alt="img"> -->
<h3>autoservice.lk</h3>
</div>

<div class="login-userheading">
<h3>Create an Account</h3>
<h4>Continue where you left off</h4>
</div>
<div class="form-login">
<label>Full Name</label>
<div class="form-addons">
<input type="text" placeholder="Enter your full name">
<img src="../assets/img/icons/users1.svg" alt="img">
</div>
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
<a class="btn btn-login">Sign Up</a>
</div>
<div class="signinform text-center">
<h4>Already a user? <a href="../auth/station-login.php" class="hover-a">Sign In</a></h4>
</div>

</div>
</div>



</div>
</div>
</div>


<?php include_once '../includes/auth-footer.php'; ?>
</body>
</html>