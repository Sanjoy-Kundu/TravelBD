<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
        //
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
