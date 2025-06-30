<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
{

    /**
     * agent create page for dashboard
     */
        public function agentLoginPage(){
        try{
            return view("/form.agent.login");
        }catch(Exception $ex){
            return response()->json(['error' => $ex->getMessage()]);
        }
    }




    /**
     * otp verify page 
     */
    public function otpVerifyPage(){
        try{
            return view("/form.agent.otp_verify");
        }catch(Exception $ex){
            return response()->json(['error' => $ex->getMessage()]);
        }
    }



    /**
     * ======================
     * Otp verify store
     * ======================
     */
       /**
     * otp verify
     */
    public function agent_otp_verify_store(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ]);

        try {
            $agent = Agent::where('otp', $request->otp)->first();

            if (!$agent || $agent->otp !== $request->otp) {
                return response()->json(
                    [
                        'status' => 'otp_error',
                        'message' => 'Invalid OTP',
                    ],
                    401,
                );
            }

            if ($agent->is_verified == false) {
                return response()->json(
                    [
                        'status' => 'verified_error',
                        'message' => 'Admin has been not approve your account yet. If admin Approve You can login Autometically',
                    ],
                    403,
                );
            }

            if ($agent->otp_expires_at && Carbon::now()->gt(Carbon::parse($agent->otp_expires_at))) {
                return response()->json(
                    [
                        'status' => 'otp_expired',
                        'message' => 'OTP Expired',
                    ],
                    401,
                );
            }

            // Update the verified status 'email_verified_at' => now(),
            $agent->update([
                'otp' => null,
                'otp_expires_at' => null,
                'is_verified' => true,
            ]);

            $token = $agent->createToken('token')->plainTextToken;

            return response()->json(
                [
                    'status' => 'otp_success',
                    'message' => 'OTP verified successfully',
                    'token' => $token,
                    'agent' => $agent,
                ],
                200,
            );
        } catch (Exception $ex) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $ex->getMessage(),
                ],
                500,
            );
        }
    }


        /**
     * agent login store
     */
    public function agent_login_store(Request $request)
    {
        $request->validate([
            'email_or_agent_code' => 'required|string',
            'password' => 'required',
        ]);

        try {
            // Step 1: user exists and check password
            $agent = Agent::withTrashed()
                ->where(function ($q) use ($request) {
                    $q->where('email', $request->email_or_agent_code)->orWhere('agent_code', $request->email_or_agent_code);
                })
                ->where('role', 'agent')
                ->first();

            // Step 1: password and email or staff code not mathc
            if (!$agent || !Hash::check($request->password, $agent->password)) {
                return response()->json([
                    'status' => 'message_error',
                    'message' => 'Invalid email or password',
                ]);
            }

            // account jodi trash kora theke
            if ($agent->trashed()) {
                return response()->json([
                    'status' => 'message_error',
                    'message' => 'This account is deactivated. Contact Our Admin or HR.',
                ]);
            }

            // verify na thakle otp diye verify kore login kore dashboard e jete hobe
            if (!$agent->is_verified && $agent->otp !== null) {
                return response()->json([
                    'status' => 'otp_required',
                    'message' => 'OTP verification is required. Please Check Your Mail.',
                    'email' => $agent->email,
                ]);
            }

            $token = $agent->createToken('token')->plainTextToken;

            return response()->json([
                'status' => 'login_success',
                'message' => 'Login successful',
                'token' => $token,
                'user' => $agent,
            ]);
        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ],
                500,
            );
        }
    }




    /**
     * ==========================
     * Agent Dashboard
     * ===========================
     */
    public function agentDashboard(){
        try{
            return view('pages.backend.agent.agentDashboardPage');
        }catch(Exception $ex){
            return response()->json(["status" => "error", "message" => $ex->getMessage()]);
        }
    }



        /**
     * Agent details for nav
     */
    public function agentDetails()
    {
        try {
            $user = Auth::user();
            return response()->json(['status' => 'success', 'data' => $user]);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage(),
            ]);
        }
    }



    /**
     * Agent create page for dashboard
     */
        /**
     * Staff create page
     */
    public function agentCreatePage()
    {
        try {
            return view('pages.backend.agent.agentCreatePage');
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()], 500);
        }
    }



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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agent $agent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agent $agent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agent $agent)
    {
        //
    }
}
