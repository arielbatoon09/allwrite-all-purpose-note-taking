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
  <title>AllWrite | Login</title>
</head>

<body class="auth-body">
    <!-- Pre-Loader -->
    <div class="preloader">
        <div class="loader">
            <div class="spinner">
                <div class="spinner-container">
                    <div class="spinner-rotator">
                        <div class="spinner-left">
                            <div class="spinner-circle"></div>
                        </div>
                        <div class="spinner-right">
                            <div class="spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>     
  <!-- Main-Container -->
  <main class="page">
    <!-- Authentication-Section -->
    <section class="auth-form py-100">
      <div class="container">
        <div class="row mx-auto d-flex justify-content-center align-items-center">
        <div>
          <a href="../index"><p class="text-center href-link">Go Back To Home Page</p></a>
        </div>
          <!-- Auth-Inputs -->
          <div class="auth-inputs col-12 col-lg-5 pt-5">
            <p class="text-muted mb-1">Welcome to AllWrite 👋</p>
            <h2 class="text-uppercase mb-4">Login Panel</h2>
            <div class="auth-input has-validation">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" placeholder="Enter Email Address">
              <i class="fa-solid fa-envelope"></i>
              <div class="invalid-feedback">
								Please include an "@" in the email address.
							</div>
            </div>
            <div class="auth-input">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" placeholder="Enter Password">
              <i class="fa-solid fa-lock"></i>
            </div>
            <div class="auth-forgot mb-4 ms-1">
              <a href="forgotpassword.php" class="href-link fw-semibold">Forgot Password?</a>
            </div>
            <div class="auth-btn">
              <button class="btn-primary" id="btn-login">Login</button>
            </div>
            <hr class="border-bottom mt-4">
            <div class="auth-href text-center">
              <p class="fs-6">Don't have an account? <a href="register" class="href-link">Register</a></p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- SCRIPTS -->
  <script src="assets/scripts/bootstrap.min.js"></script>
  <script src="assets/scripts/jquery.js"></script>
  <script src="assets/scripts/main.js"></script>
  <script src="assets/scripts/sweetalert.js"></script>
  <script src="../middleware/login.js"></script>
</body>

</html>