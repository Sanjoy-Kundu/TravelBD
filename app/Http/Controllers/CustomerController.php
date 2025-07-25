<?php

namespace App\Http\Controllers;

use Exception;
use Throwable;
use Carbon\Carbon;
use App\Models\Package;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PackageCategory;
use App\Models\PackageDiscount;
use App\Mail\WellComeCustomerMail;
use App\Mail\CustomerDetailsChange;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    /**
     * Customer Login Page
     */
    public function customerLoginPage()
    {
        try {
            return view('form.customer.customerLogin');
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Customer Login
     */
    public function customer_login_store(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'date_of_birth' => 'required|date',
            ]);
            $customer = Customer::where('email', $request->email)->where('date_of_birth', $request->date_of_birth)->first();
            if (!$customer) {
                return response()->json(['status' => 'error', 'message' => 'Invalid Credentials'], 401);
            }

            $token = $customer->createToken('auth_token')->plainTextToken;
            return response()->json(['status' => 'login_success', 'message' => 'Login Successfully', 'token' => $token], 200);
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Customer Dashboard
     */
    public function customerDashboard(Request $request)
    {
        try {
            return view('pages.backend.customer.customerDashboardPage');
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    /**
     * All category lists

    */
    public function allCategoryLists(){
        try{
            $PackageCategories = PackageCategory::where('status','active')->get();
            return response()->json(['status' => 'success', 'message' => 'Category Lists', 'PackageCategories' => $PackageCategories], 200);
        }catch(Exception $ex){
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }




    /**
     *Pcakge list by category admin and agent
     */
public function packageListByCategory(Request $request)
{
    try {
        $category_id = $request->category_id;
        $today = Carbon::now()->format('Y-m-d');

        $searchPackageByCategory = Package::where('category_id', $category_id)
            ->where('status', 'active')
            ->where(function($query) use ($today) {
                $query->whereDate('end_date', '>=', $today)
                      ->orWhereNull('end_date');
            })
            ->whereColumn('seat_availability', '>', 'total_sold')
            ->get();

        if ($searchPackageByCategory->isEmpty()) {
            $seatCheck  = Package::where('category_id', $category_id)
                ->where('status', 'active')
                ->where(function($query) use ($today) {
                    $query->whereDate('end_date', '>=', $today)
                          ->orWhereNull('end_date');
                })
                ->whereColumn('seat_availability', '<=', 'total_sold')
                ->exists();

            if($seatCheck){
                return response()->json(['status' => 'error','message' => 'Application Seat totally Full. So You Can not Apply'], 404); 
            }    

            return response()->json([
                'status' => 'error',
                'message' => 'Application date is over'
            ], 404);
        }

        return response()->json(['status' => 'success', 'packageListByCategory' => $searchPackageByCategory], 200);
    } catch (Throwable  $ex) {
        return response()->json(['error' => $ex->getMessage()], 500);
    }
}




/**
 * package list by category by agent
 */
public function agentPackageListByCategoryDetails(Request $request)
{
    try {
        $category_id = $request->category_id;
        $today = Carbon::now()->format('Y-m-d');

       $searchPackageByCategory = Package::where('category_id', $category_id)
            ->where('status', 'active')
            ->where(function($query) use ($today) {
                $query->whereNull('end_date')
                    ->orWhereDate('end_date', '>=', $today);
            })
            ->whereColumn('seat_availability', '>', 'total_sold')
            ->get();

       

        if ($searchPackageByCategory->isEmpty()) {
            $seatCheck  = Package::where('category_id', $category_id)
                ->where('status', 'active')
                ->where(function($query) use ($today) {
                    $query->whereDate('end_date', '>=', $today)
                          ->orWhereNull('end_date');
                })
                ->whereColumn('seat_availability', '<=', 'total_sold')
                ->exists();

            if($seatCheck){
                return response()->json(['status' => 'error','message' => 'Application Seat totally Full.'], 404); 
            }    

            return response()->json([
                'status' => 'error',
                'message' => 'Application date is over'
            ], 404);
        }

        return response()->json(['status' => 'success', 'packageListByCategory' => $searchPackageByCategory], 200);
    } catch (Throwable  $ex) {
        return response()->json(['error' => $ex->getMessage()], 500);
    }
}




/**
 * package list by category by agent
 */

public function agentPackageListByCategory(Request $request)
{
    try {
        $category_id = $request->category_id;
        $today = Carbon::now()->format('Y-m-d');

        $searchPackageByCategory = Package::where('category_id', $category_id)
            ->where('status', 'active')
            ->where(function($query) use ($today) {
                $query->whereDate('end_date', '>=', $today)
                      ->orWhereNull('end_date');
            })
            ->whereColumn('seat_availability', '>', 'total_sold')
            ->get();

        if ($searchPackageByCategory->isEmpty()) {
            $seatCheck  = Package::where('category_id', $category_id)
                ->where('status', 'active')
                ->where(function($query) use ($today) {
                    $query->whereDate('end_date', '>=', $today)
                          ->orWhereNull('end_date');
                })
                ->whereColumn('seat_availability', '<=', 'total_sold')
                ->exists();

            if($seatCheck){
                return response()->json(['status' => 'error','message' => 'Application Seat totally Full.'], 404); 
            }    

            return response()->json([
                'status' => 'error',
                'message' => 'Application date is over'
            ], 404);
        }

        return response()->json(['status' => 'success', 'packageListByCategory' => $searchPackageByCategory], 200);
    } catch (Throwable  $ex) {
        return response()->json(['error' => $ex->getMessage()], 500);
    }
}













    /**
     * admin packge list details by package id
     */
    public function packageListDetails(Request $request)
    {
        try {
            $id = $request->id;
            $packageDetails = Package::with('discounts')->where('id', $id)->first();
            return response()->json(['status' => 'success', 'packageDetails' => $packageDetails], 200);
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    /**
     * Customer page package pirce update
     */
    public function packagePriceUpdateCustomer(Request $request)
    {
        try {
            $id = $request->id;
            $price = $request->price;
            $findPackage = Package::where('id', $id)->first();
            if (!$findPackage) {
                return response()->json(['status' => 'error', 'message' => 'Package not found'], 500);
            }
            if ($findPackage->price == $price) {
                return response()->json(['status' => 'error', 'message' => 'Please Update price'], 500);
            }
            $findPackage->price = $price;
            $findPackage->save();
            return response()->json(['status' => 'success', 'message' => 'Package price updated successfully'], 200);
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()], 500);
        }
    }

    /**
     *apply coupon
     */
    public function packageApplyCoupon(Request $request)
    {
        try {
            $request->validate([
                'coupon_code' => 'required|string',
                'package_id' => 'required|integer',
            ]);

            $couponCode = $request->coupon_code;
            $packageId = $request->package_id;
            $today = Carbon::now()->toDateString();

            // Step 1: Check if discount exists for this package with this coupon
            $coupon = PackageDiscount::where('package_id', $packageId)->where('coupon_code', $couponCode)->where('start_date', '<=', $today)->where('end_date', '>=', $today)->first();

            if (!$coupon) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Invalid or expired coupon for this package',
                    ],
                    400,
                );
            }

            // Step 2: Get the package and calculate discount
            $package = Package::find($packageId);

            if (!$package) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Package not found',
                    ],
                    404,
                );
            }

            $originalPrice = $package->price;
            $discountValue = $coupon->discount_value;
            $discountAmount = $originalPrice - ($originalPrice * $discountValue) / 100;

            return response()->json([
                'status' => 'success',
                'discounted_price' => round($discountAmount),
                'originalPrice' => $originalPrice,
                'discount_value' => $discountValue,
                'coupon_code' => $couponCode,
                'message' => 'Coupon applied successfully',
            ]);
        } catch (\Exception $ex) {
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
     *Customer created by admin
     */
    public function customerCreateByAdmin(Request $request)
    {
        try {
            // Validation
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:customers,email',
                'phone' => 'required|string|max:20',
                'passport_no' => 'required|string|max:50',
                'package_id' => 'required|exists:packages,id',
                'package_category_id' => 'nullable|exists:package_categories,id',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Validation failed!',
                        'errors' => $validator->errors(),
                    ],
                    422,
                );
            }

            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $customer_image_Name = Str::random(20) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->move(public_path('upload/dashboard/images/customers'), $customer_image_Name);
            }

            $package = Package::with('discounts')->find($request->package_id);

            if (!$package) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Package not found',
                    ],
                    404,
                );
            }

            // direct discount
            $directDiscount = $package->discounts->firstWhere('discount_mode', 'direct');

            $discountPercentage = $directDiscount->discount_value ?? 0;
            $price = $package->price ?? 0;
            $discountedPrice = $price - ($price * $discountPercentage) / 100;

            if ($package->seat_availability == 0) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Seat Not Available',
                    ],
                    400,
                );
            }

            if ($request->customer_slot > $package->seat_availability) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Invalid Seat Request. Only ' . $package->seat_availability . ' seat(s) available.',
                    ],
                    400,
                );
            }

            // Create customer
            $customer = Customer::create([
                'admin_id' => $request->admin_id,
                'name' => Str::upper($request->name),
                'email' => Str::lower($request->email),
                'phone' => $request->phone,
                'passport_no' => $request->passport_no,
                'age' => $request->age,
                'date_of_birth' => $request->date_of_birth,
                'gender' => Str::upper($request->gender),
                'nid_number' => $request->nid_number,
                'package_id' => $request->package_id,
                'package_category_id' => $request->package_category_id,

                // From package
                'price' => $price,
                'duration' => $package->duration,
                'inclusions' => $package->inclusions,
                'exclusions' => $package->exclusions,
                'visa_processing_time' => $package->visa_processing_time,
                'documents_required' => $package->documents_required,
                'seat_availability' => $package->seat_availability,
                'package_discount' => $discountPercentage,
                'package_discounted_price' => $discountedPrice,
                'package_total_seat' => $package->seat_availability,

                // Coupon
                'coupon_code' => Str::upper($request->coupon_code),
                'coupon_discount' => $request->coupon_discount ?? null,
                'coupon_use_discounted_price' => $request->coupon_use_discounted_price,

                // Others
                'country' => Str::upper($request->country),
                'company_name' => Str::upper($request->company_name),
                'pic' => $request->pic,
                'sales_commission' => $request->sales_commission,
                'sales_commission_discount' => $request->sales_commission_discount,
                'mrp' => $request->mrp,
                'passenger_price' => $request->passenger_price,

                'medical_date' => $request->medical_date,
                'medical_center' => Str::upper($request->medical_center),
                'medical_result' => Str::upper($request->medical_result),

                'visa_online' => $request->visa_online,
                'calling' => $request->calling,
                'training' => $request->training,
                'e_vissa' => $request->e_vissa,
                'bmet' => $request->bmet,
                'fly' => $request->fly,
                'payment' => $request->payment,
                'payment_method' => $request->payment_method,
                'account_number' => $request->account_number,
                'approval' => $request->approval,
                'customer_slot' => $request->customer_slot,
                'image' => $imagePath,
                'created_by_ip' => $request->ip(),
            ]);

            //sending mail
            Mail::to($customer->email)->send(new WellComeCustomerMail($customer));

            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Customer created successfully! A confirmation email has been sent to the customer with login instruction',
                    'data' => $customer,
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




/*
Customer create by agent
*/
    public function customerCreateByAgent(Request $request){

                $validator = Validator::make($request->all(), [
                'agent_id' => 'required|exists:agents,id',
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:customers,email',
                'phone' => 'required|string|max:20',
                'passport_no' => 'required|string|max:50',
                'package_id' => 'required|exists:packages,id',
                'package_category_id' => 'nullable|exists:package_categories,id',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Validation failed!',
                        'errors' => $validator->errors(),
                    ],
                    422,
                );
            }



        try{
             $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $customer_image_Name = Str::random(20) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->move(public_path('upload/dashboard/images/customers'), $customer_image_Name);
            }

            $customer = Customer::create([
                'agent_id' => $request->agent_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'passport_no' => $request->passport_no,
                'age'=> $request->age,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'nid_number' => $request->nid_number,
                'package_id' => $request->package_id,
                'package_category_id' => $request->package_category_id,
                'image' => $customer_image_Name,
                'customer_slot' => 0,
                'created_by_ip' => $request->ip()
            ]);
            //sending mail
            Mail::to($customer->email)->send(new WellComeCustomerMail($customer));

             return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Customer created successfully! A confirmation email has been sent to the customer with login instruction',
                    'data' => $customer,
                ],
                200,
            );
            
        }catch(Exception $ex){
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }




    /**
     * Working For Customer Dahsboard  customer auth info
     */
    public function customerDetails()
    {
        try {
            $customerDetails = Customer::where('id', auth()->user()->id)->first();
            return response()->json(['status' => 'success', 'data' => $customerDetails]);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage(),
            ]);
        }
    }

    /**
     * Customer Package Details
     */
    public function myPackageDetailsPage()
    {
        try {
            return view('pages.backend.customer.customerPackageDetailsPage');
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage(),
            ]);
        }
    }

    /*
     * Customer Package Details by customer id
     */
    public function customerPackageDetailsById(Request $request)
    {
        $id = $request->id;
        try {
            $searchCustomer = Customer::where('id', $id)->first();
            if (!$searchCustomer) {
                return response()->json(['status' => 'error', 'message' => 'Customer not found']);
            }
            $packageDetails = Customer::with('package', 'packageCategory')->where('id', $id)->first();
            return response()->json(['status' => 'success', 'packages' => $packageDetails]);
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }

    /**
     * Customer Update
     */
        public function customerUpdate(Request $request)
        {
            try {
                $request->validate([
                    'id' => 'required|exists:customers,id',
                    'name' => 'required|string|max:255',
                    'phone' => 'required|string|max:20',
                    'passport_no' => 'nullable|string|max:50',
                    'age' => 'nullable|integer|min:1',
                    'gender' => 'required|in:male,female,other',
                    'date_of_birth' => 'nullable|date',
                    'nid_number' => 'nullable|string|max:50',
                    'country' => 'nullable|string|max:255',
                    'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                ]);

                $customer = Customer::findOrFail($request->id);

                // Store old DOB before updating
                $oldDob = $customer->date_of_birth;

                // Handle image upload
                if ($request->hasFile('image')) {
                    if ($customer->image && file_exists(public_path('upload/dashboard/images/customers/' . $customer->image))) {
                        unlink(public_path('upload/dashboard/images/customers/' . $customer->image));
                    }

                    $file = $request->file('image');
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/dashboard/images/customers/'), $filename);
                    $customer->image = $filename;
                }

                // Update other fields
                $customer->name = $request->name;
                $customer->phone = $request->phone;
                $customer->passport_no = $request->passport_no;
                $customer->age = $request->age;
                $customer->gender = $request->gender;
                $customer->date_of_birth = $request->date_of_birth;
                $customer->nid_number = $request->nid_number;
                $customer->country = $request->country;

                if ($customer->isDirty()) {
                    $customer->save();

                    // Send email if date_of_birth changed
                    if ($oldDob !== $customer->date_of_birth) {
                        Mail::to($customer->email)->send(new CustomerDetailsChange($customer, 'date of birth', $customer->date_of_birth));
                    }

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Customer updated successfully',
                    ]);
                } else {
                    return response()->json([
                        'status' => 'no_change',
                        'message' => 'No changes detected to update.',
                    ]);
                }
            } catch (ValidationException $e) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $e->errors(),
                ], 422);
            } catch (\Exception $ex) {
                return response()->json([
                    'status' => 'error',
                    'message' => $ex->getMessage(),
                ], 500);
            }
        }


/**
* logout
*/
 public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully',
        ]);
    }







/**
 * Customer Dashboard Payment Status Pages
 *  */    
public function paymentPage(){
    try{
        return view('pages.backend.customer.paymentPage');
    }catch(Exception $ex){
        return response()->json(['status' => 'error', 'message' => $ex->getMessage()], 500);
    }
}





/**
 * Customer package details by admin and agent
 */
public function CustomerDetailsById(Request $request){
    try{
        $id = $request->id; 
        $customer = Customer::with('packageCategory','package')->where('id', $id)->first();
        return response()->json(['status' => 'success', 'message' => 'Customer Details', 'customer' => $customer], 200);

    }catch(Exception $ex){
        return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
    }

}



//customer details update by id agent 
public function agentCustomerUpdateById(Request $request)
{
    $customerId = $request->id;

    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'nullable|email|max:255|unique:customers,email,' . $customerId, 
        'passport_no' => 'required|string|max:50',
        'age' => 'nullable|integer',
        'date_of_birth' => 'nullable|date',
        'gender' => 'nullable|in:male,female,other',
        'nid_number' => 'nullable|string|max:255',
        'package_category_id' => 'required|exists:package_categories,id',
        'package_id' => 'required|exists:packages,id',
        'country' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $customer = Customer::where('id', $customerId)
                        ->where('agent_id', auth()->id())
                        ->first();

    if (!$customer) {
        return response()->json([
            'status' => 'fail',
            'message' => 'Customer not found or unauthorized'
        ], 404);
    }


    $noChange = true;

    $fieldsToCheck = [
        'name', 'phone', 'email', 'passport_no', 'age', 'date_of_birth', 'gender',
        'nid_number', 'package_category_id', 'package_id', 'country'
    ];

    foreach ($fieldsToCheck as $field) {
        if ($request->input($field) != $customer->$field) {
            $noChange = false;
            break;
        }
    }

    if ($request->hasFile('image')) {
        $noChange = false;
    }

    if ($noChange) {
        return response()->json([
            'status' => 'fail',
            'message' => 'No changes detected. Please update any field before submitting.'
        ], 422);
    }

    // ডাটা আপডেট করো
    $customer->name = $request->name;
    $customer->phone = $request->phone;
    $customer->email = $request->email;
    $customer->passport_no = $request->passport_no;
    $customer->age = $request->age;
    $customer->date_of_birth = $request->date_of_birth;
    $customer->gender = $request->gender;
    $customer->nid_number = $request->nid_number;
    $customer->package_category_id = $request->package_category_id;
    $customer->package_id = $request->package_id;
    $customer->country = $request->country;

    if ($request->hasFile('image')) {
        if ($customer->image && file_exists(public_path('upload/dashboard/images/customers/' . $customer->image))) {
            unlink(public_path('upload/dashboard/images/customers/' . $customer->image));
        }

        $image = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('upload/dashboard/images/customers/'), $imageName);
        $customer->image = $imageName;
    }

    $customer->save();

    return response()->json([
        'status' => 'success',
        'message' => 'Customer updated successfully',
    ]);
}


//customer delete by agent
public function agentCustomerDeleteById(Request $request){
    $customer = Customer::where('id', $request->id)
                        ->where('agent_id', auth()->id())
                        ->first();

    if(!$customer){
        return response()->json(['status' => 'error', 'message' => 'Customer not found or unauthorized'], 404);
    }
    
    $customer->delete();

    return response()->json([
        'status' => 'success',
        'message' => 'Customer deleted successfully',
    ]);
}












}
