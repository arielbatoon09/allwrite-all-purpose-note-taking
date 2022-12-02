<?php 
session_start();
if(isset($_SESSION['isLoggedIn'])){
  if($_SESSION["isLoggedIn"] == 'success'){
    Header('Location: ../public/dashboard/');
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- BootStrap-CSS -->
  <link rel="stylesheet" href="assets/styles/bootstrap.min.css">
  <!--FontAwesome -->
  <link rel="stylesheet" href="assets/styles/all.min.css">
  <!-- Home-Module-CSS -->
  <link rel="stylesheet" href="assets/styles/Home.module.css">
  <!-- Favicon -->
  <link rel="icon" href="assets/img/logo.png">
  <!-- Page-Title -->
  <title>AllWrite | Retrieve Password</title>
</head>

<body class="auth-body">
  <!-- Main-Container -->
  <main class="page">
    <!-- Authentication-Section -->
    <section class="auth-form pb-100">
      <div class="container">
        <div class="row mx-auto py-50 d-flex justify-content-center align-items-center">
          <!-- Auth-Inputs -->
          <div class="auth-inputs col-12 col-lg-5 pt-5">
            <h2 class="text-uppercase mb-4">FORGOT PASSWORD</h2>
            <div class="auth-input">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" placeholder="Enter Email Address">
              <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="auth-input">
              <label for="pincode" class="form-label">PIN Code</label>
              <input type="text" class="form-control" id="pincode" placeholder="Enter PIN Code">
              <i class="fa-solid fa-key"></i>
            </div>
            <div class="auth-input has-validation">
              <label for="newpassword" class="form-label">New Password</label>
              <input type="password" class="form-control" id="newpassword" placeholder="Enter New Password">
              <i class="fa-solid fa-lock"></i>
              <div class="invalid-feedback">Please enter 6 - 12 characters.</div>
            </div>
            <div class="auth-btn">
              <button class="btn-primary" id="btn-forgot">UPDATE</button>
            </div>
            <hr class="border-bottom mt-4">
            <div class="auth-href text-center">
                <p class="fs-6"><a href="./login.php" class="href-link">Go Back To Login Page</a></p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- SCRIPTS -->
  <script src="assets/scripts/bootstrap.min.js"></script>
  <script src="assets/scripts/jquery.js"></script>
  <script src="assets/scripts/sweetalert.js"></script>
  <script src="../middleware/forgot.js"></script>
</body>

</html>