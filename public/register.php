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
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- BootStrap-CSS -->
	<link rel="stylesheet" href="assets/styles/bootstrap.min.css" />
	<!--FontAwesome -->
	<link rel="stylesheet" href="assets/styles/all.min.css" />
	<!-- Home-Module-CSS -->
	<link rel="stylesheet" href="assets/styles/Home.module.css" />
	<!-- Favicon -->
	<link rel="icon" href="assets/img/logo.png" />
	<!-- Page-Title -->
	<title>AllWrite | Register</title>
</head>

<body class="auth-body">
	<!-- Main-Container -->
	<main class="page">
		<!-- Authentication-Section -->
		<section class="auth-form pb-100">
			<div class="container">
				<div class="auth-wrapper row mx-auto my-50">
					<!-- Auth-About -->
					<div class="auth-left col-lg-6 mb-3 mb-lg-0">
						<div class="auth-brand">
							<img src="assets/img/logo.png" alt="..." />
							<h1>allwrite</h1>
						</div>
						<img class="d-none d-lg-block" src="assets/img/auth-img.svg" alt="..." />
					</div>
					<!-- Auth-Inputs -->
					<div class="auth-right col-lg-6">
						<h2 class="text-uppercase mb-4">Create an account</h2>
						<div class="auth-input">
							<label for="fullname" class="form-label">Full Name:</label>
							<input type="text" class="form-control" id="fullname" placeholder="Enter Fullname" />
							<i class="fa-solid fa-user"></i>
						</div>
						<div class="auth-input has-validation">
							<label for="email" class="form-label">E-Mail Address:</label>
							<input type="email" class="form-control" id="email" placeholder="Enter E-Mail Address" />
							<i class="fa-solid fa-envelope"></i>
							<div class="invalid-feedback">
								Please include an "@" in the email address.
							</div>
						</div>
						<div class="auth-input has-validation">
							<label for="password" class="form-label">Password:</label>
							<input type="password" class="form-control" id="password" placeholder="Enter Password" />
							<i class="fa-solid fa-lock"></i>
							<div class="invalid-feedback">
								Please enter 6 - 12 characters.
							</div>
						</div>
						<div class="auth-input">
							<label for="confirmpass" class="form-label">Confirm Password:</label>
							<input type="password" class="form-control" id="confirmpass"
								placeholder="Confirm Password" />
							<i class="fa-solid fa-lock"></i>
						</div>
						<div class="auth-terms">
							<input type="checkbox" id="agreePolicy" name="agree" />
							<label for="agree" class="form-label text-muted">I've read and agree the
								<a href="#" class="href-link">Terms and Conditions</a></label>
						</div>
						<div class="auth-btn">
							<button class="btn-primary" id="btn-register">Register</button>
						</div>
						<hr class="border-bottom mt-4" />
						<div class="auth-href text-center py-2">
							<p>
								Already have an account?
								<a href="login.php" class="href-link">Login</a>
							</p>
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
	<script src="../middleware/register.js"></script>
</body>

</html>