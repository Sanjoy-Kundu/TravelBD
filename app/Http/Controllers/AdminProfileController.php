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
     * admin profile store
     */
public function adminProfileStore(Request $request)
{
    // Step 1: Validation 
    $request->validate([
        'phone' => 'required|string|max:20',
        'address' => 'required|string|max:255',
        'designation' => 'required|string|max:100',
        'about' => 'required|string',

        'alternate_phone' => 'nullable|string|max:20',
        'city' => 'nullable|string|max:100',
        'state' => 'nullable|string|max:100',
        'country' => 'nullable|string|max:100',
        'zip_code' => 'nullable|string|max:20',
        'facebook' => 'nullable|url',
        'twitter' => 'nullable|url',
        'linkedin' => 'nullable|url',
        'website' => 'nullable|url',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    try {
        $admin = Admin::find($request->admin_id);
        if (!$admin) {
            return response()->json(['status' => 'error', 'message' => 'Admin not found']);
        }

        $adminProfile = AdminProfile::where('admin_id', $request->admin_id)->first();

        if (!$adminProfile) {
            $adminProfile = new AdminProfile();
            $adminProfile->admin_id = $request->admin_id;
        }

        // Step 2: Image Handling
        if ($request->hasFile('profile_image')) {
            // Delete previous image if exists
            if ($adminProfile->profile_image && file_exists(public_path('upload/dashboard/images/admin/' . $adminProfile->profile_image))) {
                unlink(public_path('upload/dashboard/images/admin/' . $adminProfile->profile_image));
            }

            // Save new image
            $image = $request->file('profile_image');
            $imageName = Str::random(10) . "-" . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/dashboard/images/admin'), $imageName);
            $adminProfile->profile_image = $imageName;
        }else{
            $adminProfile->profile_image = null;
        }

        // Step 3: Insert
        $adminProfile->phone = $request->phone;
        $adminProfile->alternate_phone = $request->alternate_phone ?? null;
        $adminProfile->address = Str::upper($request->address) ?? null;
        $adminProfile->designation = Str::upper($request->designation);
        $adminProfile->about = Str::upper($request->about) ?? null;
        $adminProfile->city = Str::upper($request->city) ?? null;
        $adminProfile->state = Str::upper($request->state) ?? null;
        $adminProfile->country = Str::upper($request->country) ?? null;
        $adminProfile->zip_code = $request->zip_code ?? null;
        $adminProfile->facebook = Str::lower($request->facebook) ?? null;
        $adminProfile->twitter = Str::lower($request->twitter) ?? null;
        $adminProfile->linkedin = Str::lower($request->linkedin) ?? null;
        $adminProfile->website = Str::lower($request->website) ?? null;

        $adminProfile->save();

        return response()->json(['status' => 'success', 'message' => 'Profile saved successfully']);
    } catch (Exception $ex) {
        return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
    }
}


    /**
     * admin profile details
     */
    public function adminProfileDetails(Request $request)
    {
        try{
            $adminProfile = AdminProfile::where('admin_id', $request->admin_id)->first();
            return response()->json(['status' => 'success', 'data' => $adminProfile]);
        }catch(Exception $ex){
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function adminProfileViewPage()
    {
        try{
            return view('pages.backend.adminProfileViewPage');
        }catch(Exception $ex){
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
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
