<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Package;
use App\Models\Customer;
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
        try{
            $category_id = $request->category_id;
            $searchPackageByCategory = Package::where('category_id', $category_id)->get();
            return response()->json(['status' => 'success','packageListByCategory' => $searchPackageByCategory], 200);
        }catch(Exception $ex){
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    /**
     * admin packge list details by category
     */
    public function packageListDetailsByCategory(Request $request)
    {
         try{
            $id = $request->id;
            $packageDetails = Package::with('discounts')->where('id', $id)->first();
            return response()->json(['status' => 'success','packageDetails' => $packageDetails], 200);
        }catch(Exception $ex){
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    /**
     * Customer page package pirce update
     */
    public function packagePriceUpdateCustomer(Request $request)
    {
        try{
            $id = $request->id;
            $price = $request->price;
            $findPackage = Package::where('id', $id)->first();
            if(!$findPackage){
                return response()->json(['status' => 'error', 'message'=> 'Package not found'], 500);
            }
            if($findPackage->price == $price){
                return response()->json(['status' => 'error', 'message'=> 'Please Update price'], 500);
            }
            $findPackage->price = $price;
            $findPackage->save();
            return response()->json(['status' => 'success','message' => 'Package price updated successfully'], 200);
             

        }catch(Exception $ex){
            return response()->json(['status' => 'error', 'message'=> $ex->getMessage()], 500);
        }
    }

    /**
     *apply coupon
     */
    public function packageApplyCoupon(Request $request)
    {
        try{
            
        }catch(Exception $ex){
            return response()->json(['status' => 'error', 'message'=> $ex->getMessage()], 500);
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
