<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Customer;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function customerPackageDetailsView(Request $request){
        try{
        $packageData = Customer::with(['packageCategory', 'package'])->findOrFail($request->id);
        if(!$packageData){
            return response()->json(['message' => 'Package not found'], 404);
        }
        return response()->json(['status' => 'success', 'packageData' => $packageData]);
        }catch(Exception $ex){
            return response()->json(['status' => 'error', 'message'=> $ex->getMessage()]);
        }
    }
}
