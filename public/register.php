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
		<section class="auth-form">
			<div class="container">
				<div class="row mx-auto d-flex justify-content-center align-items-center">
				<div>
					<a href="../index"><p class="text-center href-link">Go Back To Home Page</p></a>
				</div>
					<!-- Auth-Inputs -->
					<div class="auth-inputs col-12 col-lg-6 pt-5">
						<h2 class="text-uppercase">Create an account</h2>
						<p class="text-muted mb-4">to enjoy all of the cool features ✌️</p>
						<div class="d-block d-sm-flex gap-2">
							<div class="auth-input">
								<label for="firstname" class="form-label">First Name</label>
								<input type="text" class="form-control" id="firstname" placeholder="First Name" />
								<i class="fa-solid fa-user"></i>
							</div>
							<div class="auth-input">
								<label for="lastname" class="form-label">Last Name</label>
								<input type="text" class="form-control" id="lastname" placeholder="Last Name" />
								<i class="fa-solid fa-user"></i>
							</div>
						</div>
						<div class="auth-input has-validation">
							<label for="email" class="form-label">Email Address</label>
							<input type="email" class="form-control" id="email" placeholder="Enter Email Address" />
							<i class="fa-solid fa-envelope"></i>
							<div class="invalid-feedback">
								Please include an "@" in the email address.
							</div>
						</div>
						<div class="auth-input has-validation">
							<label for="password" class="form-label">Password</label>
							<input type="password" class="form-control" id="password" placeholder="Enter Password" />
							<i class="fa-solid fa-lock"></i>
							<div class="invalid-feedback">
								Please enter 6 - 12 characters.
							</div>
						</div>
						<div class="auth-input">
							<label for="confirmpass" class="form-label">Confirm Password</label>
							<input type="password" class="form-control" id="confirmpass"
								placeholder="Confirm Password" />
							<i class="fa-solid fa-unlock"></i>
						</div>
						<div class="form-check form-check-inline mb-4">
							<input class="form-check-input" type="checkbox" id="agreePolicy" value="option1">
							<label class="form-check-label" for="agreePolicy"> I accept the <a href="#" class="href-link">
								Terms and Agreement
							</a> to use the service.</label>
						</div>
						<div class="auth-btn">
							<button class="btn-primary" id="btn-register">Register</button>
						</div>
						<hr class="border-bottom mt-4" />
						<div class="auth-href text-center">
							<p class="fs-6">
								Already have an account?
								<a href="login" class="href-link">Login</a>
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
	<script src="assets/scripts/main.js"></script>
	<script src="assets/scripts/sweetalert.js"></script>
	<script src="../middleware/register.js"></script>
</body>

</html>