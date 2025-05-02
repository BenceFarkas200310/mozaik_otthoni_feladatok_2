<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create($validated);

        Auth::login($user);

        return redirect('/');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'emailInput' => 'required|email',
            'passwordInput' => 'required'
        ]);

        $credentials = [
            'email' => $credentials['emailInput'],
            'password' => $credentials['passwordInput']
        ];
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }
    
        throw ValidationException::withMessages([
            'credentials' => 'Wrong username or password.'
        ]);
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
