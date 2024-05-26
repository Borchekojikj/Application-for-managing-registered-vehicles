<?php

require_once './autoload.php';
require_once './Classes/Vehicle-model.php';

$vehicleTypes = $dbObj->getVehicleTypes();
$fuelTypes = $dbObj->getFuelTypes();
$vehicleModels = Vehicle_model::getVehicleModels($dbConn);



$vehicleId = $_GET['id'];

$vehicle = $vehicleObj->getVehicleWithId($vehicleId);






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
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <form action="update-vehicle.php" method="POST">
                    <input type="hidden" value="<?= $vehicleId ?>" name="id">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="model" class="form-label">Vehicle Model</label>

                                <select id="model" class="form-select" name='model' ?>">

                                    <?php for ($i = 0; $i < count($vehicleModels); $i++) : ?>
                                        <?php if ($vehicleModels[$i]['vehicle_model'] == $vehicle['model']) {
                                            $currentModelId = $vehicleModels[$i]['id'];
                                            continue;
                                        } ?>
                                        <option value="<?= $vehicleModels[$i]['id'] ?>"><?= $vehicleModels[$i]['vehicle_model'] ?></option>
                                    <?php endfor; ?>
                                    <option selected value="<?= $currentModelId  ?>"><?= $vehicle['model'] ?></option>

                                </select>



                            </div>
                            <div class="mb-3">
                                <label for="chassisNumber" class="form-label">Vehice Chassis number</label>
                                <input value="<?= $vehicle['chassis_number'] ?>" name="chassis_number" type="text" class="form-control" id="chassisNumber">

                            </div>
                            <div class="mb-3">
                                <label for="registratinNumber" class="form-label">Vehicle Registration number</label>
                                <input value="<?= $vehicle['registration_number'] ?>" name="registration_number" type="text" class="form-control" id="registratinNumber">

                            </div>
                            <div class="mb-3">
                                <label for="registrationDate" class="form-label">Registration to</label>
                                <input value="<?= $vehicle['registration_to'] ?>" name="registration_to" type="date" class="form-control" id="registrationDate">

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">


                                <label for="type" class="form-label">Vehicle Type</label>


                                <select id="type" class="form-select" name='type' ?>">

                                    <?php for ($i = 0; $i < count($vehicleTypes); $i++) : ?>
                                        <?php if ($vehicleTypes[$i]['vehicle_type'] == $vehicle['type']) {
                                            $currentTypelId = $vehicleTypes[$i]['id'];
                                            continue;
                                        } ?>
                                        <option value="<?= $vehicleTypes[$i]['id'] ?>"><?= $vehicleTypes[$i]['vehicle_type'] ?></option>
                                    <?php endfor; ?>
                                    <option selected value="<?= $currentTypelId  ?>"><?= $vehicle['type'] ?></option>

                                </select>



                            </div>
                            <div class="mb-3">
                                <label for="productionYear" class="form-label">Production year</label>
                                <input value="<?= $vehicle['production_year'] ?>" name="production_year" type="date" class="form-control" id="productionYear">

                            </div>
                            <div class="mb-3">
                                <label for="fuel_type" class="form-label">Fuel</label>

                                <select id="fuel_type" class="form-select" name='fuel_type' ?>">

                                    <?php for ($i = 0; $i < count($fuelTypes); $i++) : ?>
                                        <?php if ($fuelTypes[$i]['fuel_type'] == $vehicle['fuel_type']) {
                                            $currentFuelTypelId = $fuelTypes[$i]['id'];
                                            continue;
                                        } ?>
                                        <option value="<?= $fuelTypes[$i]['id'] ?>"><?= $fuelTypes[$i]['fuel_type'] ?></option>
                                    <?php endfor; ?>
                                    <option selected value="<?= $currentFuelTypelId  ?>"><?= $vehicle['fuel_type'] ?></option>

                                </select>



                            </div>
                            <div class="mb-3">
                                <div class="mt-5">
                                    <button type="submit" class="btn btn-primary w-100">Update Vehicle</button>
                                </div>


                            </div>
                        </div>
                    </div>




                </form>

            </div>
        </div>
    </div>
    <!-- POPPER JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>