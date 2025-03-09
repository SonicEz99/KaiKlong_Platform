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
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('google_id', $googleUser->id)->first();

        if ($user) {
            Auth::login($user, true); // 'true' enables remember-me functionality
        } else {
            $user = User::updateOrCreate(
                ['user_email' => $googleUser->email],
                [
                    'user_name' => $googleUser->name,
                    'google_id' => $googleUser->id,
                    'user_password' => bcrypt('123456dummy'),
                ]
            );

            session()->put('user_name', $user->user_name);
            Auth::login($user, true);

            session()->regenerate();  // Force session regeneration

        }

        session()->put('user_name', $user->user_name);
        session()->regenerate(); // Prevent session fixation attacks

        return redirect('/home');
    } catch (Exception $err) {
        return redirect('/')->with('error', $err->getMessage());
    }
}


}
