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
    public function index()
    {
        //
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PackageDiscount $packageDiscount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PackageDiscount $packageDiscount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PackageDiscount $packageDiscount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackageDiscount $packageDiscount)
    {
        //
    }
}
