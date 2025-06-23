<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Admin;
use App\Mail\AdminOtp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{

    /**
     * admin dashboard page
     */
    public function adminDashboardPage(){
        try{
            return view("pages.backend.adminDashboardPage");
        }catch(Exception $ex){
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }



    /**
     * verify otp page
     */
    public function otpVerifyPage()
    {
        try {
            return view('form.otpPage');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * admin login
     */
    public function admin_login_store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            $admin = Admin::where('email', $request->email)->where('role', 'admin')->first();

            // Step 1: Check if user exists and password matches
            if (!$admin || !Hash::check($request->password, $admin->password)) {
                return response()->json([
                    'status' => 'message_error',
                    'message' => 'Invalid email or password',
                ]);
            }

            // Step 2: If not verified, send OTP
            if (!$admin->is_verified) {
                $otp = rand(100000, 999999);
                $admin->otp = $otp;
                $admin->otp_expires_at = now()->addMinutes(5);
                $admin->save();

                Mail::to($admin->email)->send(new AdminOtp($admin->fresh()));

                return response()->json([
                    'status' => 'otp_send_success',
                    'message' => 'OTP sent to your email. Please verify to proceed.',
                    'email' => $admin->email,
                ]);
            }

            // Step 3: If verified, login directly
            $token = $admin->createToken('token')->plainTextToken;

            return response()->json([
                'status' => 'login_success',
                'message' => 'Login successful',
                'token' => $token,
                'user' => $admin,
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
     * admin registration
     */
    public function admin_registration_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:admins',
            'password' => 'required|string|min:8',
        ]);

        try {
            Admin::create([
                'name' => Str::upper($request->name),
                'email' => Str::lower($request->email),
                'password' => bcrypt($request->password),
                'role' => 'admin',
            ]);
            return response()->json(['status' => 'success', 'message' => 'Admin created successfully'], 201);
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()], 500);
        }
    }

    /**
     * admin otp verify
     */
    public function otp_verify_store(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ]);

        try {
            $admin = Admin::where('otp', $request->otp)->first();

            if (!$admin || $admin->otp !== $request->otp || $admin->otp_expires_at < now()) {
                return response()->json(
                    [
                        'status' => 'otp_error',
                        'message' => 'Invalid OTP or OTP Expired',
                    ],
                    401,
                );
            }

            // Update the verified status
            $admin->update([
                'email_verified_at' => now(),
                'otp' => null,
                'otp_expires_at' => null,
                'is_verified' => true,
            ]);

            $token = $admin->createToken('token')->plainTextToken;

            return response()->json(
                [
                    'status' => 'otp_success',
                    'message' => 'OTP verified successfully',
                    'token' => $token,
                    'admin' => $admin,
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
     * Admin details for dashboard
     */
    public function adminDetails()
    {
        try{
            $user = Auth::user();
            return response()->json(["status" => "success","data" => $user]);
        }catch(Exception $ex){
            return response()->json(["status" => "error", "message" => $ex->getMessage()]);
        }
    }

    /**
     * admin logout
     */
    public function adminLogout(Request $request)
    {
        try{
            $user = $request->user(); #for authetication user info 
            if($user && $user->currentAccessToken()){
                $user->currentAccessToken()->delete();
            };
            return response()->json(["status" => "success", "message" => "Logout successfully"]);
        }catch(Exception $ex){
            return response()->json(["status" => "error", "message" => $ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
