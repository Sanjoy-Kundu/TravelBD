<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Admin;
use Illuminate\Support\Str;
use App\Models\AdminProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * admin profile page
     */
    public function adminProfilePage()
    {
        try {
            return view('pages.backend.adminProfilePage');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function adminProfileStore(Request $request)
    {
        //    $request->validate([
        //         'phone' => 'required|string|max:20',
        //         'address' => 'required|string|max:255',
        //         'designation' => 'required|string|max:100',
        //         'about' => 'required|string',
        //         //wihtout required 
        //         'alternate_phone' => 'nullable|string|max:20',
        //         'city' => 'nullable|string|max:100',
        //         'state' => 'nullable|string|max:100',
        //         'country' => 'nullable|string|max:100',
        //         'zip_code' => 'nullable|string|max:20',
        //         'facebook' => 'nullable|url',
        //         'twitter' => 'nullable|url',
        //         'linkedin' => 'nullable|url',
        //         'website' => 'nullable|url',
        //         'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        //     ]);
        try {
            $admin = Admin::find($request->admin_id);
            if(!$admin){
                return response()->json(['status' => 'error', 'message' => 'Admin not found']);
            }

            $adminProfile = AdminProfile::where('admin_id', $request->admin_id)->first();
            if(!$adminProfile){
                $adminProfile = new AdminProfile(); #make object 
                $adminProfile->admin_id = $request->admin_id;
                #$adminProfile->save(); for test
                #return "admin id inseted successfully";
            }
         

            
            //image handeling 
            if($request->hasFile('profile_image')){
                $image = $request->file('profile_image');
                $imageName = Str::random(10)."-".time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('upload/dashboard/images/admin'), $imageName);
                $adminProfile->profile_image = $imageName;
            }
            #return "Profile image uploaded successully successfully";
         

        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AdminProfile $adminProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminProfile $adminProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminProfile $adminProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminProfile $adminProfile)
    {
        //
    }
}
