<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // REGISTER ADMIN
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|confirmed|min:6',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 1
        ]);

        auth()->login($admin);

        return redirect()->route('dashboard');
    }

    // LOGIN ADMIN
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        Log::info('LOGIN ATTEMPT', [
            'email' => $request->email,
        ]);

        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            Log::info('LOGIN SUCCESS');

            return redirect()->route('dashboard');
        }

        Log::warning('LOGIN FAILED');

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }
}
