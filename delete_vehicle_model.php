<?php
require_once './autoload.php';
require_once './Classes/Vehicle-model.php';

$modelId = $_GET['id'];

$modelErrors = [];

$vehicleDeleted = Vehicle_model::deleteVehicleModel($dbConn, $modelId);


if ($vehicleDeleted) {
    $_SESSION['status'] = "vehiclemodeldeleted";
    header("Location: view-vehicleModels.php?status=vehiclemodeldeleted");
    die();
} else {
    $modelErrors[] = 'couldnotdeltemodelinuse';
}

$_SESSION['modelErrors'] = $modelErrors;
if ($modelErrors) {
    header("Location: view-vehicleModels.php?error=modelnotdelted");
    die();
}
