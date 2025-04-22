<?php

require_once "include.php";
if (
    isset($_POST["hosp_name"]) &&
    isset($_POST["hosp_type"]) &&
    isset($_POST["other_type"]) &&
    isset($_POST["subdist"]) &&
    isset($_POST["address"]) &&
    isset($_POST["mobile"]) &&
    isset($_POST["hosp_cat"]) &&
    isset($_POST["doc_name"]) &&
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
        $hosp_name = trim($_POST["hosp_name"]);
        $hosp_type = trim($_POST["hosp_type"]);
        $other_type = trim($_POST["other_type"]);
        $subdist = trim($_POST["subdist"]);
        $address = trim($_POST["address"]);
        $mobile = filter_var($_POST["mobile"], FILTER_VALIDATE_INT);
        $doc_name = trim($_POST["doc_name"]);
        $category = trim($_POST["hosp_cat"]);


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
        if (!validateNums($nums)) {
            ret400();
        }


    if (!($category == "private" || $category == "government")) {
            ret400();
        }

        if (strlen($hosp_name) < 5 || strlen($hosp_name) > 256) {
            ret400();
        }

        if (!($hosp_type == "ayurvedic" || $hosp_type == "allopathy" || $hosp_type == "homoeopathy" || $hosp_type == "unani" || $hosp_type == "other")) {
            ret400();
        }
        if ($hosp_type == "other") {
            if (strlen($other_type) < 3 || strlen($other_type) > 64) {
                ret400();
            }
            $hosp_type = "Other - (".$other_type.")";
        }
        if(!(
            $subdist == "Pune City" || $subdist == "Pimpri-Chinchwad City" || $subdist == "Haveli" || $subdist == "Khed" || $subdist == "Ambegaon" ||
            $subdist == "Junnar" || $subdist == "Shirur" || $subdist == "Daund" || $subdist == "Indapur" || $subdist == "Baramati" || $subdist == "Purandar" || $subdist == "Bhor" || $subdist == "Velhe" || $subdist == "Mulshi" || $subdist == "Maval"
        
       )) {
            ret400();
        }
        if(strlen($address) < 5 || strlen($address) > 512) {
            ret400();
        }
        if($mobile) {
            if($mobile < 100000000 || $mobile > 9999999999) {
                ret400();
            }
        } else {
            ret400();
        }
        if (strlen($doc_name) < 5 || strlen($doc_name) > 512) {
            ret400();
        }
        $db = new db;
        $con = $db->con();
        $q = $con->prepare("INSERT INTO hospitals 
            (
             mobile_number, 
             password, 
             hospital_name, 
             hospital_type, 
             name_of_doctor, 
             subdist, 
             address,
             ac_status, 
             uqid, 
             reg_ip,
             cat,
             no_of_beds,
             no_of_wards,
             no_of_docs,
             no_of_nurses,
             no_of_other_staff,
             no_of_ambs,
             no_of_ppe,
             no_of_vents,
             no_of_o2_cel,
             no_of_o2_conc,
             no_of_monitors,
             no_of_nebs
             ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, UUID(),?, ?,?,?,?,?,?,?,?,?,?,?,?,?)");
        try {
            $q->execute([
                $mobile,
                hash_password("Doc@1234"),
                htmlentities(utf8_encode($hosp_name)),
                htmlentities(utf8_encode(ucfirst($hosp_type))),
                htmlentities(utf8_encode($doc_name)),
                $subdist,
                htmlentities(utf8_encode($address)),
                "REQUESTED",
                $_SERVER["REMOTE_ADDR"],
                $category,
                $no_of_beds,
                $no_of_wards,
                $no_of_docs,
                $no_of_nurses,
                $no_of_other_staff,
                $no_of_amb,
                $no_of_ppe,
                $no_of_vent,
                $no_of_o2_cel,
                $no_of_o2_conc,
                $no_of_monitors,
                $no_of_neb
            ]);
            ret(200, ["error" => "false", "message" => "Registration Successful!"]);
        }
        catch (PDOException $e) {
            if($e->getCode() == 23000){
                ret(403, ["error"=>"true", "message"=>"Mobile Number Already Registered"]);
            }
            ret(500, ["error"=>"true", "message" => "Database Error Occurred!", "error"=> $e]);
        }
    } else {
        ret400();
    }
function ret($statusCode, $data)
{
    http_response_code($statusCode);
    die(json_encode($data));
}

function ret400()
{
    ret(400, ["error" => "true", "message" => "Fields Missing or Invalid!"]);
}
