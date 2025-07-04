<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PackageDiscount;
use Illuminate\Support\Facades\Validator;

class PackageDiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function couponDiscountListsPage()
    {
        try{
            return view('pages.backend.couponManagement.couponDiscountPage');
        }catch(Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Discoutn Create
     */
    public function packageCouponDiscount(Request $request)
    {
        // Step 1: Validation
        $validator = Validator::make($request->all(), [
            'package_id' => 'required|exists:packages,id',
            'discount_mode' => 'required|in:coupon,direct',
            'coupon_code' => 'nullable|required_if:discount_mode,coupon|unique:package_discounts,coupon_code',
            'discount_value' => 'required|integer|min:1|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        // Step 2: Save Discount
        try {
            $discount = new PackageDiscount();
            $discount->package_id = $request->package_id;
            $discount->discount_mode = $request->discount_mode;
            $discount->coupon_code = $request->discount_mode === 'coupon' ? Str::upper($request->coupon_code) : null;
            $discount->discount_value = $request->discount_value;
            $discount->start_date = $request->start_date;
            $discount->end_date = $request->end_date;
            $discount->status = $request->status;
            $discount->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Discount or Coupon added successfully!',
                'data' => $discount,
            ]);
        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Something went wrong!',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Package discount  coupon lists
     */
    public function packageCouponList(Request $request)
    {
             try {
            $PackageCouponLists = PackageDiscount::with('package')->orderBy('id', 'DESC')->where('package_id', $request->package_id)->get();
            return response()->json(['status' => 'success', 'PackageCouponLits' => $PackageCouponLists]);
        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Something went wrong!',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Display the specified resource.
     */
// public function detailsCouponDiscountshow($id)
// {
//     $coupon = PackageDiscount::find($id);
//     if (!$coupon) {
//         return response()->json(['message' => 'Not found'], 404);
//     }
//     return response()->json(['coupon' => $coupon]);
// }


// public function couponDiscountUpdate(Request $request)
// {
//     $coupon = PackageDiscount::find($request->id);
//     if (!$coupon) {
//         return response()->json(['message' => 'Not found'], 404);
//     }

//     $request->validate([
//         'discount_mode' => 'required|in:coupon,direct',
//         'coupon_code' => 'required_if:discount_mode,coupon',
//         'discount_value' => 'required|numeric|min:1|max:100',
//         'start_date' => 'required|date',
//         'end_date' => 'required|date|after_or_equal:start_date',
//         'status' => 'required|in:active,inactive'
//     ]);

//     $coupon->update([
//         'discount_mode' => $request->discount_mode,
//         'coupon_code' => $request->coupon_code,
//         'discount_value' => $request->discount_value,
//         'start_date' => $request->start_date,
//         'end_date' => $request->end_date,
//         'status' => $request->status
//     ]);

//     return response()->json(['status' => 'success', 'message' => 'Coupon updated successfully']);
// }


//package coupon delete
public function packageCouponDelete(Request $request)
{
    try {
        $id = $request->id;

        $coupon = PackageDiscount::find($id);

        if (!$coupon) {
            return response()->json([
                'status' => 'error',
                'message' => 'Coupon not found',
            ], 404);
        }

        $coupon->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Coupon deleted successfully',
        ]);

    } catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong while deleting the coupon.',
            'error' => $e->getMessage(), // Debug purpose (can remove in production)
        ], 500);
    }
}
}
