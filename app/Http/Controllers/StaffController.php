<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Staff;
use App\Mail\StaffOtp;
use App\Mail\ResendOtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class StaffController extends Controller
{
    /**
     * staff login store
     */
    public function staff_login_store(Request $request)
    {
        $request->validate([
            'email_or_staff_code' => 'required|string',
            'password' => 'required',
        ]);

        try {
            // Step 1: user exists and check password
            $staff = Staff::withTrashed()
                ->where(function ($q) use ($request) {
                    $q->where('email', $request->email_or_staff_code)->orWhere('staff_code', $request->email_or_staff_code);
                })
                ->where('role', 'staff')
                ->first();

            // Step 1: password and email or staff code not mathc
            if (!$staff || !Hash::check($request->password, $staff->password)) {
                return response()->json([
                    'status' => 'message_error',
                    'message' => 'Invalid email or password',
                ]);
            }

            // account jodi trash kora theke
            if ($staff->trashed()) {
                return response()->json([
                    'status' => 'message_error',
                    'message' => 'This account is deactivated. Contact Our Admin or HR.',
                ]);
            }

            // verify na thakle otp diye verify kore login kore dashboard e jete hobe
            if (!$staff->is_verified && $staff->otp !== null) {
                return response()->json([
                    'status' => 'otp_required',
                    'message' => 'OTP verification is required. Please Check Your Mail.',
                    'email' => $staff->email,
                ]);
            }

            $token = $staff->createToken('token')->plainTextToken;

            return response()->json([
                'status' => 'login_success',
                'message' => 'Login successful',
                'token' => $token,
                'user' => $staff,
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
     * otp page
     */
    public function otpVerifyPage()
    {
        try {
            return view('form.staff.otpPage');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Staff create page
     */
    public function staffCreatePage()
    {
        try {
            return view('pages.backend.staff.staffCreatePage');
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()], 500);
        }
    }

    /**
     * otp verify
     */
    public function staff_otp_verify_store(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ]);

        try {
            $staff = Staff::where('otp', $request->otp)->first();

            if (!$staff || $staff->otp !== $request->otp) {
                return response()->json(
                    [
                        'status' => 'otp_error',
                        'message' => 'Invalid OTP',
                    ],
                    401,
                );
            }

            if ($staff->is_verified == false) {
                return response()->json(
                    [
                        'status' => 'verified_error',
                        'message' => 'Admin has been not approve your account yet. If admin Approve You can login Autometically',
                    ],
                    403,
                ); 
            }

            if ($staff->otp_expires_at && Carbon::now()->gt(Carbon::parse($staff->otp_expires_at))) {
                return response()->json(
                    [
                        'status' => 'otp_expired',
                        'message' => 'OTP Expired',
                    ],
                    401,
                );
            }

            // Update the verified status 'email_verified_at' => now(),
            $staff->update([
                'otp' => null,
                'otp_expires_at' => null,
                'is_verified' => true,
            ]);

            $token = $staff->createToken('token')->plainTextToken;

            return response()->json(
                [
                    'status' => 'otp_success',
                    'message' => 'OTP verified successfully',
                    'token' => $token,
                    'staff' => $staff,
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
     * Staff resend Otp
     */
    public function staff_resend_otp(Request $request){
       try {
        $email = $request->email;
        $staff = Staff::where('email', $email)->first();

        if (!$staff) {
            return response()->json(['status' => 'error', 'message' => 'Staff not found'], 404);
        }

        // OTP expiration time check
        $now = now();

        // time validation
        if ($staff->otp_expires_at  && $now->lt($staff->otp_expires_at )) {
            return response()->json([
                'status' => 'error',
                'message' => 'OTP is still valid. Please wait before requesting a new OTP. Just Wait for 22 minutes. Or check your Email First OTP is send to your Email.',
            ], 429); // Too Many Requests
        }

        // OTP expired, নতুন OTP তৈরি ও save করো
        $newOtp = rand(100000, 999999);
        $staff->otp = $newOtp;
        $staff->otp_expires_at  = $now->addMinutes(20); // 5 মিনিটের OTP validity
        $staff->save();

        $staffEmail = $staff->email;
        // Send OTP Email (যেমন )
        Mail::to($staff->email)->send(new ResendOtpMail($newOtp,$staffEmail));

        return response()->json([
            'status' => 'success',
            'message' => 'New OTP has been sent to your email.'
        ]);
    } catch (Exception $ex) {
        return response()->json([
            'status' => 'error',
            'message' => $ex->getMessage()
        ], 500);
    }
    }





    /**
     * Staff Dashboard
     */
    public function staffDashboard()
    {
        return view('pages.backend.staff.staffDashboardPage');
    }

    /**
     * Staff details for nav 
     */
    public function staffDetails(){
        try{
            $user = Auth::user();
            return response()->json(['status' => 'success', 'data' => $user]);
        }catch(Exception $ex){
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }



    /**
     * staff logout 
     */
    public function logout(Request $request){
       $request->user()->currentAccessToken()->delete();
          return response()->json([
        'status' => 'success',
        'message' => 'Logged out successfully',
    ]);
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
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        //
    }
}
