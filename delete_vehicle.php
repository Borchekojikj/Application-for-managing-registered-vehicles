<?php

require_once './autoload.php';

$vehicleId = $_GET['id'];



if ($vehicleObj->deleteVehicle($vehicleId)) {
    $_SESSION['status'] = "vehicledeleted";
    header("Location: admin.php?status=success");
    die();
} else {
    header("Location: admin.php?error=vehiclecouldnotbedeleted");
    die();
}
