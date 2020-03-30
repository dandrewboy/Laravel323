<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserModel;
use App\Business\SecurityService;

class LoginController extends Controller
{
    public function index(Request $request) {
        
        // Get the posted Form Data
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
    //
}
