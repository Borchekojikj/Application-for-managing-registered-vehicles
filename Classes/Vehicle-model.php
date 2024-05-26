<?php

require_once 'Database.php';
class Vehicle_model extends Database
{


    /**
     * 
     * Retrieves all  Vehicle Models from Database
     * 
     */

    public static function getVehicleModels($dbObj)
    {
        $sql = "SELECT * FROM vehicle_models";
        $stmt = $dbObj->prepare($sql);
        $stmt->execute();
        $vehicle_models = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $vehicle_models;
    }

    /**
     * 
     * Deletes an Vehicle Model from Database, based on the Model primary key the Model Id
     * 
     */
    public static function deleteVehicleModel($dbObj, $modelId)
    {

        $sql = "DELETE FROM vehicle_models WHERE id = :id";
        $stmt = $dbObj->prepare($sql);
        $stmt->bindParam(":id", $modelId, PDO::PARAM_INT);


        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * 
     *  Adds an Vehicle Model to the Database
     * 
     */

    public static function addVehicleModel($dbObj, $vehicle_model)
    {

        $sql = "SELECT * FROM vehicle_models WHERE vehicle_model = :vehicle_model";
        $stmt = $dbObj->prepare($sql);
        $stmt->bindParam(":vehicle_model", $vehicle_model, PDO::PARAM_STR);
        $stmt->execute();
        $vehicle_exists = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($vehicle_exists) {
            return false;
        } else {
            $sql = "INSERT INTO vehicle_models (vehicle_model) VALUES (:vehicle_model)";
            $stmt = $dbObj->prepare($sql);
            $stmt->bindParam(":vehicle_model", $vehicle_model, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        }
    }


    /**
     * 
     *  Updates an Vehicle Model in the Database
     * 
     */

    public static function updateVehicleModel($dbObj, $id, $newModel)
    {
        $sql = "UPDATE vehicle_models SET vehicle_model = :newModel WHERE id = :id";;
        $stmt = $dbObj->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":newModel", $newModel, PDO::PARAM_STR);
        $status = $stmt->execute();
        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * Retrieves an Vehicle Model from Database, based on the Id input
     * 
     */

    public static function getVehicleMoodelWithId($dbObj, $modelId)
    {

        $sql = "SELECT * FROM vehicle_models WHERE id = :id";
        $stmt = $dbObj->prepare($sql);
        $stmt->bindParam(":id", $modelId, PDO::PARAM_INT);
        $stmt->execute();
        $vehicle_model = $stmt->fetch(PDO::FETCH_ASSOC);
        return  $vehicle_model;
    }
}
