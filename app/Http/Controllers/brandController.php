<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class brandController extends Controller
{
    public function addBrand1(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'brand_name' => 'required|string',
                'brand_pic_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 500);
            }

            $imagePath = null;
            if ($request->hasFile('brand_pic_path')) {
                $image_name = time() . '.' . $request->file('brand_pic_path')->getClientOriginalExtension();
                $request->file('brand_pic_path')->move(public_path('brand_pic'), $image_name);
                $imagePath = 'brand_pic/' . $image_name; // FIXED
            }

            Brand::create([ // Make sure your model name is correct
                'brand_name' => $request->input('brand_name'),
                'brand_pic_path' => $imagePath,
                'category_id' => 1,
            ]);

            return response()->json(['success' => 'Brand added successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); // Show actual error message
        }
    }

    public function addBrand2(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'brand_name' => 'required|string',
                'brand_pic_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 500);
            }

            $imagePath = null;
            if ($request->hasFile('brand_pic_path')) {
                $image_name = time() . '.' . $request->file('brand_pic_path')->getClientOriginalExtension();
                $request->file('brand_pic_path')->move(public_path('brand_pic'), $image_name);
                $imagePath = 'brand_pic/' . $image_name; // FIXED
            }

            Brand::create([ // Make sure your model name is correct
                'brand_name' => $request->input('brand_name'),
                'brand_pic_path' => $imagePath,
                'category_id' => 2,
            ]);

            return response()->json(['success' => 'Brand added successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); // Show actual error message
        }
    }

    public function getBrand()
    {
        try {
            $categories = Brand::all(); // Fetch all categories

            return response()->json(['categories' => $categories], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getBrandById($id)
    {
        try {
            $category = Brand::find($id); // Fetch category by ID

            if (!$category) {
                return response()->json(['error' => 'Category not found'], 404);
            }

            return response()->json(['category' => $category], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
