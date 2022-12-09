<?php
session_start();
if (isset($_SESSION['isLoggedIn'])) {
    if ($_SESSION["isLoggedIn"] != 'success') {
        Header('Location: ./');
    }
} else {
    Header('Location: ../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- BootStrap-CSS -->
  <link rel="stylesheet" href="../assets/styles/bootstrap.min.css">
  <!--FontAwesome -->
  <link rel="stylesheet" href="../assets/styles/all.min.css">
  <!-- Home-Module-CSS -->
  <link rel="stylesheet" href="../assets/styles/Home.module.css">
  <!-- Favicon -->
  <link rel="icon" href="../assets/img/logo.png">
  <!-- Page-Title -->
  <title>Dashboard | PIN Code</title>
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
    <section class="auth-form pb-100">
      <div class="container">
        <div class="row mx-auto py-50 d-flex justify-content-center align-items-center">
          <!-- Auth-Inputs -->
          <div class="auth-inputs col-12 col-lg-5 pt-5">
            <h2 class="text-uppercase">PIN Code</h2>
            <p class="text-muted mb-4 fs-6">To retrieve an account in the future, save your 6 digit PIN code.</p>
            <div class="auth-input has-validation">
              <label for="pincode" class="form-label">Set PIN Code</label>
              <input type="number" class="form-control" id="pincode" placeholder="Enter PIN Code">
              <i class="fa-solid fa-key"></i>
              <div class="invalid-feedback">Please enter 6 digit code.</div>
            </div>
            <div class="auth-input">
              <label for="confirmpincode" class="form-label">Confirm PIN Code</label>
              <input type="number" class="form-control" id="confirmpincode" placeholder="Confirm PIN Code">
              <i class="fa-solid fa-key"></i>
            </div>
            <div class="auth-btn">
              <button class="btn-primary" id="btn-savepin">SAVE</button>
            </div>
            <hr class="border-bottom mt-4">
            <div class="auth-href text-center">
              <p class="fs-6"><a href="./index.php" class="href-link">Go Back To Home Page</a></p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

    <!-- SCRIPTS -->
    <script src="../assets/scripts/bootstrap.bundle.min.js"></script>
    <script src="../assets/scripts/jquery.js"></script>
    <script src="../assets/scripts/sweetalert.js"></script>
    <script src="../assets/scripts/main.js"></script>
    <script src="../../middleware/pincode.js"></script>
</body>

</html>