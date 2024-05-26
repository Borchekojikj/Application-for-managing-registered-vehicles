<?php


require_once './autoload.php';
require_once './Classes/Vehicle-model.php';

if (isset($_GET['search'])) {
    $input = $_GET['search'];
    $searchData = $dbObj->searchTable($input);
}
if (!isset($_SESSION['loggedIn'])) {
    header("Location: login.php?status=noactivesession");
    die();
}

$errors = $_SESSION['errors'] ?? [];
$data = $_SESSION['data'] ?? [];

if (isset($errors) && !empty($errors)) {
}


$vehicles = $vehicleObj->getAllVehicles();

$vehicleTypes = $dbObj->getVehicleTypes();
$fuelTypes = $dbObj->getFuelTypes();

$vehicleModels = Vehicle_model::getVehicleModels($dbConn);

$errorMessages = [

    'chassis_numberisrequired' => "Chessis number is required",
    'registration_numberisrequired' => "Registration number is required",
    'registration_toisrequired' => "Registration date is required",
    'typeisrequired' => "Vehicle type is required",
    'production_yearisrequired' => "Production year is required",
    'fuel_typeisrequired' => "Fuel type is required",
    'modelisrequired' => "Vehicle model is required",
    'vehiclealreadyindatabase' => "Chassis number already exists",

];

$succesMessages = [
    'vehicleadded' => "Vehicle has been added",
    'vehicledeleted' => "Vehicle has been deleted",
    'vehicleupdated' => "Vehicle has been updated",
    'extendedregistration' => "Registratin has benn extended",
];

?>


<!DOCTYPE html>
<html>

<head>
    <title>Document</title>
    <meta charset="utf-8" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />

    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <style>
        a {
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="index.php">Vehicle Registration</a>
                        <div id="navbarSupportedContent">
                            <a href="logout.php" class="navbar-text mb-0 ml-3">Logout</a>
                        </div>
                    </div>
                </nav>


            </div>
            <div class="col-8">
                <?php
                if (isset($_SESSION['status'])) {
                    $msg = $_SESSION['status'];
                    echo "<div class='alert alert-success' role='alert'> $succesMessages[$msg] </div> ";
                }
                ?>
            </div>
            <div class="col-8">
                <div class="mt-5 bg-secondary text-white p-5 ">

                    <h1 class="text-center mb-3">Vehicle Registration</h1>
                    <form action="add-vehicle.php" method="POST">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="model" class="form-label">Vehicle Model</label>

                                    <select id="model" class="form-select" name='model'>
                                        <option selected disabled>Open this select menu</option>
                                        <?php foreach ($vehicleModels as $vehicleModel) : ?>
                                            <?php
                                            $selectedModel  = ($vehicleModel['id'] == $data['model']) ? 'selected' : '';
                                            ?>
                                            <option value="<?= $vehicleModel['id'] ?>" <?= $selectedModel ?>><?= $vehicleModel['vehicle_model'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= isset($errors['model']) ? "<p class='alert alert-danger p-1 '>" . $errorMessages[$errors['model']] . "</p>" : "" ?>

                                    <?php

                                    ?>
                                </div>

                                <div class="mb-3">
                                    <label for="chassisNumber" class="form-label">Vehice Chassis number</label>
                                    <input name="chassis_number" type="text" class="form-control" id="chassisNumber" value="<?= isset($data['chassis_number']) ? $data['chassis_number'] : '' ?>">
                                    <?= isset($errors['chassis_number']) ? "<p class='alert alert-danger p-1 '>" . $errorMessages[$errors['chassis_number']] . "</p>" : "" ?>

                                </div>
                                <div class="mb-3">
                                    <label for="registratinNumber" class="form-label">Vehicle Registration number</label>
                                    <input name="registration_number" type="text" class="form-control" id="registratinNumber" value="<?= isset($data['registration_number']) ? $data['registration_number'] : '' ?>">
                                    <?= isset($errors['registration_number']) ? "<p class='alert alert-danger p-1 '>" . $errorMessages[$errors['registration_number']] . "</p>" : "" ?>


                                </div>
                                <div class="mb-3">
                                    <label for="registrationDate" class="form-label">Registration to</label>
                                    <input name="registration_to" type="date" class="form-control" id="registrationDate" value="<?= isset($data['registration_to']) ? $data['registration_to'] : '' ?>">
                                    <?= isset($errors['registration_to']) ? "<p class='alert alert-danger p-1 '>" . $errorMessages[$errors['registration_to']] . "</p>" : "" ?>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">

                                    <label for="model" class="form-label">Vehicle Type</label>
                                    <select id="type" class="form-select" name='type'>

                                        <option selected disabled>Open this select menu</option>
                                        <?php foreach ($vehicleTypes as $vehicleType) : ?>
                                            <?php
                                            $selectedType  = ($vehicleType['id'] == $data['type']) ? 'selected' : '';
                                            ?>
                                            <option value="<?= $vehicleType['id'] ?>" <?= $selectedType ?>><?= $vehicleType['vehicle_type'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= isset($errors['type']) ? "<p class='alert alert-danger p-1 '>" . $errorMessages[$errors['type']] . "</p>" : "" ?>


                                </div>
                                <div class="mb-3">
                                    <label for="productionYear" class="form-label">Production year</label>
                                    <input name="production_year" type="date" class="form-control" id="productionYear" value="<?= isset($data['production_year']) ? $data['production_year'] : '' ?>">
                                    <?= isset($errors['production_year']) ? "<p class='alert alert-danger p-1 '>" . $errorMessages[$errors['production_year']] . "</p>" : "" ?>

                                </div>
                                <div class="mb-3">
                                    <label for="fuel_type" class="form-label">Fuel</label>

                                    <select id="fuel_type" class="form-select" name='fuel_type'>
                                        <option selected disabled>Open this select menu</option>
                                        <?php foreach ($fuelTypes as $fuelType) : ?>
                                            <?php
                                            $selectedFuel  = ($fuelType['id'] == $data['fuel_type']) ? 'selected' : '';
                                            ?>
                                            <option value="<?= $fuelType['id'] ?>" <?= $selectedFuel ?>><?= $fuelType['fuel_type'] ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                    <?= isset($errors['fuel_type']) ? "<p class='alert alert-danger p-1 '>" . $errorMessages[$errors['fuel_type']] . "</p>" : "" ?>


                                </div>
                                <div class="mb-3">
                                    <div class="mt-5">
                                        <button type="submit" class="btn btn-primary w-100">Add Vehicle</button>
                                    </div>


                                </div>
                            </div>
                        </div>




                    </form>



                </div>
                <div class="text-white p-2 ">
                    <a href="view-vehicleModels.php" class="btn btn-primary">Vehicle models</a>




                </div>
            </div>


        </div>

        <div class="row">
            <div class="col-8 offset-2 pt-5">
                <form action="" method="GET">
                    <input value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" id="search" class="form-control w-25 d-inline" type="text" placeholder="Type here" name="search">
                    <button type="submit" class="btn btn-primary mb-1">Search</button>
                </form>
                <table class="table border">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">vehicle model</th>
                            <th scope="col">vehicle type</th>
                            <th scope="col">vehicle chassis number</th>
                            <th scope="col">vehicle production year</th>
                            <th scope="col">registration number</th>
                            <th scope="col">fuel type</th>
                            <th scope="col">registration to</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (isset($searchData) ? $searchData : $vehicles as  $vehicle) : ?>
                            <?php
                            $x = $vehicle['registration_to'];
                            $date1 = new DateTime($x);
                            $date2 = new DateTime(date('Y-m-d'));

                            $interval = $date1->diff($date2);
                            $timeDif  = $interval->format('%a');


                            if ($date1 < $date2) {
                                $registration_status = 'expired';
                                $tableColor = 'text-danger';
                            } elseif ($timeDif < 30) {

                                $registration_status = '1_month';
                                $tableColor = 'text-warning';
                            } else {
                                $registration_status = 'notdue';
                                $tableColor = 'text-dark';
                            }


                            ?>
                            <tr class="<?= $tableColor ?>">

                                <td><?= $vehicle['id'] ?></td>
                                <td><?php if ($vehicle['model'] == null) {
                                        echo "Model not in Database";
                                    } else {
                                        echo $vehicle['model'];
                                    } ?></td>
                                <td><?= $vehicle['type'] ?></td>
                                <td><?= $vehicle['chassis_number'] ?></td>
                                <td><?= $vehicle['production_year'] ?></td>
                                <td><?= $vehicle['registration_number'] ?></td>
                                <td><?= $vehicle['fuel_type'] ?></td>
                                <td><?= $vehicle['registration_to'] ?></td>
                                <td class="d-flex">


                                    <a href="delete_vehicle.php?id=<?= $vehicle['id'] ?>" class="btn btn-danger">Delete</a>
                                    <a href="edit_vehicle.php?id=<?= $vehicle['id'] ?>" class="btn btn-warning">Edit</a>
                                    <?php if ($registration_status == "expired" || $registration_status == "1_month") : ?>
                                        <a href="extend_registration.php?id=<?= $vehicle['id'] ?>" class="btn btn-success">Extend</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php $registration_status = null;
                            ?>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <!-- POPPER JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>

<?php

unset($_SESSION['errors']);
unset($_SESSION['data']);
unset($_SESSION['status']);


?>