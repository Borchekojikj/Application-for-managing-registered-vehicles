<?php

require_once './autoload.php';
require_once './Classes/Vehicle-model.php';

$vehicleModels = Vehicle_model::getVehicleModels($dbConn);


$successMessages = [
    'vehiclemodeladded' => "Vehicle Model added",
    'vehiclemodeldeleted' => "Vehicle Model deleted",
    'modelupdated' => "Vehicle Model updated",
];

$errorMessages = [
    'couldnotdeltemodelinuse' => "Could not delete the model, there are existing Vehicles with this Model in the Database",
]





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
        <div class="row justify-content-center">
            <div class="col-8">

                <h1 class="text-center my-3">Vehicle Models</h1>
                <?php
                if (isset($_SESSION['status'])) {
                    $msg = $_SESSION['status'];
                    echo "<div class='alert alert-success' role='alert'> $successMessages[$msg] </div> ";
                }
                if (isset($_SESSION['modelErrors'])) {

                    $errors = $_SESSION['modelErrors'];

                    foreach ($errors as $error) {
                        $errorMsg = $errorMessages[$error];
                        echo "<div class='alert alert-danger' role='alert'> $errorMsg </div> ";
                    }
                }
                ?>
                <table class="table border ">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">vehicle model</th>
                            <th scope="col">Action</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vehicleModels as  $vehicleModel) : ?>
                            <tr>
                                <td><?= $vehicleModel['id'] ?></td>
                                <td><?= $vehicleModel['vehicle_model'] ?></td>

                                <td class="d-flex">
                                    <a href="delete_vehicle_model.php?id=<?= $vehicleModel['id'] ?>" class="btn btn-danger">Delete</a>
                                    <a href="edit-vehicleModel.php?id=<?= $vehicleModel['id'] ?>" class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <form action="add-vehicleModel.php" method="POST">
                    <div class="mb-3">
                        <label for="registratinNumber" class="form-label">Add Vehicle Model</label>
                        <input name="vehicle_model" type="text" class="form-control w-50" id="registratinNumber">
                        <?= isset($_SESSION['error']) ? "<p class='alert alert-danger p-1 w-50'>" . $_SESSION['error'] . "</p>" : "" ?>

                        <button type="submit" class="btn btn-primary">Add model</button>
                    </div>
                </form>

                <a href="admin.php" class="btn btn-primary">Back</a>

            </div>
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

<?php
unset($_SESSION['status']);
unset($_SESSION['error']);
unset($_SESSION['modelErrors']);
?>