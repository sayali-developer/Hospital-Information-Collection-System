<?php

require_once "include.php";

$dep = new department();
$hosp = new hospital();

$dep->logOut();

$hosp->logOut();

header("Location: ./");