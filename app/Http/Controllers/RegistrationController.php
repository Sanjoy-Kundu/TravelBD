<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
        public function adminRegisterPage(){
        try{
            return view("form.register");
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
    }
}
}
