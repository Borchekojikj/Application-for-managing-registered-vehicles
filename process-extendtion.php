<?php

require_once './autoload.php';
require_once './Classes/Vehicle.php';

print_r($_POST);
echo "<hr>";
$vehicleId = $_POST['id'];
$registration = $_POST['new_regisrtation_date'];

if (!isset($registration) || empty($registration)) {
    header("Location: extend_registration.php?id=$vehicleId & error=newregistrationdaterequired");
    die();
}

$vehicleObj = new Vehicle();

$status = $vehicleObj->extendRegistration($vehicleId, $registration);


if ($status) {
    $_SESSION['status'] = "extendedregistration";
    header("Location: admin.php?status=success");
    die();
} else {
    header("Location: login.php?error=couldnotextendregistration");
    die();
}
