<?php
if (!(isset($_GET["state"]) && isset($_GET["id"]))) {
    pageInfo("red", "Invalid Action");
    header("Location: ../dashboard.php");
    exit;
}
if (!($_GET["state"] == "activate" || $_GET["state"] == "deactivate" || $_GET["state"]) == "reject") {
    pageInfo("red", "Invalid Action");
    header("Location: ../dashboard.php");
    exit;
}
if (strlen(trim($_GET["id"])) != 36) {
    pageInfo("red", "Invalid Action");
    header("Location: ../dashboard.php");
    exit;
}
require_once "../../include.php";
$dep = new department();
if (!$dep->loggedIn()) {
    pageInfo("red", "Login First!");
    header("Location: ../");
    exit;
}
if ($dep->getUser()["is_superadmin"] == 0) {
    pageInfo("red", "You only have access to reports!");
    header("Location: ../dashboard.php");
    exit;
}
$db = new db();
$con = $db->con();
if ($_GET["state"] == "activate") {
    $q = $con->prepare("UPDATE hospitals SET ac_status = 'ACTIVE' WHERE uqid = ? AND (ac_status = 'REQUESTED' OR ac_status = 'DEACTIVATED')");
    $s = "Activated";
} else if ($_GET["state"] == "deactivate") {
    $q = $con->prepare("UPDATE hospitals SET ac_status = 'DEACTIVATED' WHERE uqid = ? AND (ac_status = 'ACTIVE')");
    $s = "Deactivated";
} else if ($_GET["state"] == "reject") {
    $q = $con->prepare("UPDATE hospitals SET ac_status = 'REJECTED' WHERE uqid = ? AND (ac_status = 'REQUESTED')");
    $s = "Rejected";
}
try {
    $q->execute([trim($_GET["id"])]);
    pageInfo("green", "Successfully " . $s . " Hospital.");
    header("Location: ../viewHospital.php?id=" . $_GET["id"]);
    exit;
} catch (PDOException $e) {

    pageInfo("red", "Database Error, Please Try After Some Time!");
    header("Location: ../viewHospital.php?id=" . $_GET["id"]);
    exit;
}