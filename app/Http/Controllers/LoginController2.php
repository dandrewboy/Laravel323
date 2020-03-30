<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Model\UserModel;
use App\Business\SecurityService;

class LoginController2 extends Controller
{
   
    
    public function index(Request $request) {
        
        Log::info("Entering LoginController2.index()");
        try
        {
        
        // Get the posted Form Data
        $username = $request->input('username');
        $password = $request->input('password');
        Log::info("Parameters: ", array("username" => $username, "password" => $password));
        //Save form data into am Object Model
        $user = new UserModel(-1, $username, $password);
        
        // Call Securoty Business Service
        $service = new SecurityService();
        $status = $service->login($user);
        
        // Render a failed or success response View and pass User Model to it
        if($status) {
            $data = ['model' => $user];
            return view('LoginPassed')->with($data);
        }
        else {
            Log::info("Exiting LoginController2.index()");
            return view('LoginFailed');
        }
        } catch(ValidationException $e1)
        {
            throw $e1;
        }
        catch(Exception $e2)
        {
            Log::error("Exception: ", array("message" => $e2->getMessage()));
            
            return view("systemException");
        }
    
    }
    //
}
