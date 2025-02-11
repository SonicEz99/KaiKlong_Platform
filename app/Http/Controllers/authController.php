<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;

class authController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|string|email|max:255|unique:users,email',
            'user_password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->input('user_name'),
            'email' => $request->input('user_email'),
            'password' => Hash::make($request->input('user_password')),
            'role' => 'user',
        ]);

        return response()->json(['message' => 'Registration successful', 'user' => $user], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_email' => 'required', // Can be email or username
            'user_password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (Auth::attempt(['user_email' => $request->user_email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = session()->put('message', $user->name);

            return response()->json(['message' => 'Login successful', 'user' => $user, 'token' => $token], 200);
        }

        return response()->json(['error' => 'Invalid email or password'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
