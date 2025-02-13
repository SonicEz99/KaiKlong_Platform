<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use function Laravel\Prompts\error;


class categoryController extends Controller
{
    public function addCategory(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'category_name' => 'required|string',
                'category_pic_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 500);
            }

            $imagePath = null;
            if ($request->hasFile('category_pic_path')) {
                $image_name = time() . '.' . $request->file('category_pic_path')->getClientOriginalExtension();
                $request->file('category_pic_path')->move(public_path('category_pic'), $image_name);
                $imagePath = 'category_pic/' . $image_name; // FIXED
            }

            Categorie::create([ // Make sure your model name is correct
                'category_name' => $request->input('category_name'),
                'category_pic_path' => $imagePath,
            ]);

            return response()->json(['success' => 'Category added successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); // Show actual error message
        }
    }

    public function getCategory()
    {
        try {
            $categories = Categorie::all(); // Fetch all categories

            return response()->json(['categories' => $categories], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getCategoryById($id)
    {
        try {
            $category = Categorie::find($id); // Fetch category by ID

            if (!$category) {
                return response()->json(['error' => 'Category not found'], 404);
            }

            return response()->json(['category' => $category], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getCategoryAndBrandAndType()
    {
        try {
            $categories = Categorie::with(['brands', 'types'])->get(); // Fetch all categories with brands & types

            return response()->json(['categories' => $categories], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function getCategoryAndBrandAndTypeById($id)
    {
        try {
            $category = Categorie::with(['brands', 'types'])->find($id); // Fetch category by ID

            if (!$category) {
                return response()->json(['error' => 'Category not found'], 404);
            }

            return response()->json(['category' => $category], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
