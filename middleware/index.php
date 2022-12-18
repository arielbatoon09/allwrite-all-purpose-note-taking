<?php 
session_start();
if(isset($_SESSION['isLoggedIn'])){
  if($_SESSION["isLoggedIn"] == 'success'){
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
  <meta http-equiv="Refresh" content="0; url='../index.php'/>
  <!-- Page-Title -->
  <title>AllWrite: The All-Purpose Note-Taking Web Application</title>
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
  <!-- SCRIPTS -->
  <script src="public/assets/scripts/bootstrap.min.js"></script>
  <script src="public/assets/scripts/jquery.js"></script>
  <script src="public/assets/scripts/main.js"></script>
</body>

</html>