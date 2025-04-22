<?php
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
$user = $dep->getUser();
if (isset($_POST["query"])) {
    $_SESSION["Q"] = $_POST["query"];
    $db = new db;
    $con = $db->con();
    try {
        $q = $con->query(trim($_POST["query"]));
        if ($q) {
            $d = "Successfully Executed Query!";
            try {
                $_SESSION["Q_DATA"] = $q->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                $_SESSION["Q_DATA"] = [];
            }
            pageInfo("green", $d);
            header("Location: ../dba.php");
            exit;
        } else {
            pageInfo("orange", "Failed!");
            header("Location: ../dba.php");
            exit;
        }

    } catch (PDOException $e) {
        pageInfo("red", $e->getMessage());
        header("Location: ../dba.php");
        exit;
    }

} else {
    pageInfo("red", "Empty Query");
    header("Location: ../dba.php");
    exit;
}
?>