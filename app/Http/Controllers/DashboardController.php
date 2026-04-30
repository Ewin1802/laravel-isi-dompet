<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalAdmin' => Admin::count(),
            'activeAdmin' => Admin::where('status', 1)->count(),
            'inactiveAdmin' => Admin::where('status', 0)->count(),

            'totalUser' => User::count(),
            'memberUser' => User::where('role', 'member')->count(),
            'userRole' => User::where('role', 'user')->count(),

            'recentAdmins' => Admin::latest()->take(5)->get(),
            'recentUsers' => User::latest()->take(5)->get(),
        ]);
    }
}
