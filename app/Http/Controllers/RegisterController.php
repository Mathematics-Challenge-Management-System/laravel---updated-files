<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'Fname' => 'required|max:255|min:2',
            'Lname' => 'required|max:255|min:2',
            'Email' => 'required|email|max:255|unique:admin,Email',
            'Password' => 'required|min:5|max:255',
        ]);

        $admin = new Admin();
        $admin->Fname = $request->input('Fname');
        $admin->Lname = $request->input('Lname');
        $admin->Email = $request->input('Email');
        $admin->Password = Hash::make(trim($request->input('Password')), [
            'memory' => 1024,
            'time' => 2,
            'threads' => 2,
        ]);
        $admin->save();
        Auth::guard('admin')->login($admin);

        return redirect('/home');
    }
}