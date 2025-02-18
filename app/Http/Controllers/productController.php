<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Categorie;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class productController extends Controller
{
    public function addProduct(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_name' => 'required',
                'product_description' => 'required',
                'product_price' => 'required|integer',
                'product_condition' => 'required|string', // มือหนึ่ง มือสอง
                'product_location' => 'required|string', // ที่อยู่ของสินค้า
                'product_phone' => 'required|string', // เบอร์โทรศัพท์
                'image_path.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // รองรับหลายรูป
                'category_id' => 'required|integer',
                'type_id' => 'nullable|integer',
                'brand_id' => 'nullable|integer',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 500);
            }

            $user_id = 6;

            // Step 1: Create the product
            $productData = [
                'user_id' => $user_id,
                'product_name' => $request->input('product_name'),
                'product_description' => $request->input('product_description'),
                'product_price' => $request->input('product_price'),
                'product_status' => 'ยังมีสินค้าอยู่',
                'product_condition' => $request->input('product_condition'),
                'product_location' => $request->input('product_location'),
                'product_phone' => $request->input('product_phone'),
                'category_id' => $request->input('category_id'),
                'type_id' => ($request->category_id == 1 || $request->category_id == 2) ? null : $request->input('type_id'),
                'brand_id' => ($request->category_id == 1 || $request->category_id == 2) ? $request->input('brand_id') : null,
            ];

            $product = Product::create($productData); // Save & get the ID

            // // Step 2: Handle image uploads (if any)
            if ($request->hasFile('image_path')) {
                foreach ($request->file('image_path') as $image) {
                    if ($image->isValid()) { // Ensure the file is valid before processing
                        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        $destinationPath = public_path('product_pic');

                        if (!file_exists($destinationPath)) {
                            mkdir($destinationPath, 0777, true); // Create folder if not exists
                        }

                        $image->move($destinationPath, $imageName);
                        $imagePath = 'product_pic/' . $imageName;

                        ProductImage::create([
                            'product_id' => $product->product_id,
                            'image_path' => $imagePath,
                        ]);
                    }
                }
            }

            return response()->json(['message' => 'Product added successfully', 'product' => $product], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        };
    }

    public function getProduct()
    {
        $products = Product::with(['productImages', 'category', 'category.brands', 'category.types', 'user'])->get();

        return response()->json([
            'message' => 'Products retrieved successfully',
            'products' => $products
        ], 200);
    }

    public function getProductById($id)
    {
        try {
            $product = Product::with(['productImages', 'category'])->findOrFail($id);

            return response()->json($product, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Product not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function show($id)
    {
        $product = Product::with(['productImages', 'category'])->find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return view('product.product-detail', ['product' => $product]);
    }

    public function updateProduct(Request $request, $productId)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_name' => 'required',
                'product_description' => 'required',
                'product_price' => 'required|integer',
                'product_condition' => 'required|string',
                'product_location' => 'required|string',
                'product_phone' => 'required|string',
                'image_path.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'category_id' => 'required|integer',
                'type_id' => 'nullable|integer',
                'brand_id' => 'nullable|integer',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 500);
            }

            $user_id = Auth::id();
            $product = Product::findOrFail($productId);

            $product->update([
                'product_name' => $request->input('product_name'),
                'product_description' => $request->input('product_description'),
                'product_price' => $request->input('product_price'),
                'product_condition' => $request->input('product_condition'),
                'product_location' => $request->input('product_location'),
                'product_phone' => $request->input('product_phone'),
                'category_id' => $request->input('category_id'),
                'type_id' => ($request->category_id == 1 || $request->category_id == 2) ? null : $request->input('type_id'),
                'brand_id' => ($request->category_id == 1 || $request->category_id == 2) ? $request->input('brand_id') : null,
            ]);

            // Step 2: Handle image updates
            if ($request->hasFile('image_path')) {
                // Delete old images from the folder
                $oldImages = ProductImage::where('product_id', $productId)->get();
                foreach ($oldImages as $oldImage) {
                    $imagePath = public_path($oldImage->image_path);
                    if (file_exists($imagePath)) {
                        unlink($imagePath); // Remove old file
                    }
                    $oldImage->delete(); // Remove record from DB
                }

                // Upload new images
                foreach ($request->file('image_path') as $image) {
                    if ($image->isValid()) {
                        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        $destinationPath = public_path('product_pic');

                        if (!file_exists($destinationPath)) {
                            mkdir($destinationPath, 0777, true);
                        }

                        $image->move($destinationPath, $imageName);
                        $imagePath = 'product_pic/' . $imageName;

                        ProductImage::create([
                            'product_id' => $product->product_id,
                            'image_path' => $imagePath,
                        ]);
                    }
                }
            }

            return response()->json(['message' => 'Product updated successfully', 'product' => $product], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function deleteProduct($id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }

            $images = ProductImage::where('product_id', $id)->get();

            foreach ($images as $image) {
                $imagePath = public_path($image->image_path);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $image->delete();
            }

            $product->delete();

            return response()->json(['message' => 'Product deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
