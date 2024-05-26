<?php


require_once './autoload.php';
require_once './Classes/Vehicle-model.php';




$model = $_POST['vehicle_model'];

if (!isset($model) || empty($model)) {

    $_SESSION['error'] = 'Model is required';
    header("Location: view-vehicleModels.php");
    die();
}


$vehicleModelAdded = Vehicle_model::addVehicleModel($dbConn, $model);

if ($vehicleModelAdded) {
    $_SESSION['status'] = "vehiclemodeladded";
    header("Location: view-vehicleModels.php?status=success");
    die();
} else {
    $_SESSION['error'] = 'Model already in Database';
    header("Location: view-vehicleModels.php?");
    die();
}
