<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function adminLoginPage(){
        try{
            return view("/form.login");
        }catch(Exception $ex){
            return response()->json(['error' => $ex->getMessage()]);
        }
    }
}
