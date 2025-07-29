<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        $remember = isset($credentials['rememberMe']) && $credentials['rememberMe'];

        if (Auth::attempt(['email' => $credentials['emailOrName'], 'password' => $credentials['password']], $remember) ||
            Auth::attempt(['name' => $credentials['emailOrName'], 'password' => $credentials['password']], $remember)) {
            $request->session()->regenerate();

            return redirect()->route('home.index')->with('success', 'Connexion réussie !');
        }

        return back()->withErrors([
            'emailOrName' => 'Le nom d’utilisateur ou le mot de passe est incorrect. Veuillez réessayer.',
        ])->onlyInput('emailOrName');
    }

    public function logout(): RedirectResponse
    {
        // Clear the remember token
        if (Auth::check()) {
            $user = Auth::user();
            $user->setRememberToken(null);
            $user->save();
        }

        Auth::logout();

        return redirect()->route('home.index');
    }
}
