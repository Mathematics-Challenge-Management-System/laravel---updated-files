<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use App\Models\Admin;

class LoginController extends Controller
{
    protected $redirectTo = '/dashboard';
    /**
     * Display login page.
     *
     * Renderable
     */
    
    public function welcome(){
        return view ('auth.welcome');
     }
    public function show()
    {
        return view('auth.login');
    }
    public function dashboard()
{
    return view('pages.dashboard');
}

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'Email' => ['required', 'Email'],
            'Password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->withErrors([
            'Email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
