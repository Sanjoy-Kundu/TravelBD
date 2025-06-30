<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Admin;
use App\Models\Agent;
use App\Models\Staff;
use App\Mail\AdminOtp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\AgentWelcomeMail;
use App\Mail\StaffWelcomeMail;
use App\Mail\AgentVerifiedMail;
use App\Mail\StaffVerifiedMail;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminDeleteNotification;
use App\Mail\StaffDeleteNotification;
use App\Mail\AdminPermanentDeleteMail;
use App\Mail\AdminRestoreNotification;
use App\Mail\StaffPermanentDeleteMail;
use App\Mail\StaffRestoreNotification;

class AdminController extends Controller
{


    /**
     * admin list page
     *
     */
    public function adminListsPage()
    {
        try {
            return view('pages.backend.adminListPage');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * admin dashboard page
     */
    public function adminDashboardPage()
    {
        try {
            return view('pages.backend.adminDashboardPage');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * admin list page
     */
    public function adminListPage()
    {
        try {
            #$all_admins = Admin::where('role', 'admin')->get();
            return view('pages.backend.adminListPage');
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
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
                //$admin->otp_expires_at = now()->addMinutes(5);
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

            if (!$admin || $admin->otp !== $request->otp) {
                return response()->json(
                    [
                        'status' => 'otp_error',
                        'message' => 'Invalid OTP or OTP Expired',
                    ],
                    401,
                );
            }

            // Update the verified status 'email_verified_at' => now(),
            $admin->update([
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
        try {
            $user = Auth::user();
            return response()->json(['status' => 'success', 'data' => $user]);
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }

    /**
     * admin logout
     */
    public function adminLogout(Request $request)
    {
        try {
            $user = $request->user(); #for authetication user info
            if ($user && $user->currentAccessToken()) {
                $user->currentAccessToken()->delete();
            }
            return response()->json(['status' => 'success', 'message' => 'Logout successfully']);
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
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
                'message' => 'Admin not found with this email',
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
    public function adminListsData()
    {
        try {
            $admins = Admin::with('profile')->get();
            return response()->json(['status' => 'success', 'message' => 'Admin list', 'admin_lists' => $admins]);
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }

    //trash data show
public function adminListsTrashData()
{
    try {
        // get trash admin
        $admins = Admin::onlyTrashed()->with('profile')->get();

        return response()->json(['status' => 'success','message' => 'Trashed admin list','trash_admin_lists' => $admins]);
    } catch (Exception $ex) {
        return response()->json([
            'status' => 'error',
            'message' => $ex->getMessage()
        ]);
    }
}









    /**
     * admin view detais by id with profile details
     */
    public function adminViewDetailsModal(Request $request)
    {
        try {
            $admin = Admin::with('profile')->where('id', $request->id)->first();
            if (!$admin) {
                return response()->json(['status' => 'error', 'message' => 'Admin not found with this id']);
            }

            return response()->json(['status' => 'success', 'admin_details' => $admin]);
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }

    /**
     * Not Verified Admin delete list
     */
    public function adminDeleteTrash(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:admins,id',
        ]);

        $admin = Admin::find($request->id);

        if (!$admin) {
            return response()->json(['status' => 'error', 'message' => 'Admin not found']);
        }

        // if ($admin->is_verified == 1) {
        //     return response()->json(['status' => 'error', 'message' => 'You cannot delete a verified admin']);
        // }

        // Try sending email
        try {
            Mail::to($admin->email)->send(new AdminDeleteNotification($admin->name, $admin->email));
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Email sending failed.', 'error' => $e->getMessage()]);
        }

        $admin->delete();

        return response()->json(['status' => 'success', 'message' => 'Admin account deleted and email sent.']);
    }

    /***
     * Admin reset password
     */
    public function adminResetPassword(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:admins,id',
                'old_password' => 'required',
                'new_password' => 'required|min:8',
                'password' => 'required|min:8',
            ]);

            $admin = Admin::find($request->id);

            if ($admin->id !== Auth::id()) {
                return response()->json(['status' => 'error', 'message' => 'You are not authorized.']);
            }

            if (!Hash::check($request->old_password, $admin->password)) {
                return response()->json(['status' => 'error', 'message' => 'Old password is incorrect.']);
            }

            $admin->password = Hash::make($request->new_password);
            $admin->save();

            return response()->json(['status' => 'success', 'message' => 'Password updated successfully.']);
        } catch (\Exception $ex) {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong.']);
        }
    }

    /**
     * ===============================
     * admin dashboard all staff page
     * ===============================
     */
    public function staffListsPage()
    {
        try {
            return view('pages.backend.adminDashboardStaffListsPage');
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong.']);
        }
    }

    /**
     * ===============================
     * Admin create staff
     * ===============================
     */
    public function CreateStaffStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:staffs',
        ]);

        // Random values
        $plainPassword = Str::random(8);
        $staffCode = 'STAFF-' . strtoupper(Str::random(12));
        $otp = rand(100000, 999999);

        // Staff create
        $staff = Staff::create([
            'admin_id' => $request->admin_id, // যদি Sanctum token এ admin login থাকে
            'name' => Str::upper($request->name),
            'email' => Str::lower($request->email),
            'password' => bcrypt($plainPassword),
            'staff_code' => $staffCode,
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(20), //default null
            'is_verified' => false,
            'role' => 'staff',
        ]);

        // Mail send to staff
        Mail::to($staff->email)->send(new StaffWelcomeMail($staff, $plainPassword));

        return response()->json([
            'status' => 'success',
            'message' => 'Staff created and email sent successfully.',
        ]);
    }

    /**
     * ========================
     * Load staff data
     * ========================
     */
    public function allStaffsData()
    {
        try {
            //$admins = Staff::with('profile')->get();
            $staffs = Staff::all();
            return response()->json(['status' => 'success', 'message' => 'Staff list', 'staff_lists' => $staffs]);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * ========================
     * staff delete not verified
     * ==========================
     */
    /**
     * Not Verified Admin delete list
     */
    public function stafTrash(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:staffs,id',
        ]);

        $staff = Staff::find($request->id);

        if (!$staff) {
            return response()->json(['status' => 'error', 'message' => 'Staff not found']);
        }

        // if ($staff->is_verified == 1) {
        //     return response()->json(['status' => 'error', 'message' => 'You cannot delete a verified staff']);
        // }

        // Try sending email
        try {
            Mail::to($staff->email)->send(new StaffDeleteNotification($staff->name, $staff->email));
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Email sending failed.', 'error' => $e->getMessage()]);
        }

        $staff->delete();

        return response()->json(['status' => 'success', 'message' => 'Admin account suspended and email sent.']);
    }

    /**
     * ==========================
     * Trash staff data load
     * ==========================
     */
    public function trashStaffsData()
    {
        try {
            $trashStaffLists = Staff::onlyTrashed()->get();
            return response()->json(['status' => 'success', 'trashStaffLists' => $trashStaffLists]);
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }


    /**
     * Admin restore
     */
    public function adminRestore(Request $request)
    {
        try {
            // Trashed soho khujbo
            $admin = Admin::withTrashed()->find($request->id);

            // amdin not found
            if (!$admin) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Admin not found.',
                ]);
            }

            // admin not delete
            if (!$admin->trashed()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'This admin is already active.',
                ]);
            }

            // just restore now
            $admin->restore();

            Mail::to($admin->email)->send(new AdminRestoreNotification($admin));
            return response()->json([
                'status' => 'success',
                'message' => 'Admin restored successfully.',
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage(),
            ]);
        }
    }


        /**
     * staff permanent delete
     */

    public function adminPermanentDelete(Request $request)
    {
        // 1. Find the admin with trashed
        $admin = Admin::withTrashed()->with('profile')->find($request->id);

        // 2. If admin not found
        if (!$admin) {
            return response()->json([
                'status' => 'error',
                'message' => 'Admin not found.',
            ]);
        }

        // 3. If admin is not trashed (still active)
        if (!$admin->trashed()) {
            return response()->json([
                'status' => 'error',
                'message' => 'This admin is still active.',
            ]);
        }

        // 4. Handle profile image & delete profile record
        if ($admin->profile && $admin->profile->profile_image) {
            $imagePath = public_path('upload/dashboard/images/admin/' . $admin->profile->profile_image);

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            $admin->profile->delete();
        }

        // 5. Send permanent delete mail
        Mail::to($admin->email)->send(new AdminPermanentDeleteMail($admin));

        // 6. Finally permanently delete staff
        $admin->forceDelete();

        // 7. Return success
        return response()->json([
            'status' => 'success',
            'message' => 'Admin and profile permanently deleted and mail sent.',
        ]);
    }















    /**
     * staff restore
     */
    public function staffRestore(Request $request)
    {
        try {
            // Trashed soho khujbo
            $staff = Staff::withTrashed()->find($request->id);

            // staff not found
            if (!$staff) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Staff not found.',
                ]);
            }

            // staff not delete
            if (!$staff->trashed()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'This staff is already active.',
                ]);
            }

            // just restore now
            $staff->restore();

            Mail::to($staff->email)->send(new StaffRestoreNotification($staff));
            return response()->json([
                'status' => 'success',
                'message' => 'Staff restored successfully.',
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage(),
            ]);
        }
    }

    /**
     * staff permanent delete
     */

    public function staffPermanentDelete(Request $request)
    {
        // 1. Find the staff with trashed
        $staff = Staff::withTrashed()->with('profile')->find($request->id);

        // 2. If staff not found
        if (!$staff) {
            return response()->json([
                'status' => 'error',
                'message' => 'Staff not found.',
            ]);
        }

        // 3. If staff is not trashed (still active)
        if (!$staff->trashed()) {
            return response()->json([
                'status' => 'error',
                'message' => 'This staff is still active.',
            ]);
        }

        // 4. Handle profile image & delete profile record
        if ($staff->profile && $staff->profile->profile_image) {
            $imagePath = public_path('upload/dashboard/images/staff/' . $staff->profile->profile_image);

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            $staff->profile->delete();
        }

        // 5. Send permanent delete mail
        Mail::to($staff->email)->send(new StaffPermanentDeleteMail($staff));

        // 6. Finally permanently delete staff
        $staff->forceDelete();

        // 7. Return success
        return response()->json([
            'status' => 'success',
            'message' => 'Staff and profile permanently deleted and mail sent.',
        ]);
    }


    /**
     * staff verify
     */
    public function staffVerify(Request $request)
    {
        try {
            // find staff
            $staff = Staff::find($request->id);

            if (!$staff) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Staff not found.',
                ]);
            }

            // if previous verfied
            if ($staff->is_verified == 1) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'This staff is already verified.',
                ]);
            }

            // now update field
            $staff->is_verified = 1;
            $staff->otp = 0;
            $staff->save();

            // now sending emial
            Mail::to($staff->email)->send(new StaffVerifiedMail($staff));

            return response()->json([
                'status' => 'success',
                'message' => 'Staff has been verified successfully & email sent.',
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage(),
            ]);
        }
    }

    /**
     * view staff details
     */
    public function staffViewDetailsModal(Request $request)
    {
        try {
            $staffDetails = Staff::with('profile')->where('id', $request->id)->first();
            if (!$staffDetails) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Staff not found.',
                ]);
            }
            return response()->json([
                'status' => 'success',
                'data' => $staffDetails,
            ]);
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }















       /**
     * ===============================
     * Admin create agent admin dashboard
     * ===============================
     */
    public function CreateAgentStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:agents',
        ]);

        // Random values
        $password = Str::random(8);
        $agentCode = 'AGENT-' . strtoupper(Str::random(12));
        $otp = rand(100000, 999999);

        // Agent create
        $agent = Agent::create([
            'admin_id' => $request->admin_id, 
            'name' => Str::upper($request->name),
            'email' => Str::lower($request->email),
            'password' => bcrypt($password),
            'agent_code' => $agentCode,
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(20), //default null
            'is_verified' => false,
            'role' => 'agent',
        ]);

        // Mail send to staff
        Mail::to($agent->email)->send(new AgentWelcomeMail($agent, $password));

        return response()->json([
            'status' => 'success',
            'message' => 'Agent created and email sent successfully.',
        ]);
    }




    
    /**
     * ===============================
     * admin dashboard all agentlist page
     * ===============================
     */
    public function agentListsPage()
    {
        try {
            return view('pages.backend.agent.adminDashboardAgentListsPage');
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong.']);
        }
    }



    /**
     * ===============================
     * admin dashboard all agentlist page
     * ===============================
     */
    public function allAgentsData(){
              try {
          
            $agents = Agent::all();
            return response()->json(['status' => 'success', 'message' => 'Agent list', 'agent_lists' => $agents]);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }




    /**
     * ===============================
     * admin dashboard agent verify with mail
     * ===============================
     */
    public function agentVerify(Request $request)
    {
        try {
            // find staff
            $agent = Agent::find($request->id);

            if (!$agent) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Agent not found.',
                ]);
            }

            // if previous verfied
            if ($agent->is_verified == 1) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'This staff is already verified.',
                ]);
            }

            // now update field
            $agent->is_verified = 1;
            $agent->otp = 0;
            $agent->save();

            // now sending emial
            Mail::to($agent->email)->send(new AgentVerifiedMail($agent));

            return response()->json([
                'status' => 'success',
                'message' => 'Agent has been verified successfully & email sent.',
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage(),
            ]);
        }
    }










    /*
    ===============================================
    Customer create page
    ================================================
    */
    public function customerCreatePage(){
        try{
            return view('pages.backend.customerCreatePage');
        }catch(Exception $ex){
            return response()->json(["status" => "error", "message" => $ex->getMessage()]);
        }
    }

}
