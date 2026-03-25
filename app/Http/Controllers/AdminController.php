<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        $admins = Admin::all();
        return view('admin.index',compact('admins'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {

        Admin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'status'=>$request->status
        ]);

        return redirect('/admin');
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        return view('admin.edit',compact('admin'));
    }

    public function update(Request $request,$id)
    {

        $admin = Admin::find($id);

        $admin->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'status'=>$request->status
        ]);

        return redirect('/admin');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);

        $admin->delete();

        return redirect()->back()->with('success','Admin berhasil dihapus');
    }

}
