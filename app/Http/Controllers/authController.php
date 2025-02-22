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
        try {
            $validator = Validator::make($request->all(), [
                'user_name' => 'required|string|max:255',
                'user_email' => 'required|string|email|max:255|unique:users,user_email',
                'user_password' => 'required|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $user = User::create([
                'user_name' => $request->user_name,
                'user_email' => $request->user_email,
                'user_password' => Hash::make($request->user_password),
                'role' => 'user',
            ]);

            return response()->json(['message' => 'Registration successful', 'user' => $user], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_email' => 'required|email',
                'user_password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $user = User::where('user_email', $request->user_email)->first();

            if ($user && Hash::check($request->user_password, $user->user_password)) {
                $token = $user->createToken('auth_token')->plainTextToken;

                session()->put('user_name', $user->user_name);

                // ✅ Add "remember me" to persist session
                Auth::login($user, true); // true = remember user

                session()->regenerate();  // Prevent session fixation attacks

                return response()->json([
                    'message' => 'Login successful',
                    'user' => $user,
                    'token' => $token,
                    'name' => $user->user_name,
                ], 200);
            }

            return response()->json(['error' => 'Invalid email or password'], 401);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred during login. ' . $e->getMessage()], 500);
        }
    }


    public function logout(Request $request)
    {
        // Revoke Laravel Sanctum tokens
        if ($request->user()) {
            $request->user()->tokens()->delete();
        }

        // Logout the user
        Auth::logout();

        // Destroy Laravel session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Flush session data
        session()->flush();

        // Remove session cookies (forcefully forget them)
        return redirect('/')->withHeaders([
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ])
            ->withCookie(cookie(config('session.cookie'), '', -1)) // Forget session cookie
            ->withCookie(cookie('XSRF-TOKEN', '', -1)) // Forget CSRF token cookie
            ->withCookie(cookie('laravel_session', '', -1)); // Explicitly clear Laravel session cookie
    }
}
