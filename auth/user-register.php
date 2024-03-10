

<?php include_once '../includes/header.php';?>


<?php

// session_start();
require_once '../includes/db_config.php';

if (!isset($_SESSION["station_id"]) || $_SESSION["station_id"] == null) {
  header('Location: ../auth/station-login.php');
  exit(); 
}else{

  $sql = "SELECT * FROM employee WHERE service_station_id = '{$_SESSION["station_id"]}' AND user_type_id = 1";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    header('Location: ../auth/station-login.php');
    exit(); 
  }

}

?>


<!-- login-page -->
<body class="d-flex justify-content-center align-items-center h-100 mt-5 bg-light hold-transition">
<div class="login-box">
  <div class="login-logo">
    <img class="rounded-circle" width="60" height="60"  src=<?php echo (isset($_SESSION["station_img"])) ?  '../uploads/stations/' . $_SESSION["station_img"] : '../assets/img/no-image.png'; ?> >
    <h6 class="my-2"><b><?php echo (isset($_SESSION["station_name"])) ?  $_SESSION["station_name"] : ''; ?></b></h6>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
     <h3 class="text-center">Admin Register</h3>
      <p class="login-box-msg">Register to start your session</p>

   

        <label class="form-label">Email address</label>
        <div class="input-group mb-3">
          <input id="email" type="email" class="form-control" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <label class="form-label">Password</label>
        <div class="input-group mb-3">
          <input id="pass" type="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <label class="form-label">Confirm Password</label>
        <div class="input-group mb-3">
          <input id="con_pass" type="password" class="form-control" placeholder="Password">
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
            <button id="btn-user-reg" type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>

  
      

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
