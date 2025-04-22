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
if (isset($_POST["password"]) && isset($_POST["password_con"])) {

    if ($_POST["password"] == $_POST["password_con"]) {
        if (strlen($_POST["password"]) < 8) {
            pageInfo("warning", "Password Should Have At Least 8 Characters!");
            header("Location: ../admin-management.php");
            exit;
        }
        $db = new db();
        $stmt = "UPDATE data_admins SET password = ? WHERE is_superadmin =0";
        $q = $db->con()->prepare($stmt);
        try {
            $q->execute([hash_password($_POST["password"])]);

            pageInfo("green", "Password Changed Successfully For radmin!");
            header("Location: ../admin-management.php");
            exit;
        } catch (PDOException $e) {
            pageInfo("red", "Failed to change password due to database error!");
            header("Location: ../admin-management.php");
            exit;

        }
    } else {
        pageInfo("red", "New Password And Confirmed Password Should Be Same!");
        header("Location: ../admin-management.php");
        exit;

    }

} else {
    pageInfo("red", "Fields Missing!");
    header("Location: ../admin-management.php");
    exit;
}

?>