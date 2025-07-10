<?php

namespace App\Http\Controllers;

use App\Mail\WellComeCustomerMail;
use Exception;
use Carbon\Carbon;
use App\Models\Package;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PackageDiscount;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Customer Login Page
     */
    public function customerLoginPage()
    {
        try{
            return view('form.customer.customerLogin');
        }catch(Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    /**
     * Customer Login
     */
    public function customer_login_store(Request $request){
        try{
            $request->validate([
                'email' => 'required|email',
                'date_of_birth' => 'required|date',
            ]);
            $customer = Customer::where('email', $request->email)->where('date_of_birth', $request->date_of_birth)->first();
            if(!$customer){
                return response()->json(['status' => 'error','message' => 'Invalid Credentials'], 401);
            }

            $token = $customer->createToken('auth_token')->plainTextToken;
            return response()->json(['status' => 'login_success','message' => 'Login Successfully','token' => $token], 200);
         
        }catch(Exception $ex){
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Customer Dashboard
     */
    public function customerDashboard(Request $request){
        try{
            return view('pages.backend.customer.customerDashboardPage');
        }catch(Exception $ex){
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }



    /**
     *Pcakge list by category
     */
    public function packageListByCategory(Request $request)
    {
        try {
            $category_id = $request->category_id;
            $searchPackageByCategory = Package::where('category_id', $category_id)->get();
            return response()->json(['status' => 'success', 'packageListByCategory' => $searchPackageByCategory], 200);
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    /**
     * admin packge list details by category
     */
    public function packageListDetailsByCategory(Request $request)
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
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed!',
                'errors' => $validator->errors(),
            ], 422);
        }

              $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $customer_image_Name = Str::random(20) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->move(public_path('upload/dashboard/images/customers'), $customer_image_Name);
            }




        $package = Package::with('discounts')->find($request->package_id);

        if (!$package) {
            return response()->json([
                'status' => 'error',
                'message' => 'Package not found'
            ], 404);
        }


        // direct discount 
        $directDiscount = $package->discounts->firstWhere('discount_mode', 'direct');

        $discountPercentage = $directDiscount->discount_value ?? 0;
        $price = $package->price ?? 0;
        $discountedPrice = $price - ($price * $discountPercentage / 100);

            if ($package->seat_availability == 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Seat Not Available'
                ], 400);
            }

            if ($request->customer_slot > $package->seat_availability) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid Seat Request. Only ' . $package->seat_availability . ' seat(s) available.'
                ], 400);
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
            'customer_slot'=> $request->customer_slot,
            'image' => $imagePath,
            'created_by_ip' => $request->ip(),
        ]);

        //sending mail
        Mail::to($customer->email)->send(new WellComeCustomerMail($customer));



        return response()->json([
            'status' => 'success',
            'message' => 'Customer created successfully! A confirmation email has been sent to the customer with login instruction',
            'data' => $customer,
        ], 200);

    } catch (Exception $ex) {
        return response()->json([
            'status' => 'error',
            'message' => $ex->getMessage(),
        ], 500);
    }
}

    /**
     * Working For Customer Dahsboard  customer auth info
     */
    public function customerDetails()
    {
        try{
            $customerDetails = Customer::where('id', auth()->user()->id)->first();
            return response()->json(['status' => 'success', 'data' => $customerDetails]);
        }catch(Exception $ex){
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()]); 
        }
    }



    /**
     * Customer Package Details 
     */
    public function myPackageDetailsPage(){
        try{
            return view('pages.backend.customer.customerPackageDetailsPage');
        }catch(Exception $ex){
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()]);
        }
    }


    /*
    * Customer Package Details by customer id
    */
    public function customerPackageDetailsById(Request $request){
        $id = $request->id;
        try{
            $searchCustomer = Customer::where('id', $id)->first();
            if(!$searchCustomer){
                return response()->json(['status' => 'error', 'message' => 'Customer not found']);
            }
            $packageDetails = Customer::where('id', $id)->first();
            return response()->json(['status'=>'success', 'packages' => $packageDetails]);
        }catch(Exception $ex){
            return response()->json(['status' => 'error','message' => $ex->getMessage()]);
        }
    }
}
