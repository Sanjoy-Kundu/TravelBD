<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PackageCategory;

class PackageCategoryController extends Controller
{
    /**
     * category create page
     */
    public function createPackageCategoryPage()
    {
        try {
            return view('pages.backend.packageManagement.packageCategoryPage');
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * category store method
     */
    public function packageCategoryStore(Request $request)
    {
        // Step 1: Validation
        $request->validate([
            'name' => 'required|string|max:255|unique:package_categories,name',
            'slug' => 'nullable|string|unique:package_categories,slug',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        try {
            // Step 2: Image Upload
            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = uniqid('category_', true) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/dashboard/images/package-category'), $imageName);
            }

            // Step 3: Generate Slug from Name if not provided
            $baseSlug = Str::slug($request->slug ?? $request->name); // use slug if given, otherwise name
            $slug = $baseSlug;
            $counter = 1;

            // Check uniqueness including soft-deleted
            while (PackageCategory::withTrashed()->where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }

            // Step 4: Store
            PackageCategory::create([
                'name' => Str::upper($request->name),
                'slug' => Str::lower($slug),
                'description' => $request->description,
                'status' => $request->status,
                'image' => $imageName,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Package category created successfully!',
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
     * package category list 
     */
    public function packageCategoryLists()
    {
        try{
            $PackageCategories = PackageCategory::orderBy('id', 'DESC')->get();
            return response()->json(['status' => 'success', 'PackageCategories' => $PackageCategories]);
        }catch(Exception $e){
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
     * Show the form for editing the specified resource.
     */
    public function edit(PackageCategory $packageCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PackageCategory $packageCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackageCategory $packageCategory)
    {
        //
    }
}
