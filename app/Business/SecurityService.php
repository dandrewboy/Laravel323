<?php
namespace App\Business;

use App\Model\UserModel;
use Illuminate\Support\Facades\Log;
use Exception;
use PDO;
use App\Data\SecurityDAO;
use App\Utility\MyLogger1;
use App\Utility\MyLogger2;

class SecurityService
{
    
    function login(UserModel $user) {
        MyLogger2::info("Entering SecurityService.login()");
        try{
        
        //Get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $service = new SecurityDAO($db);
        $flag = $service->findByUser($user);
        }
        catch(Exception $e)
        {
            MyLogger2::error("Exception: ", array("message" => $e->getMessage()));
            
            return view("systemException");
        }
        
        $db = null;
        MyLogger2::info("Exit SecurityService.login() with ". $flag);
        return $flag;
    }
    function getUser($id) {
        MyLogger2::info("Entering SecurityService.getUser()");
        try{
            
            //Get credentials for accessing the database
            $servername = config("database.connections.mysql.host");
            $port = config("database.connections.mysql.port");
            $username = config("database.connections.mysql.username");
            $password = config("database.connections.mysql.password");
            $dbname = config("database.connections.mysql.database");
            
            $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $service = new SecurityDAO($db);
            MyLogger2::info("Exit SecurityService.getUser() with a user");
            return $service->findByUserID($id);
            $db = null;
        }
        catch(Exception $e)
        {
            MyLogger2::error("Exception: ", array("message" => $e->getMessage()));
            
            return view("systemException");
        } 
    }
    function getAllUsers() {
        MyLogger2::info("Entering SecurityService.getAllUsers()");
        try{
            
            //Get credentials for accessing the database
            $servername = config("database.connections.mysql.host");
            $port = config("database.connections.mysql.port");
            $username = config("database.connections.mysql.username");
            $password = config("database.connections.mysql.password");
            $dbname = config("database.connections.mysql.database");
            
            $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $service = new SecurityDAO($db);
            MyLogger2::info("Exit SecurityService.getAllUsers() with an array of users");
            return $service->findAllUsers();
            $db = null;
        }
        catch(Exception $e)
        {
            MyLogger2::error("Exception: ", array("message" => $e->getMessage()));
            
            return view("systemException");
        } 
    }
}

