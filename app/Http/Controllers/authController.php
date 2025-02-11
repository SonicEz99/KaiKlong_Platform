<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class authController extends Controller
{
    public function Register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'user',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => 'user',
        ]);

        return redirect()->route('login.page')->with('success', 'Registration successful');
    }

    public function Login(Request $request){
        $validator = Validator::make($request->all(), [
            'login' => 'required', // Can be email or username
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    
        // Determine if login input is email or username
        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
    
        // Attempt authentication
        if (Auth::attempt([$field => $request->login, 'password' => $request->password])) {
            $user = Auth::user();

            session()->put('message',$user->name);

            if($user->role === 'admin') {
                return redirect()->route('dashboard');
            }else{
                return redirect()->route('user.home');
            }
        }

        return redirect()->back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
    }
}
