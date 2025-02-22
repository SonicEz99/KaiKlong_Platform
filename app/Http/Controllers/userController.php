<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    public function updateUser(Request $request, $userId){
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string',
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'tel' => 'nullable|string|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 500);
        }

        $user_id = Auth::id();
        $user = User::findOrFail($userId);

        $user->update([
            'user_name' => $request->input('user_name'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'tel' => $request->input('tel'),
        ]);
        
        return response()->json(['success' => 'User updated successfully!', "user" =>$user]);
    }
}
