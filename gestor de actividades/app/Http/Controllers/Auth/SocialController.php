<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Google_Service_Calendar;

class SocialController extends Controller
{
    public function redirectOnGoogle()
    {
        return Socialite::driver('google')
            ->scopes('https://www.googleapis.com/auth/calendar')
            ->with(['access_type' => 'offline'])
            ->redirect();
    }

    public function OpenGoogleAccountDetails()
    {
        $user = auth()->user();
        $googleUser = Socialite::driver('google')->user();



        if ($user) {

            $user->update([
                'google_id' => $googleUser->id,
                'google_access_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken ?? null,
            ]);

        }

        session()->flash('alert-success', 'Account linked successfully!');
        return to_route('dashboard');
    }
}

