<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $phone = preg_replace('/^0/', '62', $request->phone);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $phone,
            'password' => Hash::make($request->password),
        ]);

        auth()->login($user);

        return redirect()->route('dashboard');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $loginInput = $request->login;

        // cek apakah email atau nomor HP
        $field = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        // optional: format nomor Indo (08 → 628)
        if ($field === 'phone') {
            $loginInput = preg_replace('/^0/', '62', $loginInput);
        }

        if (auth()->attempt([
            $field => $loginInput,
            'password' => $request->password
        ])) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'login' => 'Email / Nomor HP atau password salah',
        ]);
    }
}
