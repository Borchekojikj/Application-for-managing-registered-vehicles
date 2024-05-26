<?php

class Database
{
    private $dbObj;

    public function __construct()
    {
        try {
            $this->dbObj = new PDO("mysql: host=localhost;dbname=challenge-17-db", "root", "");
        } catch (\PDOException $error) {
            echo "Can't connect with db";
            die();
        }
    }

    /**
     * Get the value of dbObj
     */
    public function getDbObj()
    {
        return $this->dbObj;
    }

    /**
     * Set the value of dbObj
     *
     * @return  self
     */
    public function setDbObj($dbObj)
    {
        $this->dbObj = $dbObj;

        return $this;
    }

    /**
     * 
     * Retrieves all Information for a Vehicle based on the Vehicle Registration Number
     * 
     */

    public function getVehicleWithRegistrationNumber($registration_number)
    {
        $dbObj = $this->getDbObj();
        $sql = "SELECT reg.id, vehicle_models.vehicle_model as model, vehicle_types.vehicle_type as type, reg.chassis_number, 
         reg.production_year, reg.registration_number, fuel_types.fuel_type, reg.registration_to FROM 
         registrations as reg 
         JOIN vehicle_models on reg.model = vehicle_models.id
         JOIN vehicle_types on reg.type = vehicle_types.id
         JOIN fuel_types on reg.fuel_type = fuel_types.id
         WHERE registration_number = :registration_number";

        $stmt = $dbObj->prepare($sql);

        if (is_numeric($registration_number)) {
            $stmt->bindParam(':registration_number', $registration_number, PDO::PARAM_INT);
        } else {
            $stmt->bindParam(':registration_number', $registration_number, PDO::PARAM_STR);
        }

        $stmt->execute();
        $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);
        return $vehicle;
    }

    /**
     * 
     * Retrieves all Fuel Types from Database
     * 
     */
    public function getFuelTypes()
    {
        $dbObj = $this->getDbObj();
        $sql = "SELECT * FROM fuel_types";
        $stmt = $dbObj->prepare($sql);
        $stmt->execute();
        $fuelTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $fuelTypes;
    }


    /**
     * 
     * Retrieves all Vehicle Types from Database
     * 
     */

    public function getVehicleTypes()
    {
        $dbObj = $this->getDbObj();

        $sql = "SELECT * FROM vehicle_types";
        $stmt = $dbObj->prepare($sql);
        $stmt->execute();
        $vehicleTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $vehicleTypes;
    }

    /**
     * 
     * Retrieves Vehicle Information based on Input
     * 
     */
    public function searchTable($input)
    {
        $dbObj = $this->getDbObj();
        $modelInput = "%" . $input . "%";

        $sql = "SELECT reg.id, vehicle_models.vehicle_model as model, vehicle_types.vehicle_type as type, reg.chassis_number, 
        reg.production_year, reg.registration_number, fuel_types.fuel_type, reg.registration_to FROM 
        registrations as reg 
        LEFT JOIN vehicle_models on reg.model = vehicle_models.id
        JOIN vehicle_types on reg.type = vehicle_types.id
        JOIN fuel_types on reg.fuel_type = fuel_types.id
        WHERE vehicle_models.vehicle_model LIKE :modelInput 
           OR reg.chassis_number = :input
           OR reg.registration_number = :input
        ORDER BY reg.id
        ";

        $stmt = $dbObj->prepare($sql);
        $stmt->bindParam(':modelInput',   $modelInput, PDO::PARAM_STR);
        if (is_numeric($input)) {
            $stmt->bindParam(':input', $input, PDO::PARAM_INT);
        } else {
            $stmt->bindParam(':input', $input, PDO::PARAM_STR);
        }

        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    /**
     * 
     * Checks if a given Chassis Number exists
     * 
     */
    public function chassisNumberExists($chassis_number)
    {
        $dbObj = $this->getDbObj();
        $sql = "SELECT * FROM registrations WHERE chassis_number = :chassis_number";
        $stmt = $dbObj->prepare($sql);
        $stmt->bindParam(':chassis_number', $chassis_number, PDO::PARAM_STR);
        $stmt->execute();
        $status =  $stmt->fetch();
        if ($status) {
            return true;
        } else {
            return false;
        }
    }
}
