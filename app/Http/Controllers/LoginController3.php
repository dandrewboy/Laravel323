<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Model\UserModel;
use App\Utility\MyLogger1;
use App\Utility\MyLogger2;
use App\Business\SecurityService;

class LoginController3 extends Controller
{
   
    
    public function index(Request $request) {
        
        MyLogger2::info("Entering LoginController3.index()");
        try
        {
        
        // Get the posted Form Data
        $username = $request->input('username');
        $password = $request->input('password');
        MyLogger2::info("Parameters: ", array("username" => $username, "password" => $password));
        //Save form data into am Object Model
        $user = new UserModel(-1, $username, $password);
        
        // Call Securoty Business Service
        $service = new SecurityService();
        $status = $service->login($user);
        
        // Render a failed or success response View and pass User Model to it
        if($status) {
            $data = ['model' => $user];
            MyLogger2::info("Exiting LoginController.index() with the login passing");
            return view('LoginPassed')->with($data);
        }
        else {
            MyLogger2::info("Exiting LoginController3.index() with the login failing");
            return view('LoginFailed');
        }
        } catch(ValidationException $e1)
        {
            throw $e1;
        }
        catch(Exception $e2)
        {
            MyLogger2::error("Exception: ", array("message" => $e2->getMessage()));
            
            return view("SystemException");
        }
    
    }
    //
}
