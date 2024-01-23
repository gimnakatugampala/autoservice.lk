<?php include_once '../includes/auth-header.php'; ?>

<body class="account-page">

<div class="main-wrapper">
<div class="account-content">
<div class="login-wrapper">
    
<div class="login-img">
<img style="object-fit: cover;" src="https://oldmillautos.com/wp-content/uploads/2020/04/Automotive-Car-Repair-Shop.jpg" alt="img">
</div>

<div class="login-content">
<div class="login-userset">
<div class="login-logo">

<div class="d-flex align-items-center">
    <img width="50" src="../assets/img/system/autoservice_logo.jpg" alt="img">
    <h4 class="ml-2">autoservice.lk</h4>
</div>

</div>

<div class="login-userheading">
<h3 class="m-0">Create an Account</h3>
<h4 class="m-0">Please Create a Service Station Account</h4>
</div>
<div class="form-login">
<label>Service Station</label>
<div class="form-addons">
<input type="text" placeholder="Enter Service Station Name">
<img src="../assets/img/icons/users1.svg" alt="img">
</div>
</div>
<div class="form-login">
<label>Service Station Logo</label>
<div class="form-addons">
<input accept="image/*" type="file" placeholder="Enter Image">
<!-- <img src="../assets/img/icons/mail.svg" alt="img"> -->
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
<h4>Already has a station? <a href="../auth/station-login.php" class="hover-a">Sign In</a></h4>
</div>

</div>
</div>



</div>
</div>
</div>


<?php include_once '../includes/auth-footer.php'; ?>
</body>
</html>