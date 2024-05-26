<?php


require_once './autoload.php';
require_once './Classes/Vehicle-model.php';

$id = $_POST['id'];
$newModel = $_POST['newModel'];

if (!isset($newModel) || empty($newModel)) {
    $_SESSION['status'] = "vehiclemodelrequired";
    header("Location: view-vehicleModels.php?error=vehiclemodelrequired");
    die();
}

$vehicleModelUpdated = Vehicle_model::updateVehicleModel($dbConn, $id, $newModel);

if ($vehicleModelUpdated) {
    $_SESSION['status'] = "modelupdated";
    header("Location: view-vehicleModels.php?status=success");
    die();
} else {
    header("Location: view-vehicleModels.php?error=couldntupdatemodel");
    die();
}
