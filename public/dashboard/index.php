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
    <title>Dashboard - Home</title>
</head>

<body class="dashboard-body">
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
        <!-- Navigation -->
        <section class="navigation">
            <div class="navigation-wrapper">
                <!-- NavBar -->
                <div class="navbar-inner-wrap">
                    <nav class="navbar navbar-expand-lg nav-head">
                        <button class="btn btn-hamburger d-block d-lg-none me-2" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling"
                            aria-controls="offcanvasScrolling">
                            <i class="fa-solid fa-bars"></i>
                        </button>
                        <a href="#">
                            <div class="navbar-brand d-flex align-items-center d-none d-lg-block">
                                <img class="logo" src="../assets/img/logo.png" alt="...">
                                <span class="logo-title">AllWrite</span>
                            </div>
                        </a>
                        <div class="ms-auto" id="navbarNav">
                            <ul class="navbar-nav d-flex align-items-center flex-row gap-2 gap-lg-3">
                                <li class="nav-item nav-settings">
                                    <div class="nav-link dropdown" data-bs-toggle="dropdown" aria-expanded="true">
                                        <img src="../assets/img/profile-male.png" alt="..." style="width: 45px;">
                                        <!-- User-Profile -->
                                        <span class="profile-name d-none d-lg-inline" id="profile-name">User</span>
                                        <i class="fa-solid fa-chevron-down"></i>
                                        <!-- Head-Nav-Dropdown-Menu -->
                                        <ul class="dropdown-menu mt-2">
                                            <li class="dropdown-item" id="btn-pincode">PIN Code</li>
                                            <li class="dropdown-item" id="btn-changepass">Change Password</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <button class="dropdown-item" id="btn-logout"><i class="fa-solid fa-right-to-bracket"></i> Logout</button>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <!-- SideBar-OffCanvas -->
                <div class="offcanvas offcanvas-start w-auto" data-bs-scroll="true" data-bs-backdrop="true"
                    tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                    <div class="offcanvas-header">
                        <a href="#" class="offcanvas-title" id="offcanvasScrollingLabel">
                            <div class="navbar-brand d-flex align-items-center">
                                <img class="logo" src="../assets/img/logo.png" alt="...">
                                <span class="logo-title">AllWrite</span>
                            </div>
                        </a>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <!-- Offcanvas-Sidebar-For-Mobile-Screen -->
                    <div class="row">
                        <div class="col-sm-auto">
                            <nav class="navbar d-flex flex-sm-column flex-row flex-nowrap sticky-top">
                                <ul class="sidebar-nav">
                                    <li class="nav-item active">
                                        <a href="#" class="nav-link py-3 px-2">
                                            <i class="fa-solid fa-house"></i> Home
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="subject.php" class="nav-link py-3 px-2">
                                            <span><i class="fa-solid fa-book"></i> Subject</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="assignment.php" class="nav-link py-3 px-2">
                                            <span><i class="fa-solid fa-calendar"></i> Assignment</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="resources.php" class="nav-link py-3 px-2">
                                            <span><i class="fa-solid fa-arrow-up-right-from-square"></i>
                                                Resources</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="todo.php" class="nav-link py-3 px-2">
                                            <span><i class="fa-solid fa-list"></i> To-Do List</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Dashboard -->
        <section class="dashboard">
            <div class="row">
                <!-- Sidebar-For-Large-Screen -->
                <div class="col-sm-auto d-none d-lg-flex">
                    <nav class="navbar d-flex flex-sm-column flex-row flex-nowrap sticky-top">
                        <ul class="sidebar-nav">
                            <li class="nav-item active">
                                <a href="#" class="nav-link py-3 px-2">
                                    <i class="fa-solid fa-house"></i> Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="subject.php" class="nav-link py-3 px-2">
                                    <span><i class="fa-solid fa-book"></i> Subject Notes</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="assignment.php" class="nav-link py-3 px-2">
                                    <span><i class="fa-solid fa-calendar"></i> Assignment</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="resources.php" class="nav-link py-3 px-2">
                                    <span><i class="fa-solid fa-arrow-up-right-from-square"></i> Resources</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="todo.php" class="nav-link py-3 px-2">
                                    <span><i class="fa-solid fa-list"></i> To-Do List</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- Dashboard-Body -->
                <div class="col-sm p-3">
                    <!-- Body-Content -->
                    <div class="dashboard-inner-wrap">
                        <div class="dashboard-content">
                            <div class="container mt-5">
                                <div class="dashboard-title d-flex align-items-center mb-5">
                                    <i class="fa-solid fa-house"></i>
                                    <h4>Dashboard</h3>
                                </div>
                                <!-- Dashboard-Overview -->
                                <div class="row">
                                    <div class="col-sm-6 mb-4">
                                        <div class="card card-box-1">
                                            <div class="card-body">
                                                <h5 class="card-title">Subject Notes</h5>
                                                <h6 class="card-subtitle mb-2">Total: <span id="totalSubNote">0</span></h6>
                                                <a href="subject.php" class="card-link" id="card-link1">See All <i
                                                        class="fa-solid fa-arrow-right-long" id="sub-arrow"></i></a>
                                                <div class="circle">
                                                    <img src="../assets/img/circle.png" alt="...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-4">
                                        <div class="card card-box-2">
                                            <div class="card-body">
                                                <h5 class="card-title">Assignment</h5>
                                                <h6 class="card-subtitle mb-2">Total: <span id="totalAssignment">0</span></h6>
                                                <a href="assignment.php" class="card-link" id="card-link2">See All <i
                                                        class="fa-solid fa-arrow-right-long" id="ass-arrow"></i></a>
                                                <div class="circle">
                                                    <img src="../assets/img/circle.png" alt="...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-4">
                                        <div class="card card-box-3">
                                            <div class="card-body">
                                                <h5 class="card-title">Resources</h5>
                                                <h6 class="card-subtitle mb-2">Total: <span id="totalResources">0</span></h6>
                                                <a href="resources.php" class="card-link" id="card-link3">See All <i
                                                        class="fa-solid fa-arrow-right-long" id="src-arrow"></i></a>
                                                <div class="circle">
                                                    <img src="../assets/img/circle.png" alt="...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-4">
                                        <div class="card card-box-4">
                                            <div class="card-body">
                                                <h5 class="card-title">To-Do List</h5>
                                                <h6 class="card-subtitle mb-2">Total: <span id="totalTodo">0</span></h6>
                                                <a href="todo.php" class="card-link" id="card-link4">See All <i
                                                        class="fa-solid fa-arrow-right-long" id="todo-arrow"></i></a>
                                                <div class="circle">
                                                    <img src="../assets/img/circle.png" alt="...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Footer -->
                                <footer class="text-center">
                                    <hr class="border-bottom">
                                    <p class="fw-medium text-muted mt-4">Copyright 2022 - <a href="#"
                                            class="href-link">AllWrite</a>. All Rights Reserved.</p>
                                </footer>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- SCRIPTS -->
    <script src="../assets/scripts/bootstrap.bundle.min.js"></script>
    <script src="../assets/scripts/jquery.js"></script>
    <script src="../assets/scripts/main.js"></script>
    <script src="../../middleware/dashboard.js"></script>
</body>

</html>