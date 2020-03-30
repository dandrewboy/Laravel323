<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Model\UserModel;
use App\Business\SecurityService;

class ValidationController extends Controller
{
    public function validation(Request $request) {
        try{
        // Get the posted Form Data
       $rules = ['username' => 'Required | Between:4,10 | Alpha',
                  'password' => 'Required | Between:4,10'];
       
       $this->validate($request, $rules);
       
       $username = $request->input('username');
       $password = $request->input('password');
       
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
           return view('LoginFailed');
        }
        }
        catch(ValidationException $e1) 
        {
            throw $e1;
        }
        catch(Exception $e2) 
        {
            return view("systemException");
        }
    }
}
