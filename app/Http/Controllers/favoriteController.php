<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

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

            $userId = $request->input('user_id');
            $productId = $request->input('product_id');

            $isInFav = Favorite::where('user_id', $userId)
                                ->where('product_id', $productId)
                                ->first();

            if ($isInFav) {
                $isInFav->delete();
                return response()->json(['success' => 'Favorite removed successfully!'],200);
            } else {
                $favoriteData = [
                    'user_id' => $userId,
                    'product_id' => $productId,
                ];

                $favorite = Favorite::create($favoriteData);
                return response()->json(['success' => 'Favorite added successfully!', 'favorite' => $favorite],201);
            }

        } catch (\InvalidArgumentException $e) {
            Log::error('InvalidArgumentException: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
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
