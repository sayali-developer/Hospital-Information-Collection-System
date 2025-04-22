<?php
require_once "../../include.php";
$dep = new department();
if (!$dep->loggedIn()) {
    header("Location: ../");
    exit;
}
$user = $dep->getUser();
if ($user["is_superadmin"] == 0) {
    pageInfo("red", "You only have access to reports!");
    header("Location: ../dashboard.php");
    exit;
}
if (isset($_POST["password"]) && isset($_POST["password_con"]) && isset($_POST["id"])) {
    if (strlen($_POST["id"]) <> 36) {
        header("Location: ../viewHospital.php?id=" . $_POST["id"]);
        exit;
    }
    if ($_POST["password"] == $_POST["password_con"]) {

        if (strlen($_POST["password"]) < 8) {
            pageInfo("warning", "Password Should Have At Least 8 Characters!");
            header("Location: ../viewHospital.php?id=" . $_POST["id"]);
            exit;
        }
        $db = new db();
        $stmt = "UPDATE hospitals SET password = ? WHERE uqid = ?";
        $q = $db->con()->prepare($stmt);
        try {
            $q->execute([hash_password($_POST["password"]), $_POST["id"]]);

            pageInfo("green", "Password Changed Successfully For This Hospital!");
            header("Location: ../viewHospital.php?id=" . $_POST["id"]);
            exit;
        } catch (PDOException $e) {
            pageInfo("red", "Failed to change password due to database error!");
            header("Location: ../viewHospital.php?id=" . $_POST["id"]);
            exit;

        }
    } else {
        pageInfo("red", "New Password And Confirmed Password Should Be Same!");
        header("Location: ../viewHospital.php?id=" . $_POST["id"]);
        exit;

    }

} else {
    pageInfo("red", "Fields Missing, while changing hospital password!");
    header("Location: ../dashboard.php");
    exit;
}

?>