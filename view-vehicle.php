<?php

require_once './autoload.php';

if (isset($_POST['registrationNumber'])) {
    $registration_number = $_POST['registrationNumber'];

    $vehicle = $dbObj->getVehicleWithRegistrationNumber($registration_number);

    if (!$vehicle) {
        header("Location: index.php?error=vehiclenotfound");
        die();
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>

    </title>
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
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Vehicle Registration</a>

            <div id="navbarSupportedContent">
                <a href="login.php" class="navbar-text mb-0 ml-3">Login</a>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-8 offset-2 pt-5">
                <h1 class="text-center mb-5">Your Vehilce Information</h1>
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

                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td><?= $vehicle['id'] ?></td>
                            <td><?= $vehicle['model'] ?></td>
                            <td><?= $vehicle['type'] ?></td>
                            <td><?= $vehicle['chassis_number'] ?></td>
                            <td><?= $vehicle['production_year'] ?></td>
                            <td><?= $vehicle['registration_number'] ?></td>
                            <td><?= $vehicle['fuel_type'] ?></td>
                            <td><?= $vehicle['registration_to'] ?></td>

                        </tr>

                    </tbody>
                </table>
                <div>
                    <a href="index.php" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
    <!-- POPPER JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>