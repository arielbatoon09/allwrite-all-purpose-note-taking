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
  <title>404 Page Not Found</title>
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
    <!-- 404-Section -->
    <section class="d-flex flex-column justify-content-center align-items-center w-100" style="height: 100vh;">
        <h1>404 ERROR!!!</h1>
        <h1>PAGE NOT FOUND</h1>
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