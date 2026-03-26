<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'member_id' => 'required|string',
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'email' => 'nullable|email|unique:users',
            'password' => 'required|min:6',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $photoPath = null;

        if ($request->hasFile('photo')) {

            $photoPath = $request->file('photo')->store('members', 'public');
        }

        $user = User::create([
            'member_id' => $request->member_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'photo' => $photoPath,
            'role' => 'member',
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Registrasi berhasil',
            'data' => $user
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('phone', $request->phone)
            ->orWhere('name', $request->phone)
            ->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Password salah'
            ], 401);
        }

        return response()->json([
            'status' => true,
            'message' => 'Login berhasil',
            'data' => $user
        ]);
    }
}
