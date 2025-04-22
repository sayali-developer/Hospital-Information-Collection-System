<?php

require_once "../../include.php";
$hosp = new hospital();
if (!$hosp->loggedIn()) {
    header("Location: ../");
    exit;
}
$user = $hosp->getUser();
if (
    isset($_POST["no_of_beds"]) &&
    isset($_POST["no_of_wards"]) &&
    isset($_POST["no_of_docs"]) &&
    isset($_POST["no_of_nurses"]) &&
    isset($_POST["no_of_other_staff"]) &&
    isset($_POST["no_of_amb"]) &&
    isset($_POST["no_of_ppe"]) &&
    isset($_POST["no_of_vent"]) &&
    isset($_POST["no_of_o2_cel"]) &&
    isset($_POST["no_of_o2_conc"]) &&
    isset($_POST["no_of_monitors"]) &&
    isset($_POST["no_of_monitors"])
) {
    $no_of_beds = filter_var($_POST["no_of_beds"], FILTER_VALIDATE_INT);
    $no_of_wards = filter_var($_POST["no_of_wards"], FILTER_VALIDATE_INT);
    $no_of_docs = filter_var($_POST["no_of_docs"], FILTER_VALIDATE_INT);
    $no_of_nurses = filter_var($_POST["no_of_nurses"], FILTER_VALIDATE_INT);
    $no_of_other_staff = filter_var($_POST["no_of_other_staff"], FILTER_VALIDATE_INT);
    $no_of_amb = filter_var($_POST["no_of_amb"], FILTER_VALIDATE_INT);
    $no_of_ppe = filter_var($_POST["no_of_ppe"], FILTER_VALIDATE_INT);
    $no_of_vent = filter_var($_POST["no_of_vent"], FILTER_VALIDATE_INT);
    $no_of_o2_cel = filter_var($_POST["no_of_o2_cel"], FILTER_VALIDATE_INT);
    $no_of_o2_conc = filter_var($_POST["no_of_o2_conc"], FILTER_VALIDATE_INT);
    $no_of_monitors = filter_var($_POST["no_of_monitors"], FILTER_VALIDATE_INT);
    $no_of_neb = filter_var($_POST["no_of_neb"], FILTER_VALIDATE_INT);
    $nums = [
        $no_of_beds, $no_of_wards, $no_of_docs,
        $no_of_nurses, $no_of_other_staff,
        $no_of_amb, $no_of_ppe, $no_of_vent,
        $no_of_o2_cel, $no_of_o2_conc,
        $no_of_monitors, $no_of_neb
    ];
    if ($no_of_docs < 1) {
        pageInfo("red", "Number of doctors can't be zero!");
        header("Location: ../update.php");
        exit;
    }
    if (validateNums($nums)) {
        array_push($nums, $user["uqid"]);
        $db = new db;
        $con = $db->con();
        $stmt = $con->prepare("
                        UPDATE hospitals SET 
                            no_of_beds = ?, 
                            no_of_wards = ?, 
                            no_of_docs = ?,
                            no_of_nurses = ?,
                            no_of_other_staff = ?,                    
                            no_of_ambs = ?,
                            no_of_ppe = ?,
                            no_of_vents = ?,
                            no_of_o2_cel = ?,
                            no_of_o2_conc = ?,
                            no_of_monitors = ?,
                            no_of_nebs = ?
                        WHERE 
                            uqid = ?
                     ");
        try {
            $stmt->execute($nums);
            pageInfo("green", "Successfully Updated Details!");
            header("Location: ../update.php");
            exit;

        } catch (PDOException $e) {
            pageInfo("orange", "Failed due to database error!");
            header("Location: ../update.php");
            exit;
        }
    } else {
        pageInfo("red", "Invalid Fields, Please Check Again!");
        header("Location: ../update.php");
        exit;
    }
} else {
    pageInfo("red", "Fields Missing, Please Check Again!");
    header("Location: ../update.php");
    exit;
}
