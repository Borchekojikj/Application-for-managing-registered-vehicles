<?php

require_once 'Database.php';

class Vehicle extends Database
{

    private $model;
    private $type;
    private $chassis_number;
    private $production_year;
    private $registration_number;
    private $fuel_type;
    private $registration_to;
    private $id;

    public function __construct()
    {
        parent::__construct();
    }

    public function createVehicle($model, $type, $chassis_number, $production_year, $registration_number, $fuel_type, $registration_to)
    {
        $this->setModel($model);
        $this->setType($type);
        $this->setChassis_number($chassis_number);
        $this->setProduction_year($production_year);
        $this->setRegistration_number($registration_number);
        $this->setFuel_type($fuel_type);
        $this->setRegistration_to($registration_to);
    }

    /**
     * Get the value of model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the value of model
     *
     * @return  self
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of chassis_number
     */
    public function getChassis_number()
    {
        return $this->chassis_number;
    }

    /**
     * Set the value of chassis_number
     *
     * @return  self
     */
    public function setChassis_number($chassis_number)
    {
        $this->chassis_number = $chassis_number;

        return $this;
    }

    /**
     * Get the value of production_year
     */
    public function getProduction_year()
    {
        return $this->production_year;
    }

    /**
     * Set the value of production_year
     *
     * @return  self
     */
    public function setProduction_year($production_year)
    {
        $this->production_year = $production_year;

        return $this;
    }

    /**
     * Get the value of registration_number
     */
    public function getRegistration_number()
    {
        return $this->registration_number;
    }

    /**
     * Set the value of registration_number
     *
     * @return  self
     */
    public function setRegistration_number($registration_number)
    {
        $this->registration_number = $registration_number;

        return $this;
    }

    /**
     * Get the value of fuel_type
     */
    public function getFuel_type()
    {
        return $this->fuel_type;
    }

    /**
     * Set the value of fuel_type
     *
     * @return  self
     */
    public function setFuel_type($fuel_type)
    {
        $this->fuel_type = $fuel_type;

        return $this;
    }

    /**
     * Get the value of registration_to
     */
    public function getRegistration_to()
    {
        return $this->registration_to;
    }

    /**
     * Set the value of registration_to
     *
     * @return  self
     */
    public function setRegistration_to($registration_to)
    {
        $this->registration_to = $registration_to;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }





    public function addVehicle()
    {


        $data = [
            'model' => $this->getModel(),
            'type' => $this->getType(),
            'chassis_number' => $this->getChassis_number(),
            'production_year' => $this->getProduction_year(),
            'registration_number' => $this->getRegistration_number(),
            'fuel_type' => $this->getFuel_type(),
            'registration_to' => $this->getRegistration_to(),
        ];

        $dbObj = $this->getDbObj();


        $sql = "INSERT INTO registrations (model, type, chassis_number,production_year,registration_number,fuel_type,registration_to) VALUES
        (:model, :type, :chassis_number, :production_year, :registration_number, :fuel_type, :registration_to)";

        $stmt = $dbObj->prepare($sql);

        if ($stmt->execute($data)) {
            return true;
        } else {
            return false;
        }
    }


    public function updateVehicle(array $data)
    {
        $dbObj = $this->getDbObj();
        $sql = "UPDATE registrations SET model = :model, type = :type, chassis_number = :chassis_number, 
        production_year = :production_year, registration_number =:registration_number, fuel_type = :fuel_type, 
        registration_to = :registration_to WHERE id = :id ";
        $stmt = $dbObj->prepare($sql);


        $status = $stmt->execute($data);

        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteVehicle($modelId)
    {
        $dbObj = $this->getDbObj();
        $sql = "DELETE FROM registrations WHERE id = :id";
        $stmt = $dbObj->prepare($sql);
        $stmt->bindParam(":id", $modelId, PDO::PARAM_INT);
        $status = $stmt->execute();
        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllVehicles()
    {
        $dbObj = $this->getDbObj();

        $sql = "SELECT reg.id, vehicle_models.vehicle_model as model, vehicle_types.vehicle_type as type, reg.chassis_number, 
        reg.production_year, reg.registration_number, fuel_types.fuel_type, reg.registration_to FROM 
        registrations as reg 
        LEFT JOIN vehicle_models on reg.model = vehicle_models.id
        JOIN vehicle_types on reg.type = vehicle_types.id
        JOIN fuel_types on reg.fuel_type = fuel_types.id
        ORDER BY reg.id";
        $stmt = $dbObj->prepare($sql);
        $stmt->execute();
        $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $vehicles;
    }

    /**
     * 
     * Retrieves an Vehicle from Database, based on the inputed Id
     * 
     */

    public function getVehicleWithId($id)
    {

        $dbObj = $this->getDbObj();
        $sql = "SELECT reg.id, vehicle_models.vehicle_model as model, vehicle_types.vehicle_type as type, reg.chassis_number, 
         reg.production_year, reg.registration_number, fuel_types.fuel_type, reg.registration_to FROM 
         registrations as reg 
         LEFT JOIN vehicle_models on reg.model = vehicle_models.id
         JOIN vehicle_types on reg.type = vehicle_types.id
         JOIN fuel_types on reg.fuel_type = fuel_types.id
         WHERE reg.id = :id";
        $stmt = $dbObj->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);
        return $vehicle;
    }

    public function extendRegistration($vehicleId, $registration_to)
    {
        $data = [
            'id' => $vehicleId,
            'registration_to' => $registration_to,

        ];
        $dbObj = $this->getDbObj();

        $sql = "UPDATE registrations SET registration_to = :registration_to WHERE id = :id";
        $stmt = $dbObj->prepare($sql);
        $status = $stmt->execute($data);
        if ($status) {
            return true;
        } else {
            return false;
        }
    }
}
