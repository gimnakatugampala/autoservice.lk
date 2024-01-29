

<?php include_once '../includes/header.php';?>

<?php

session_start();
require_once '../includes/db_config.php';

if (!isset($_SESSION["station_id"]) || $_SESSION["station_id"] == null) {
  header('Location: ../auth/station-login.php');
  exit(); 
}

?>



<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img class="rounded-circle" width="60" height="60" src="../dist/img/system/logo_pistona.png" >
    <h6 class="my-2"><b><?php echo (isset($_SESSION["station_name"])) ?  $_SESSION["station_name"] : ''; ?></b></h6>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
     <h3 class="text-center">Employee Login</h3>
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="../vehicles/" method="post">
        <label class="form-label">Email address</label>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <label class="form-label">Password</label>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<?php include_once '../includes/footer.php';?>

</body>
</html>
