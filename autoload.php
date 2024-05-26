<?php

require_once './Classes/Database.php';
require_once './Classes/Vehicle.php';

session_start();

$dbObj = new Database;
$dbConn = $dbObj->getDbObj();


$vehicleObj = new Vehicle();
