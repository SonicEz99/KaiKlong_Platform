<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    public function updateUser(Request $request, $userId)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string',
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'c' => 'nullable|string|max:10',
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

        return response()->json(['success' => 'User updated successfully!', "user" => $user], 200);
    }

    public function getUser($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            return response()->json(['user' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'oldPassword' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = User::findOrFail($request->user_id);

        if (!Hash::check($request->oldPassword, $user->user_password)) {
            return response()->json(['error' => 'รหัสผ่านเดิมไม่ถูกต้อง'], 400);
        }

        $user->update([
            'user_password' => Hash::make($request->password),
        ]);

        return response()->json(['success' => 'เปลี่ยนรหัสผ่านสำเร็จ!'], 200);
    }


    public function updateProfile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::findOrFail($id);

        if ($request->hasFile('user_pic')) {
            // Delete old image
            if ($user->user_pic) {
                $oldImagePath = public_path($user->user_pic);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload new image
            $image = $request->file('user_pic');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('user_pics');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $image->move($destinationPath, $imageName);
            $imagePath = 'user_pics/' . $imageName;

            // Update user record
            $user->user_pic = $imagePath;
            $user->save();
        }

        return response()->json(['user' => $user], 200);
    }
}
