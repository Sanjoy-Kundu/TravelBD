<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Agent;
use Illuminate\Support\Str;
use App\Models\AgentProfile;
use Illuminate\Http\Request;

class AgentProfileController extends Controller
{
    /**
     * staff Dashboard profile view page
     */
    public function agentProfileCreate(){
         try{
            return view('pages.backend.agent.agentProfileCreatePage');
        }catch(Exception $ex){
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }

    /**
     * Agent Profile Store
     */
public function agentProfileStore(Request $request)
{
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
        $agent = Agent::find($request->agent_id);
        if (!$agent) {
            return response()->json(['status' => 'error', 'message' => 'Agent not found']);
        }

        $agentProfile = AgentProfile::where('agent_id', $request->agent_id)->first();

        if (!$agentProfile) {
            $agentProfile = new AgentProfile();
            $agentProfile->agent_id = $request->agent_id;
        }

        if ($request->hasFile('profile_image')) {
            if ($agentProfile->profile_image && file_exists(public_path('upload/dashboard/images/agent/' . $agentProfile->profile_image))) {
                unlink(public_path('upload/dashboard/images/agent/' . $agentProfile->profile_image));
            }

            $image = $request->file('profile_image');
            $imageName = Str::random(10) . "-" . time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('upload/dashboard/images/agent');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);
            $agentProfile->profile_image = $imageName;
        }

        $agentProfile->phone = $request->phone;
        $agentProfile->alternate_phone = $request->alternate_phone ?? null;
        $agentProfile->address = $request->address ? Str::upper($request->address) : null;
        $agentProfile->designation = $request->designation ? Str::upper($request->designation) : null;
        $agentProfile->about = $request->about ? Str::upper($request->about) : null;
        $agentProfile->city = $request->city ? Str::upper($request->city) : null;
        $agentProfile->state = $request->state ? Str::upper($request->state) : null;
        $agentProfile->country = $request->country ? Str::upper($request->country) : null;
        $agentProfile->zip_code = $request->zip_code ?? null;
        $agentProfile->facebook = $request->facebook ? Str::lower($request->facebook) : null;
        $agentProfile->twitter = $request->twitter ? Str::lower($request->twitter) : null;
        $agentProfile->linkedin = $request->linkedin ? Str::lower($request->linkedin) : null;
        $agentProfile->website = $request->website ? Str::lower($request->website) : null;
        $agentProfile->gender = $request->gender ? Str::lower($request->gender) : null;

        $agentProfile->save();

        return response()->json(['status' => 'success', 'message' => 'Agent Profile saved successfully']);
    } catch (Exception $ex) {
        return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
    }
}





/**
 * agent profile view page 
 */
public function agentProfileViewPage(){
         try{
            return view('pages.backend.agent.agentProfileViewPage');
        }catch(Exception $ex){
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
}


    /**
     * Agent profile details
     */

    public function agentProfileDetails(Request $request)
    {
        try{
            $agentProfile = AgentProfile::where('agent_id', $request->agent_id)->first();
            return response()->json(['status' => 'success', 'data' => $agentProfile]);
        }catch(Exception $ex){
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AgentProfile $agentProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AgentProfile $agentProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AgentProfile $agentProfile)
    {
        //
    }
}
