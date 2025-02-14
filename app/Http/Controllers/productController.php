<?php

namespace App\Http\Controllers;

use App\Models\Product;
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

            $user_id = Auth::id(); 

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

            $product = Product::create($productData);// Save & get the ID

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
                            'product_id' => $product->id,
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
        $products = Product::with('productImages')->get();

        return response()->json([
            'message' => 'Products retrieved successfully',
            'products' => $products
        ], 200);
    }
}
