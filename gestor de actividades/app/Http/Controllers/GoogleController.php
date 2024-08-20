<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Verificar si el usuario ya existe
        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            // Si el usuario ya existe, iniciar sesión
            Auth::login($user);
            return redirect()->intended('dashboard');
        } else {
            // Si el usuario no existe, redirigir a una vista para establecer la contraseña
            return view('auth.set-password', [
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'google_access_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
            ]);
        }
    }

    public function storePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'google_id' => $request->google_id,
            'google_access_token' => $request->google_access_token,
            'google_refresh_token' => $request->google_refresh_token,
        ]);

        Auth::login($user);

        return redirect()->intended('dashboard');
    }
}
