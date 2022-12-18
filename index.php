<?php
session_start();
if (isset($_SESSION['isLoggedIn'])) {
  if ($_SESSION["isLoggedIn"] == 'success') {
    Header('Location: ./public/dashboard/');
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
  <link rel="stylesheet" href="public/assets/styles/bootstrap.min.css">
  <!--FontAwesome -->
  <link rel="stylesheet" href="public/assets/styles/all.min.css">
  <!-- Home-Module-CSS -->
  <link rel="stylesheet" href="public/assets/styles/Home.module.css">
  <!-- Favicon -->
  <link rel="icon" href="public/assets/img/logo.png">
  <!-- Page-Title -->
  <title>AllWrite: The All-Purpose Note-Taking Web Application</title>
</head>

<body>
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
  <main>
    <header>
      <nav class="navbar navbar-expand-lg ">
        <div class="container border-bottom py-3">
          <div class="navbar-brand d-flex align-items-center">
            <img class="logo" src="public/assets/img/logo.png" alt="...">
            <span class="logo-title">AllWrite</span>
          </div>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav d-flex align-items-center ms-auto">
              <li class="nav-item">
                <a class="nav-link" href="public/login">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="public/register"><button class="btn-primary-v2">Create Account</button></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <!-- HomePage-Section -->
    <section class="homepage my-100">
      <div class="container">
        <div class="homepage-wrapper d-flex flex-column justify-content-center align-items-center text-center">
          <h1>All-Purpose Note-Taking</h1>
          <h2 class="col-12 col-lg-8">Keep track of your notes, ideas, and to-do lists in one place.
          </h2>
          <p class="col-12 col-lg-7">
            The AllWrite web application is a tool for creating and organizing notes and tasks.
            It includes features such as a to-do list and an assignment list to help users keep
            track of tasks and deadlines. These features work together to provide a comprehensive
            and user-friendly tool for staying organized and productive.
          </p>
          <a href="public/register"><button class="btn-primary-v2 mb-3 mt-2 d-flex align-items-center">Create an Account <span
              class="badge text-bg-success ms-2">FREE</span></button></a>
          <a href="public/login" class="href-link">Already on AllWrite? Login</a>
        </div>
      </div>
    </section>
    <!-- Footer -->
    <footer class="text-center fixed-bottom bg-light">
      <p class="fw-medium text-muted mt-4">Copyright 2022 - <a href="index" class="href-link">AllWrite</a>. All Rights
        Reserved.</p>
    </footer>
  </main>

  <!-- SCRIPTS -->
  <script src="public/assets/scripts/bootstrap.bundle.min.js"></script>
  <script src="public/assets/scripts/jquery.js"></script>
  <script src="public/assets/scripts/main.js"></script>
</body>

</html>