
<?php

require_once './autoload.php';

$vehicleId = $_POST['id'];
$model = $_POST['model'] ? $_POST['model'] : "Not specified";
$type = $_POST['type'];
$chassis_number = $_POST['chassis_number'];
$production_year = $_POST['production_year'];
$registration_number = $_POST['registration_number'];
$fuel_type = $_POST['fuel_type'];
$registration_to = $_POST['registration_to'];

$data = [

    'id' => $_POST['id'],
    'model' => $_POST['model'],
    'type' => $_POST['type'],
    'chassis_number' => $_POST['chassis_number'],
    'production_year' => $_POST['production_year'],
    'registration_number' => $_POST['registration_number'],
    'fuel_type' => $_POST['fuel_type'],
    'registration_to' => $_POST['registration_to']

];


$updated = $vehicleObj->updateVehicle($data);


if ($updated) {
    $_SESSION['status'] = "vehicleupdated";
    header("Location: admin.php?status=success");
    die();
} else {
    header("Location: admin.php?error=failidtoupdatevehicle");
    die();
}
