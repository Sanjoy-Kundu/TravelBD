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
        $adminProfile->address = $request->address ?? null;
        $adminProfile->designation = $request->designation;
        $adminProfile->about = $request->about ?? null;
        $adminProfile->city = $request->city ?? null;
        $adminProfile->state = $request->state ?? null;
        $adminProfile->country = $request->country ?? null;
        $adminProfile->zip_code = $request->zip_code ?? null;
        $adminProfile->facebook = $request->facebook ?? null;
        $adminProfile->twitter = $request->twitter ?? null;
        $adminProfile->linkedin = $request->linkedin ?? null;
        $adminProfile->website = $request->website ?? null;

        $adminProfile->save();

        return response()->json(['status' => 'success', 'message' => 'Profile saved successfully']);
    } catch (Exception $ex) {
        return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
    }
}


    /**
     * admin profile details
     */
    public function adminProfileDetails()
    {
        try{
            $adminProfile = AdminProfile::first();
            return response()->json(['status' => 'success', 'data' => $adminProfile]);
        }catch(Exception $ex){
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
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
