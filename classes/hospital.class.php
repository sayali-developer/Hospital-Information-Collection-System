<?php

class hospital
{
    private $db, $con, $user;

    function __construct()
    {
        $this->db = new db();
        $this->con = $this->db->con();
    }

    function login($username, $password)
    {

        $q = "select * from hospitals where mobile_number = ? and password = ?";

        $query = $this->con->prepare($q);

        try {
            $query->execute([$username, $password]);

        } catch (PDOException $e) {
            pageInfo("red", "Database error occurred, please try after few minutes.");
            return false;
        }
        $users = $query->fetchAll(PDO::FETCH_ASSOC);
        if (count($users) == 1) {
            if ($users[0]["ac_status"] == "ACTIVE") {
                $_SESSION["user_type"] = "HOSP";
                $_SESSION["id"] = $users[0]["hospital_id"];
                $_SESSION["username"] = $users[0]["mobile_number"];
                $this->user = $users[0];
                return true;
            } else {
                pageInfo("orange", "Your Account Is Not Active yet! Please wait while we verify your details");
                return false;
            }
        } else {
            pageInfo("red", "Invalid Username or Password!");
            return false;
        }


    }

    function getUser()
    {
        return $this->user;
    }

    function loggedIn()
    {
        if (isset($_SESSION["id"]) && isset($_SESSION["username"]) && $_SESSION["user_type"] == "HOSP") {
            $q = "select * from hospitals where mobile_number = ? and hospital_id = ?";

            $query = $this->con->prepare($q);

            try {
                $query->execute([$_SESSION["username"], $_SESSION["id"]]);
            } catch (PDOException $e) {
                pageInfo("red", "Database error occurred, please try after few minutes.");
                return false;
            }
            $users = $query->fetchAll(PDO::FETCH_ASSOC);
            if (count($users) == 1) {
                if ($users[0]["ac_status"] == "ACTIVE") {
                    $_SESSION["user_type"] = "HOSP";
                    $_SESSION["id"] = $users[0]["hospital_id"];
                    $_SESSION["username"] = $users[0]["mobile_number"];
                    $this->user = $users[0];
                    return true;
                } else {
                    pageInfo("red", "Account Not Active!, Contact Office");
                    return false;
                }
            } else {
                pageInfo("red", "Please Login First!");
                return false;
            }

        }
        $this->logOut();
        return false;
    }

    function logOut()
    {
        unset($_SESSION["username"]);
        unset($_SESSION["id"]);
        unset($_SESSION["user_type"]);

        return true;
    }


}

