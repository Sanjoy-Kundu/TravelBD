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
            $packageDetails = Package::where('id', $id)->get();
            return response()->json(['status' => 'success','packageDetails' => $packageDetails], 200);
        }catch(Exception $ex){
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
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
