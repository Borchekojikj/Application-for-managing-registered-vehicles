<?php

require_once 'Database.php';

class User extends Database
{
    private $username;
    private $password;


    public function __construct($username, $password)
    {
        $this->setUsername($username);
        $this->setPassword($password);
        parent::__construct();
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function authUser()
    {


        $username = $this->getUsername();
        $password = $this->getPassword();
        $dbObj = $this->getDbObj();
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $dbObj->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);




        if ($user) {
            $passwordDb = $user['password'];
            if ($passwordDb == $password) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
