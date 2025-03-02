<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class favoriteController extends Controller
{
    public function addFavorite(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|integer',
                'product_id' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 500);
            }

            $favoriteData = [
                'user_id' => $request->input('user_id'),
                'product_id' => $request->input('product_id'),
            ];

            $favorite = Favorite::create($favoriteData);
            
            return response()->json(['success' => 'Favorite added successfully!', $favorite ]);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getFavorite()
    {
        try {
            $favorites = Favorite::with(['user', 'product'])->get();

            return response()->json(['favorites' => $favorites], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteFavorite($id){
        try {
            $favorite = Favorite::find($id);
            $favorite->delete();

            return response()->json(['success' => 'Favorite deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
