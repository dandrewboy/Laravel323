<?php
namespace App\Model;

class UserModel implements \JsonSerializable
{
    private $userID;
    private $username;
    private $password;

    public function __construct($userID = -1, $username = "", $password = "")
    {
        $this->userID = $userID;
        $this->username = $username;
        $this->password = $password;
        
    }
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

}

