<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Storage;

class RegisterController
{
    public function index(): View
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (isset($credentials['image'])) {
            // create a unique filename for the image with uuid
            $imageName = uniqid('pp_', true) . '.' . $credentials['image']->getClientOriginalExtension();

            // store the image in the public/images directory
            Storage::disk('public')->putFileAs('pp', $credentials['image'], $imageName);

            // remove the image key from the credentials array
            unset($credentials['image']);
        }

        User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'image' => isset($imageName) ? '/pp/' . $imageName : null,
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('home.index');
        }

        return back()->withErrors([
            'email' => 'Registration failed. Please try again.',
        ])->onlyInput('email');
    }
}
