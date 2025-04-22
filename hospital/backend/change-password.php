<?php
require_once "../../include.php";
$hosp = new hospital();
if (!$hosp->loggedIn()) {
    header("Location: ../");
    exit;
}
$user = $hosp->getUser();

if (isset($_POST["password_old"]) && isset($_POST["password"]) && isset($_POST["password_con"])) {
    if ($user["password"] == hash_password($_POST["password_old"])) {

        if ($_POST["password"] == $_POST["password_con"]) {
            if (strlen($_POST["password"]) < 8) {
                pageInfo("warning", "Password Should Have At Least 8 Characters!");
                header("Location: ../my-account.php");
                exit;
            }
            $db = new db();
            $stmt = "UPDATE hospitals SET password = ? WHERE hospital_id = ?";
            $q = $db->con()->prepare($stmt);
            try {
                $q->execute([hash_password($_POST["password"]), $user["hospital_id"]]);

                pageInfo("green", "Password Changed Successfully!");
                header("Location: ../my-account.php");
                exit;
            } catch (PDOException $e) {
                pageInfo("red", "Failed to change password due to database error!");
                header("Location: ../my-account.php");
                exit;

            }
        } else {
            pageInfo("red", "New Password And Confirmed Password Should Be Same!");
            header("Location: ../my-account.php");
            exit;

        }

    } else {
        pageInfo("red", "Invalid Old Password!");
        header("Location: ../my-account.php");
        exit;

    }
} else {
    pageInfo("red", "Fields Missing!");
    header("Location: ../my-account.php");
    exit;
}

?>