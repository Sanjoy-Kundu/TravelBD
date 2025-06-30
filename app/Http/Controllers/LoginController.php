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

    
    public function staffLoginPage(){
        try{
            return view("/form.staff.login");
        }catch(Exception $ex){
            return response()->json(['error' => $ex->getMessage()]);
        }
    }



    public function agentLoginPage(){
        try{
            return view("/form.agent.login");
        }catch(Exception $ex){
            return response()->json(['error' => $ex->getMessage()]);
        }
    }




}
