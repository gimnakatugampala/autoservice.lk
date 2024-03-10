<?php include_once '../includes/auth-header.php'; ?>

<body class="account-page">

<div class="main-wrapper">
<div class="account-content">
<div class="login-wrapper">

<div class="login-content">
<div class="login-userset">
<div class="login-logo">

<div class="d-flex align-items-center">
    <img width="50" src="../assets/img/system/autoservice_logo.jpg" alt="img">
    <h4 class="ml-2">autoservice.lk</h4>
</div>

</div>
<div class="login-userheading">
<h3 class="m-0">Sign In</h3>
<h4 class="m-0">Sign In As A Service Station</h4>
</div>
<div class="form-login">
<label>Email</label>
<div class="form-addons">
<input id="email" type="text" placeholder="Enter Service Station email">
<img src="../assets/img/icons/mail.svg" alt="img">
</div>
</div>
<div class="form-login">
<label>Password</label>
<div class="pass-group">
<input id="password" type="password" class="pass-input" placeholder="Enter your password">
<span class="fas toggle-password fa-eye-slash"></span>
</div>
</div>
<div class="form-login">
<div class="alreadyuser">
<h4><a href="forgetpassword.html" class="hover-a">Forgot Password?</a></h4>
</div>
</div>
<div class="form-login">
<button id="btn_station_login" class="btn btn-login" >Sign In</button>
</div>
<!-- href="../auth/user-login.php" -->
<div class="signinform text-center">
<h4>Don’t have an account? <a href="../auth/station-register.php" class="hover-a">Sign Up</a></h4>
</div>


</div>
</div>

<div class="login-img">
<img style="object-fit: cover;" src="../assets/img/system/login_station.jpg" alt="img">
</div>

</div>
</div>
</div>


<?php include_once '../includes/auth-footer.php'; ?>
</body>
</html>