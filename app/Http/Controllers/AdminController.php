<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Admin;
use App\Mail\AdminOtp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{


    /**
     * how to use yazara datable : composer require yajra/laravel-datatables-oracle

     * 
     */

// public function adminListData(Request $request)
// {
//     if ($request->ajax()) {
//         $admins = Admin::with('adminProfile')->select(['id', 'name', 'email', 'role', 'created_at']);

//         return DataTables::of($admins)
//             ->addIndexColumn()
//             ->editColumn('created_at', function ($admin) {
//                 return $admin->created_at->format('Y-m-d');
//             })

//             // Profile fields (safely check using optional())
//             ->addColumn('phone', function ($admin) {
//                 return optional($admin->adminProfile)->phone ?? 'N/A';
//             })
//             ->addColumn('alternate_phone', function ($admin) {
//                 return optional($admin->adminProfile)->alternate_phone ?? 'N/A';
//             })
//             ->addColumn('address', function ($admin) {
//                 return optional($admin->adminProfile)->address ?? 'N/A';
//             })
//             ->addColumn('city', function ($admin) {
//                 return optional($admin->adminProfile)->city ?? 'N/A';
//             })
//             ->addColumn('state', function ($admin) {
//                 return optional($admin->adminProfile)->state ?? 'N/A';
//             })
//             ->addColumn('country', function ($admin) {
//                 return optional($admin->adminProfile)->country ?? 'N/A';
//             })
//             ->addColumn('zip_code', function ($admin) {
//                 return optional($admin->adminProfile)->zip_code ?? 'N/A';
//             })
//             ->addColumn('designation', function ($admin) {
//                 return optional($admin->adminProfile)->designation ?? 'N/A';
//             })
//             ->addColumn('facebook', function ($admin) {
//                 return optional($admin->adminProfile)->facebook ?? 'N/A';
//             })
//             ->addColumn('twitter', function ($admin) {
//                 return optional($admin->adminProfile)->twitter ?? 'N/A';
//             })
//             ->addColumn('linkedin', function ($admin) {
//                 return optional($admin->adminProfile)->linkedin ?? 'N/A';
//             })
//             ->addColumn('website', function ($admin) {
//                 return optional($admin->adminProfile)->website ?? 'N/A';
//             })

//             // Profile image (if needed)
//             ->addColumn('profile_image', function ($admin) {
//                 $img = optional($admin->adminProfile)->profile_image;
//                 $path = $img ? asset('upload/dashboard/images/admin/' . $img) : asset('upload/dashboard/images/admin/default.png');
//                 return '<img src="'.$path.'" width="50" height="50" class="rounded-circle"/>';
//             })

//             ->rawColumns(['profile_image']) // Allow HTML for image
//             ->make(true);
//     }
// }



/**
 * admin list page
 * 
 */
public function adminListsPage(){
    try{
        return view("pages.backend.adminListPage");
    }catch(Exception $ex){
        return redirect()->back()->with('error', $ex->getMessage());
    }
}




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
     * admin list page
     */
    public function adminListPage(){
        try{
            #$all_admins = Admin::where('role', 'admin')->get();
            return view("pages.backend.adminListPage");
        }catch(Exception $ex){
            return response()->json(["status" => "error", "message" => $ex->getMessage()]);
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
     * admin name update by email
     */
public function adminNameUpdateByEmail(Request $request)
{
    // Step 1: Validation
    $request->validate([
        'email' => 'required|email',
        'name' => 'required|string|max:255',
    ]);

    $admin = Admin::where('email', $request->email)->first();

    if (!$admin) {
        return response()->json([
            'status' => 'error',
            'message' => 'Admin not found with this email'
        ]);
    }

    $admin->name = Str::upper($request->name);
    $admin->save();


    return response()->json([
        'status' => 'success',
        'message' => 'Admin name updated successfully',
       
    ]);
}



/**
 * admin list all data api
 */
public function adminListsData(){
    try{
        $admins = Admin::with('profile')->get();
        return response()->json(["status" => "success", "message" => "Admin list", "admin_lists" => $admins]);
    }catch(Exception $ex){
        return response()->json(["status" => "error", "message" => $ex->getMessage()]);
    }
}

}
