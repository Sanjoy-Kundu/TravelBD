<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Staff;
use Illuminate\Support\Str;
use App\Models\StaffProfile;
use Illuminate\Http\Request;

class StaffProfileController extends Controller
{
     /**
     * staff Dashboard profile view page
     */
    public function staffProfilePage(){
         try{
            return view('pages.backend.staff.staffProfilePage');
        }catch(Exception $ex){
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }
  

    /**
     * Staff Profile Store
     */
   public function staffProfileStore(Request $request)
{
    // Step 1: Validation 
    $request->validate([
        'phone' => 'required|string|max:20',
        'address' => 'required|string|max:255',
        'designation' => 'required|string|max:100',
        'about' => 'required|string',
        'gender' => 'required',

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
        $admin = Staff::find($request->staff_id);
        if (!$admin) {
            return response()->json(['status' => 'error', 'message' => 'Admin not found']);
        }

        $staffProfile = StaffProfile::where('staff_id', $request->staff_id)->first();

        if (!$staffProfile) {
            $staffProfile = new StaffProfile();
            $staffProfile->staff_id = $request->staff_id;
        }

        // Step 2: Image Handling
        if ($request->hasFile('profile_image')) {
            // Delete previous image if exists
            if ($staffProfile->profile_image && file_exists(public_path('upload/dashboard/images/staff/' . $staffProfile->profile_image))) {
                unlink(public_path('upload/dashboard/images/staff/' . $staffProfile->profile_image));
            }

            // Save new image
            $image = $request->file('profile_image');
            $imageName = Str::random(10) . "-" . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/dashboard/images/staff'), $imageName);
            $staffProfile->profile_image = $imageName;
        }

        // Step 3: Insert
        $staffProfile->phone = $request->phone;
        $staffProfile->alternate_phone = $request->alternate_phone ?? null;
        $staffProfile->address = Str::upper($request->address) ?? null;
        $staffProfile->designation = Str::upper($request->designation);
        $staffProfile->about = Str::upper($request->about) ?? null;
        $staffProfile->city = Str::upper($request->city) ?? null;
        $staffProfile->state = Str::upper($request->state) ?? null;
        $staffProfile->country = Str::upper($request->country) ?? null;
        $staffProfile->zip_code = $request->zip_code ?? null;
        $staffProfile->facebook = Str::lower($request->facebook) ?? null;
        $staffProfile->twitter = Str::lower($request->twitter) ?? null;
        $staffProfile->linkedin = Str::lower($request->linkedin) ?? null;
        $staffProfile->website = Str::lower($request->website) ?? null;
        $staffProfile->gender = Str::upper($request->gender) ?? null;

        $staffProfile->save();

        return response()->json(['status' => 'success', 'message' => 'Profile saved successfully']);
    } catch (Exception $ex) {
        return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
    }
}

    /**
     * Staff profile details
     */
    public function staffProfileDetails(Request $request)
    {
        try{
            $staffProfile = StaffProfile::where('staff_id', $request->staff_id)->first();
            return response()->json(['status' => 'success', 'data' => $staffProfile]);
        }catch(Exception $ex){
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(StaffProfile $staffProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StaffProfile $staffProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StaffProfile $staffProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StaffProfile $staffProfile)
    {
        //
    }
}
