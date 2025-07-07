<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Package;
use App\Models\Customer;
use App\Models\PackageDiscount;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $coupon = PackageDiscount::where('package_id', $packageId)
            ->where('coupon_code', $couponCode)
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->first();

        if (!$coupon) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired coupon for this package',
            ], 400);
        }

        // Step 2: Get the package and calculate discount
        $package = Package::find($packageId);

        if (!$package) {
            return response()->json([
                'status' => 'error',
                'message' => 'Package not found',
            ], 404);
        }

        $originalPrice = $package->price;
        $discountValue = $coupon->discount_value;
        $discountAmount = ($originalPrice - ($originalPrice * $discountValue) / 100);

        return response()->json([
            'status' => 'success',
            'discounted_price' => round($discountAmount),
            'originalPrice' => $originalPrice,
            'discount_value' => $discountValue,
            'coupon_code' => $couponCode,
            'message' => 'Coupon applied successfully',
        ]);
    } catch (\Exception $ex) {
        return response()->json([
            'status' => 'error',
            'message' => $ex->getMessage(),
        ], 500);
    }
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
