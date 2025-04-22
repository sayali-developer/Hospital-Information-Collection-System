<?php
require_once "../../include.php";
$hosp = new hospital();
if (!$hosp->loggedIn()) {
    header("Location: ../");
    exit;
}
$user = $hosp->getUser();

if (
    isset($_POST["date"]) &&
    isset($_POST["no_opd"]) &&
    isset($_POST["no_ipd"]) &&
    isset($_POST["no_surge"]) &&
    isset($_POST["no_cov"])
) {
    $date = explode("-", $_POST["date"]);
    $opd = filter_var($_POST["no_opd"], FILTER_VALIDATE_INT);
    $ipd = filter_var($_POST["no_ipd"], FILTER_VALIDATE_INT);
    $surge = filter_var($_POST["no_surge"], FILTER_VALIDATE_INT);
    $cov = filter_var($_POST["no_cov"], FILTER_VALIDATE_INT);
    $occ = filter_var($_POST["no_occ"], FILTER_VALIDATE_INT);
    $emp = filter_var($_POST["no_emp"], FILTER_VALIDATE_INT);
    if (checkdate($date[1], $date[2], $date[0])) {
        if ($_POST["date"] < "2020-03-01" || $_POST["date"] > date("Y-m-d", time())) {
            pageInfo("red", "You can't report for " . date("d/m/Y", strtotime($_POST["date"])));
            header("Location: ../dashboard.php");
            exit;
        }
    } else {
        pageInfo("red", "Please Enter Valid Date!");
        header("Location: ../dashboard.php");
        exit;
    }
    if(!(filter_var($opd, FILTER_VALIDATE_INT) === 0)) {
         if (!$opd || ($opd < 0 || $opd > 1000)) {
            pageInfo("red", "Please Enter Valid Number Of OPD Patients!");
            header("Location: ../dashboard.php");
            exit;
        }
    }
    if(!(filter_var($ipd, FILTER_VALIDATE_INT) === 0)) {
        if (!$ipd || ($ipd < 0 || $ipd > 1000)) {
            pageInfo("red", "Please Enter Valid Number Of IPD Patients!");
            header("Location: ../dashboard.php");
            exit;
        }
    }
    if (!(filter_var($surge, FILTER_VALIDATE_INT) === 0)) {
        if (!$surge || ($surge < 0 || $surge > 1000)) {
            pageInfo("red", "Please Enter Valid Number Of Surgeries!");
            header("Location: ../dashboard.php");
            exit;
        }
    }
    if ($occ + $emp != $user["no_of_beds"]) {
        pageInfo("red", "Please update your profile from update details page if you have any changes to the number of available beds as number of empty beds and occupied beds is not matching to the total available at your hospital i.e. " . $user["no_of_beds"] . "!");
        header("Location: ../dashboard.php");
        exit;
    }
    if (!(filter_var($cov, FILTER_VALIDATE_INT) === 0)) {
        if (!$cov || ($cov < 0 || $cov > 1000)) {
            pageInfo("red", "Please Enter Valid Number Of Covid Patients Referred To District Covid Facility!");
            header("Location: ../dashboard.php");
            exit;
        }
    }
    $db = new db();
    $con = $db->con();
    $q = $con->prepare("SELECT * FROM reporting WHERE hospital_id=? and rp_date = ?");
    try {
        $q->execute([$user["hospital_id"], date("Y-m-d", time())]);
        if ($q->rowCount() == 0) {
            $con->beginTransaction();
            $q = $con->prepare("INSERT INTO reporting (rp_date, no_opd, no_ipd, no_surg, no_cov, reg_ip, occupied_beds, empty_beds, hospital_id, uqid) VALUES (?,?,?,?,?,?,?,?,?, uuid())");
            $q->execute([$_POST["date"], $opd, $ipd, $surge, $cov, $_SERVER["REMOTE_ADDR"], $occ, $emp, $user["hospital_id"]]);
            $q = $con->prepare("UPDATE hospitals SET no_of_occ_beds = ?, ipd_rem = ? WHERE uqid = ?");
            $q->execute([$occ, $ipd, $user["uqid"]]);
            $con->commit();
            pageInfo("green", "Successfully Reported!");
            header("Location: ../");
            exit;
        } else {
            pageInfo("red", ucwords("Already Reported For " . date("d/m/Y", time()) . ". Can't Report Again!"));
            header("Location: ../");
            exit;
        }

    } catch (PDOException $e) {
        $con->rollBack();
	
        pageInfo("red", ucwords("Failed to report, database error occurred, please try after some time!"));
        header("Location: ../dashboard.php");
        exit;
    }

} else {
    pageInfo("red", "Fields Missing, Please Check Again!");
    header("Location: ../dashboard.php");
    exit;
}
