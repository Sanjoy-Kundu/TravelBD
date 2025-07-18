<?php

namespace App\Http\Controllers;

use Log;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PackageCategory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

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
    public function CategoryStore(Request $request)
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
    public function CategoryLists()
    {
        try {
            $PackageCategories = PackageCategory::orderBy('id', 'DESC')->get();
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
     * packae category details by id
     */
    public function CategoryDetails(Request $request)
    {
        try {
            $id = $request->id;
            $PackageCategory = PackageCategory::where('id', $id)->first();
            if (!$PackageCategory) {
                return response()->json(['status' => 'error', 'message' => 'Package Category not found!']);
            }
            return response()->json(['status' => 'success', 'PackageCategory' => $PackageCategory]);
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
     * package category update
     */
  public function CategoryUpdate(Request $request)
{
    $validator = Validator::make($request->all(), [
        'id' => 'required|exists:package_categories,id',
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'status' => 'required|in:active,inactive',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors(),
        ], 422);
    }

    try {
        $category = PackageCategory::findOrFail($request->id);

        // নাম আপডেট
        $category->name = Str::upper($request->name);

        // slug যদি আগেই না থাকে, তখন নাম থেকে slug তৈরি করবে
        if (!$category->slug) {
            $baseSlug = Str::slug($request->name);
            $slug = $baseSlug;
            $counter = 1;

            // slug ইউনিক কিনা চেক করবে
            while (PackageCategory::withTrashed()
                ->where('slug', $slug)
                ->where('id', '!=', $category->id)
                ->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }

            $category->slug = Str::lower($slug);
        }

        // বাকি ফিল্ড আপডেট
        $category->description = $request->description;
        $category->status = $request->status;

        // ইমেজ আপলোড ও পুরানো ইমেজ ডিলিট
        if ($request->hasFile('image')) {
            if ($category->image) {
                $oldImagePath = public_path('upload/dashboard/images/package-category/' . $category->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/dashboard/images/package-category'), $imageName);

            $category->image = $imageName;
        }

        $category->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Package category updated successfully!',
            'PackageCategory' => $category,
        ]);
    } catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to update package category. Error: ' . $e->getMessage(),
        ], 500);
    }
}

    /**
     * category package delete
     */
    public function CategoryTrash(Request $request)
    {
        try {
            // Log::info('ID received: ' . $request->id);
            $id = $request->id;
            $category = PackageCategory::find($id);

            if (!$category) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Category not found.',
                    ],
                    404,
                );
            }

            // Soft delete
            $category->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Category  Trash successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // public function categoryDelete(Request $request){
    //     try{
    //         return $id = $request->id;
    //     }catch(Exception $e){
    //         return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    //     }
    // }
    /**
     * Category Trash data show
     */
    public function CategoryTrashLists()
    {
        try {
            $trashedCategories = PackageCategory::onlyTrashed()->get();

            return response()->json([
                'status' => 'success',
                'trashedCategories' => $trashedCategories,
            ]);
        } catch (Exception $ex) {
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
     * trash category restore
     */
    public function CategoryRestore(Request $request)
    {
        $id = $request->id;

        try {
            // find category
            $category = PackageCategory::onlyTrashed()->findOrFail($id);

            $category->restore();

            return response()->json([
                'status' => 'success',
                'message' => 'Category restored successfully.',
            ]);
        } catch (Exception $ex) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Failed to restore category: ' . $ex->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Pacakge Category Permanet delte
     */
    public function CategoryPermanentDelete(Request $request)
    {
        try {
            $id = $request->id;

            $category = PackageCategory::onlyTrashed()->where('id', $id)->first();

            if (!$category) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Category not found in trash',
                    ],
                    404,
                );
            }

            // image file delte
            if ($category->image) {
                $imagePath = public_path('upload/dashboard/images/package-category/' . $category->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath); // img file delte
                }
            }

            // db delete
            $category->forceDelete();

            return response()->json([
                'status' => 'success',
                'message' => 'Category permanently deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ],
                500,
            );
        }
    }
}
