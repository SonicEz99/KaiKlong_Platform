<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->stateless()  // Add this line
            ->redirect();
    }

    public function handleGoogle(Request $request)
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $fineuser = User::where('google_id', $user->id)->first();
            if ($fineuser) {
                session()->put('user_name', $fineuser->user_name);
                Auth::login($fineuser);
                return redirect('/home');
            } else {
                $newUser = User::updateOrCreate(['user_email' => $user->email], [
                    'user_name' => $user->name,
                    'google_id' => $user->id,
                    'user_password' => encrypt('123456dummy'),
                ]);
            }
            session()->put('user_name', $newUser->user_name);
            Auth::login($newUser);
            return redirect('home');
        } catch (Exception $err) {
            return redirect('/')->with('error', $err->getMessage());
        }

    }

}
