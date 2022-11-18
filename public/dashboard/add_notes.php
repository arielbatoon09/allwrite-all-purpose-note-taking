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
    <title>Dashboard - Add Notes</title>
</head>

<body class="dashboard-body">
    <!-- Main-Container -->
    <main class="page">
        <!-- Navigation -->
        <section class="navigation">
            <div class="container">
                <center class="d-flex flex-column mt-5 w-100">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-floating mb-3">
                                <input type="title" class="form-control" id="title"
                                    placeholder="Title">
                                <label for="title">Title</label>
                            </div>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="description"
                                    placeholder="Description">
                                <label for="description">Description</label>
                            </div>
                            <div class="button my-5">
                                <button class="btn btn-success w-100" id="btn-add-notes">Add Notes</button>
                            </div>
                            <a href="../dashboard/subject.php">
                                <button class="btn btn-primary w-25">Go Back</button>
                            </a>
                        </div>
                    </div>
                </center>
            </div>
        </section>
    </main>

    <!-- SCRIPTS -->
    <script src="../assets/scripts/bootstrap.bundle.min.js"></script>
    <script src="../assets/scripts/jquery.js"></script>
    <script src="../assets/scripts/main.js"></script>
    <script src="../../middleware/addSubNotes.js"></script>
</body>

</html>