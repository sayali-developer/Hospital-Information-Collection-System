<?php

class department {
    private $db, $con, $user;
    function __construct()
    {
        $this->db = new db();
        $this->con = $this->db->con();
    }
    function login($username, $password) {

        $q = "select * from data_admins where username = ? and password = ?";

        $query = $this->con->prepare($q);

        try {
            $query->execute([$username, $password]);
        }
        catch(PDOException $e) {
            pageInfo("red", "Database error occurred, please try after few minutes.");
            return false;
        }
        $users = $query->fetchAll(PDO::FETCH_ASSOC);
        if(count($users) == 1) {
            $_SESSION["user_type"] = "ADMIN";
            $_SESSION["id"] = $users[0]["id"];
            $_SESSION["username"] = $users[0]["username"];
            $this->user = $users[0];
            return true;
        }
        else {
            pageInfo("red", "Invalid Username or Password!");
            return false;
        }



    }
    function getUser() {
        return $this->user;
    }
    function loggedIn() {
        if(isset($_SESSION["id"]) && isset($_SESSION["username"]) && $_SESSION["user_type"] == "ADMIN") {
            $q = "select * from data_admins where username = ? and id = ?";

            $query = $this->con->prepare($q);

            try {
                $query->execute([$_SESSION["username"], $_SESSION["id"]]);
            }
            catch(PDOException $e) {
                pageInfo("red", "Database error occurred, please try after few minutes.");
                return false;
            }
            $users = $query->fetchAll(PDO::FETCH_ASSOC);
            if(count($users) == 1) {
                $_SESSION["user_type"] = "ADMIN";
                $_SESSION["id"] = $users[0]["id"];
                $_SESSION["username"] = $users[0]["username"];
                $this->user = $users[0];
                return true;
            }
            else {
                pageInfo("red", "Invalid username or password!");
                return false;
            }

        }
        return false;
    }

    function logOut() {
        unset($_SESSION["username"]);
        unset($_SESSION["id"]);
        unset($_SESSION["user_type"]);

        return true;
    }



};