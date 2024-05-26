<?php

require_once './Classes/Vehicle.php';
require_once './autoload.php';

$errors = [];


$fields = ['model', 'type', 'chassis_number', 'production_year', 'registration_number', 'fuel_type', 'registration_to'];



foreach ($fields as $field) {
    if (!isset($_POST[$field]) || empty($_POST[$field])) {
        $errors[$field] = $field . 'isrequired';
    }
}


function formatInputValues()
{


    $inputValues = [
        'model'  => trim($_POST['model']),
        'chassis_number' => trim($_POST['chassis_number']),
        'registration_number' => trim($_POST['registration_number']),
        'registration_to' => trim($_POST['registration_to']),
        'type' => trim($_POST['type']),
        'production_year' => trim($_POST['production_year']),
        'fuel_type' => trim($_POST['fuel_type']),
    ];

    return $inputValues;
}

$inputValues = formatInputValues();




$model = $_POST['model'];
$type = $_POST['type'];
$chassis_number = $_POST['chassis_number'];
$production_year = $_POST['production_year'];
$registration_number = $_POST['registration_number'];
$fuel_type = $_POST['fuel_type'];
$registration_to = $_POST['registration_to'];

$vehicleExists = $dbObj->chassisNumberExists($chassis_number);


if ($vehicleExists) {
    $errors['chassis_number'] = "vehiclealreadyindatabase";
}


if (empty($errors) == false) {
    $_SESSION['errors'] = $errors;
    $_SESSION['data'] = $inputValues;
    header("Location: admin.php");
    die();
}

$vehicleObj = new Vehicle();
$vehicle = $vehicleObj->createVehicle($model, $type, $chassis_number, $production_year, $registration_number, $fuel_type, $registration_to);
if ($vehicleObj->addVehicle($vehicle)) {
    $_SESSION['status'] = "vehicleadded";
    header("Location: admin.php?status=success");
    die();
} else {
    header("Location: admin.php?error=couldnotaddvehicle");
    die();
}
