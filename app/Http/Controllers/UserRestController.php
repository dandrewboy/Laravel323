<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Exception;
use App\Business\SecurityService;
use App\Model\DTO;
use App\Utility\MyLogger2;

class UserRestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        MyLogger2::info("Entering UserRestController.index()");
        try
        {
        // Call service to get all users
            $service = new SecurityService();
            $users = $service->getAllUsers();
        
        // Serialize the DTO to Json
            $dto = new DTO(0, "OK", $users);
            $json = json_encode($dto);
            MyLogger2::info("Exiting UserRestController.index()");
            return $json;
        }
        catch(Exception $e1)
        {
            MyLogger2::error("Exception: ", array("message" => $e1->getMessage()));
            $dto = new DTO(-2, $e1->getMessage(), "");
            return json_encode($dto);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        MyLogger2::info("Entering UserRestController.show()");
        try {
        $service = new SecurityService();
        $user = $service->getUser($id);
        
        // Serialize the DTO to Json
        $dto = new DTO(0, "OK", $user);
        $json = json_encode($dto);
        MyLogger2::info("Exiting UserRestController.show()");
        return $json;
        
        } 
        catch (Exception $e1) 
        {
            MyLogger2::error("Exception: ", array("message" => $e1->getMessage()));
            $dto = new DTO(-2, $e1->getMessage(), "");
            return json_encode($dto);
        }
    }
    
}


    