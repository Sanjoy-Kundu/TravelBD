<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Package;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PackageCategory;

class PackageController extends Controller
{
    /**
     *package list page
     */
    public function packageListsPage()
    {
        try {
            return view('pages.backend.packageManagement.packagePage');
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }


    /**
     * Active Category Lists
     */
 public function packageActiveLists()
    {
        try {
            $PackageCategories = PackageCategory::where('status','active')->orderBy('id', 'DESC')->get();
            return response()->json(['status' => 'success', 'PackageCategories' => $PackageCategories]);
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
     * Package lists
     */
public function packageLists(Request $request)
{
    try {
        $packages = Package::with('packageCategory')->get();

        return response()->json(['status' => 'success','packages' => $packages]);
    } catch (Exception $ex) {
        return response()->json(['error' => $ex->getMessage()]);
    }
}

    /**
     * Package Store
     */

    /**
     * Packae Store data
     */
    public function packageStore(Request $request)
    {
        try {
            // Validation
            $request->validate([
                'title' => 'required|string|max:255',
                'category_id' => 'required|exists:package_categories,id',
                'price' => 'nullable|numeric',
                'currency' => 'nullable|string|max:10',
                'duration' => 'nullable|string|max:100',
                'short_description' => 'nullable|string|max:255',
                'long_description' => 'nullable|string',
                'inclusions' => 'nullable|string',
                'exclusions' => 'nullable|string',
                'visa_processing_time' => 'nullable|string|max:100',
                'documents_required' => 'nullable|string',
                'seat_availability' => 'nullable|integer|min:0',
                'status' => 'required|in:active,inactive',
                'image' => 'nullable|image|max:2048',

                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            // Create new Package instance
            $package = new Package();

            $package->title =Str::upper($request->title);
            $package->slug = Str::slug($request->title);
            $package->category_id = $request->category_id;
            $package->price = $request->price;
            $package->currency = Str::upper($request->currency);
            $package->duration = Str::upper($request->duration);
            $package->short_description = Str::upper($request->short_description);
            $package->long_description = Str::upper($request->long_description);
            $package->inclusions = Str::upper($request->inclusions);
            $package->exclusions = Str::upper($request->exclusions);
            $package->visa_processing_time = Str::upper($request->visa_processing_time);
            $package->documents_required = Str::upper($request->documents_required);
            $package->seat_availability = $request->seat_availability;
            $package->status = Str::upper($request->status);


            $package->start_date = $request->start_date;
            $package->end_date = $request->end_date;

            // Handle image upload if exists
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/dashboard/images/packages/'), $imageName);
                $package->image = 'upload/dashboard/images/packages/' . $imageName;
            }

            // Save the package
            $package->save();

            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Package created successfully',
                    'package' => $package,
                ],
                201,
            );
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
   * Package View
   *  
   * */  
  public function packageDetails(Request $request){
    $package = Package::with('packageCategory','discounts')->find($request->id);
    if(!$package){
        return response()->json(["status" => "error", "message" => "Package not found"], 404);
    }
    return response()->json([
        "status" => "success",
        "package" => $package
    ]);
  }




  /**
   * Package Trash
   */
  public function packageTrash(Request $request){
    $package = Package::find($request->id);
    if(!$package){
        return response()->json(["status" => "error", "message" => "Package not found"], 404);
    }
    $package->delete();
    return response()->json([
        "status" => "success",
        "message" => "Package Trash successfully"
    ]);
  }


  /**
   * Package Trash list
   */
  public function packageTrashLists(){
    $package = Package::with('packageCategory')->onlyTrashed()->get();
    return response()->json([
        "status" => "success",
        "packages" => $package
    ]);
  }


  /**
   * Package Permanet delte
   */
public function packagePermanentDelete(Request $request)
{
    $package = Package::with('packageCategory')->onlyTrashed()->find($request->id);

    if (!$package) {
        return response()->json([
            "status" => "error",
            "message" => "Package not found"
        ], 404);
    }

    // image folder delte
    if ($package->image && file_exists(public_path($package->image))) {
        unlink(public_path($package->image));
    }

    // permanenet delte
    $package->forceDelete();

    return response()->json([
        "status" => "success",
        "message" => "Package permanently deleted successfully"
    ]);
}



//package restore
public function packageRestore(Request $request){
    $package = Package::onlyTrashed()->find($request->id);

    if (!$package) {
        return response()->json(["status" => "error", "message" => "Package not found"], 404);
    }

    $package->restore();

    return response()->json([
        "status" => "success",
        "message" => "Package restored successfully"
    ]);
}




/**
 * Package Update
 */
public function packageUpdate(Request $request)
{
    try {
        // Validate request data
        $request->validate([
            'id' => 'required|exists:packages,id',
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:package_categories,id',
            'short_description' => 'nullable|string|max:500',
            'long_description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'currency' => 'nullable|string|max:10',
            'duration' => 'nullable|string|max:100',
            'inclusions' => 'nullable|string',
            'exclusions' => 'nullable|string',
            'visa_processing_time' => 'nullable|string|max:100',
            'documents_required' => 'nullable|string',
            'seat_availability' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|max:2048',
        ]);

        // Find package by ID
        $package = Package::find($request->id);
        if (!$package) {
            return response()->json(['status' => 'error', 'message' => 'Package not found']);
        }

        // Update package data
        $package->title = Str::upper($request->title);
        $package->category_id = $request->category_id;
        $package->short_description = Str::upper($request->short_description);
        $package->long_description = Str::upper($request->long_description);
        $package->price = $request->price;
        $package->currency = Str::upper($request->currency);
        $package->duration = $request->duration;
        $package->inclusions = Str::upper($request->inclusions);
        $package->exclusions = Str::upper($request->exclusions);
        $package->visa_processing_time = $request->visa_processing_time;
        $package->documents_required = Str::upper($request->documents_required);
        $package->seat_availability = $request->seat_availability;
        $package->status = Str::upper($request->status);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($package->image && file_exists(public_path($package->image))) {
                unlink(public_path($package->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/dashboard/images/packages'), $imageName);

            // Save new image path
            $package->image = 'upload/dashboard/images/packages/' . $imageName;
        }

        $package->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Package updated successfully',
            'package' => $package,
        ]);
    } catch (Exception $ex) {
        return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
    }
}

}
