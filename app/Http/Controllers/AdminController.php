<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Admin;
use App\Mail\AdminOtp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function admin_login_store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        try{
        $admin = Admin::where("email", $request->email)->where("role", "admin")->first();
        #return $admin;

        //check email and password 
        if(!$admin || !Hash::check($request->password, $admin->password)){
            return response()->json(["status" => "message_error","message"=> "Invalid email or password"]);
        }

        //if verified or not first verified then next step 
       if($admin->is_verified == 0){
            $generate_otp = rand(100000,999999);
            $admin->otp = $generate_otp;
            $admin->otp_expires_at = now()->addMinutes(1);
            $admin->save();

            #sending otp to email
            Mail::to($admin->email)->send(new AdminOtp($admin));

            //success message
            return response()->json([
            "status" => "success",
            "message"=> "OTP sent to your email. Please check your email",
            "email" => $admin->email]);
       }


       #already verified
       $token = $admin->createToken('auth_token')->plainTextToken;
       return response()->json([
        'status' => "success",
        'message' => "Login successfully",
        'token' => $token,
        'user' => $admin
       ]);

        }catch(Exception $e){
            return response()->json([
                'status' => "error",
                'message' => $e->getMessage()
            ]);
        }
           
         
    }

    /**
     * Store a newly created resource in storage.
     */
    public function admin_registration_store(Request $request)
    {
          $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:admins',
                'password' => 'required|string|min:8',
            ]);

        try{
          
             Admin::create([
                'name' => Str::upper($request->name),
                'email' => Str::lower($request->email),
                'password' => bcrypt($request->password),
                'role' => 'admin'
               ]);
            return response()->json(['status' => 'success','message' => 'Admin created successfully',], 201);   
        }catch(Exception $ex){
            return response()->json(['status' => 'error','message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
