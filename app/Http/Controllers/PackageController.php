<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Package;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        //
    }
}
