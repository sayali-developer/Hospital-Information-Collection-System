<?php

require_once "../include.php";
if(!isset($sadmin))
    $sadmin = false;
$dep = new department();

if (!$dep->loggedIn()) {
    pageInfo("red", "Login First!");
    header("Location: ./");
    exit;
}

$user = $dep->getUser();
if($sadmin && !$user["is_superadmin"]) {
    pageInfo("red","You only have access to reports");
    header("Location: ./dashboard.php");
    exit;
}
$db = new db;
$con = $db->con();
$new_reg_req = 0;
try {
    $q = $con->query("SELECT count(*) as req_count FROM hospitals WHERE ac_status = 'REQUESTED'");
    $new_reg_req = $q->fetchAll(PDO::FETCH_ASSOC)[0]["req_count"];
}
catch (PDOException $e) {
    pageInfo("red", "Database Error, Please Try After Some Time");
}
?>
<!DOCTYPE html>
<html lang="en">
<!--================================================================================
  Item Name: Materialize - Material Design Admin Template
  Version: 4.0
  Author: PIXINVENT
  Author URL: https://themeforest.net/user/pixinvent/portfolio
================================================================================ -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <title><?= $title ?></title>
    <meta name="msapplication-TileColor" content="#00bcd4">
    <!-- CORE CSS-->
    <link href="../assets/theme/css/materialize.css" type="text/css" rel="stylesheet">
    <link href="../assets/theme/css/style.css" type="text/css" rel="stylesheet">
    <!-- Custome CSS-->
    <link href="../assets/theme/css/custom/custom.css" type="text/css" rel="stylesheet">
    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="../assets/theme/vendors/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet">
    <link href="../assets/theme/vendors/flag-icon/css/flag-icon.min.css" type="text/css" rel="stylesheet">

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/cr-1.5.2/fh-3.1.6/r-2.2.3/datatables.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.css" rel="stylesheet">

</head>
<body>
<!-- Start Page Loading -->
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<!-- End Page Loading -->
<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START HEADER -->
<header id="header" class="page-topbar">
    <!-- start header nav-->
    <div class="navbar-fixed">
        <nav class="navbar-color gradient-45deg-light-blue-cyan">
            <div class="nav-wrapper">
                <ul class="left">
                    <li>
                        <h1 class="logo-wrapper">
                            <a href="./" class="brand-logo darken-1">
                                <img src="../assets/logo/hics.png" align="center" alt="Logo">
                                <span class="logo-text hide-on-med-and-down">Admin Dashboard</span>
                            </a>
                        </h1>
                    </li>
                </ul>
                <ul class="right hide-on-med-and-down">
                    <li>
                        <a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen">
                            <i class="material-icons">settings_overscan</i>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="waves-effect waves-block waves-light profile-button"
                           data-activates="profile-dropdown">
                          <span class="avatar-status avatar-online">
                            <img src="../assets/theme/images/avatar/avatar-10.png" alt="avatar">
                            <i></i>
                          </span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- end header nav-->
</header>
<!-- END HEADER -->
<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START MAIN -->
<div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">
        <!-- START LEFT SIDEBAR NAV-->
        <aside id="left-sidebar-nav">
            <ul id="slide-out" class="side-nav fixed leftside-navigation">
                <li class="user-details cyan darken-2">
                    <div class="row">
                        <div class="col s12">

                            <!-- profile-dropdown -->
                            <ul id="profile-dropdown" class="dropdown-content">
                                <li>
                                    <a href="my-account.php" class="grey-text text-darken-1">
                                        <i class="material-icons">face</i> My Account</a>
                                </li>
                                <li>
                                    <a href="../logout.php" class="grey-text text-darken-1">
                                        <i class="material-icons">keyboard_tab</i> Logout</a>
                                </li>
                            </ul>
                            <a class="btn-flat waves-effect waves-light white-text profile-btn"
                               href="./my-account.php"><?= $user["name"] ?><i class="mdi-navigation-arrow-drop-down right"></i></a>
                            <p class="user-roal">Admin</p>
                        </div>
                    </div>
                </li>
                <li class="no-padding">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li class="bold">
                            <a href="./dashboard.php" class="waves-effect waves-cyan">
                                <i class="material-icons">dashboard</i>
                                <span class="nav-text">Dashboard</span>
                            </a>
                        </li>
                        <?php if ($user["is_superadmin"]): ?>
                        <li class="bold">
                            <a href="./requests.php" class="waves-effect waves-cyan">
                                <i class="material-icons">plus_one</i>
                                <span class="nav-text">New Reg Requests (<?= $new_reg_req ?>) </span>
                            </a>
                        </li>
                        <li class="bold">
                            <a href="./hospitals.php" class="waves-effect waves-cyan">
                                <i class="material-icons">local_hospital</i>
                                <span class="nav-text">Active Hospitals</span>
                            </a>
                        </li>
                        <li class="bold">
                            <a href="./deactivated-hosp.php" class="waves-effect waves-cyan">
                                <i class="material-icons">delete_outline</i>
                                <span class="nav-text">Deactivated Hospitals</span>
                            </a>
                        </li>
                        <li class="bold">
                            <a href="./admin-management.php" class="waves-effect waves-cyan">
                                <i class="material-icons">people</i>
                                <span class="nav-text">Admin Management</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li class="bold">
                            <a href="./reports.php" class="waves-effect waves-cyan">
                                <i class="material-icons">insert_chart_outlined</i>
                                <span class="nav-text">Reports</span>
                            </a>
                        </li>
                        <li class="bold">
                            <a href="./my-account.php" class="waves-effect waves-cyan">
                                <i class="material-icons">person</i>
                                <span class="nav-text">My Account</span>
                            </a>
                        </li>
                        <li class="bold">
                            <a href="../logout.php" class="waves-effect waves-cyan">
                                <i class="material-icons">keyboard_tab</i>
                                <span class="nav-text">Logout</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <a href="#" data-activates="slide-out"
               class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only">
                <i class="material-icons">menu</i>
            </a>
        </aside>
        <!-- END LEFT SIDEBAR NAV-->
        <!-- //////////////////////////////////////////////////////////////////////////// -->
        <!-- START CONTENT -->
        <section id="content">
            <!--start container-->
            <div class="container">
                <?php if(isset($_SESSION["PAGE_INFO"])): ?>
                <div class="row">
                    <div class="col s12">
                        <div class="card <?=$_SESSION["TYPE"] ?> lighten-1">
                            <div class="card-content white-text">
                                <p style="font-size: 18px"><?= $_SESSION["PAGE_INFO"] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php clearPageInfo(); endif; ?>
