<?php
namespace App\Data;

use PDO;
use Illuminate\Support\Facades\Log;
use PDOException;
use App\Utility\DatabaseException;
use App\Utility\MyLogger1;
use App\Utility\MyLogger2;
use App\Model\UserModel;

class SecurityDAO
{
    private $db = NULL;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findByUser($user)
    {
        MyLogger2::info("Enetring SecurityDAO.findByUser()");

        try 
        {
            $name = $user->getUsername();
            $pw = $user->getPassword();
            $stmt = $this->db->prepare('SELECT userId, username, password FROM user WHERE username = :username AND password = :password');
            $stmt->bindParam (':username', $name);
            $stmt->bindParam (':password', $pw);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                MyLogger2::info("Exit SecurityDAO.findByUser() with true");
                return true;
            } else {
                MyLogger2::info("Exit SecurityDAO.findByUser() with false");
            }
            
        } 
        catch (PDOException $e) 
        {
            MyLogger2::error("Exception: ", array("message: " => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    public function findByUserID($id)
    {
        MyLogger2::info("Enetring SecurityDAO.findByUserID()");
        
        try
        {
            $stmt = $this->db->prepare('SELECT userId, username, password FROM user WHERE userId = :id');
            $stmt->bindParam (':id', $id);
            $stmt->execute();
            if ($stmt->rowCount() == 0) {
                MyLogger2::info("Exit SecurityDAO.findByUserID() with null");
                return null;
            } else {
                MyLogger2::info("Exit SecurityDAO.findByUserID() with a user");
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $user = new UserModel($row['userId'], $row['username'], $row['password']);
                }
                return $user;
            
        }
        }
        catch (PDOException $e)
        {
            MyLogger2::error("Exception: ", array("message: " => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    public function findAllUsers()
    {
        MyLogger2::info("Enetring SecurityDAO.findByUserID()");
        
        try
        {
            $stmt = $this->db->prepare('SELECT * FROM user');
            $stmt->execute();
            if ($stmt->rowCount() == 0) {
                MyLogger2::info("Exit SecurityDAO.findByUserID() with null");
                return array();
            } else {
                MyLogger2::info("Exit SecurityDAO.findByUserID() with a user");
                $index = 0;
                $users = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $user = new UserModel($row['userId'], $row['username'], $row['password']);
                    $users[$index++] = $user;
                }
                return $users;
                
            }
        }
        catch (PDOException $e)
        {
            MyLogger2::error("Exception: ", array("message: " => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}

