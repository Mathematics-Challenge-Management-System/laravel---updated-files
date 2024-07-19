<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

// use App\Http\Requests\RegisterRequest;


class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        $attributes = request()->validate([
           
            'Fname' => 'required|max:255|min:2',
            'Lname' => 'required|max:255|min:2',
            'Email' => 'required|email|max:255|unique:admin,email',
            'Password' => 'required|min:5|max:255',
            
        ]);
        $admin = Admin::create($attributes);
        Auth::login($admin);

        return redirect('/home');
    }
}
