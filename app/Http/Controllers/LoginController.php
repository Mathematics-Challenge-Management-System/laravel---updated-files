<?php

namespace App\Http\Controllers;

use App\Models\Analytics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


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
    $analytics = new Analytics();
    $schools =$analytics->getSchoolsCount();
    $challengess =$analytics->getChallengesCount();
    $participants =$analytics->getParticipantsCount();
    $challenge_attempts=$analytics->getChallengeAttempts();
    $challenges=$analytics->getChallengeAttemptsByChallenge();
    $rankings=$analytics->getSchoolsRankingPerChallengeUsingSchoolRegNo();


    return view('pages.dashboard', compact('challengess','schools', 'participants','challenge_attempts','challenges'));}

public function login(Request $request)
{
    $credentials = $request->validate([
        'Email' => ['required', 'email'],
        'Password' => ['required'],
    ]);

    $admin = Admin::where('Email', $credentials['Email'])->first();

    if ($admin) {
        $inputPassword = $credentials['Password'];
        $storedHash = $admin->Password;

        Log::debug('Password check details', [
            'input_password' => $inputPassword,
            'input_password_length' => strlen($inputPassword),
            'stored_hash' => $storedHash,
            'hash_check_result' => Hash::check($inputPassword, $storedHash) ? 'true' : 'false',
            'php_password_verify_result' => password_verify($inputPassword, $storedHash) ? 'true' : 'false'
        ]);

        if (Hash::check($inputPassword, $storedHash)) {
            Auth::guard('admin')->login($admin);
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }
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
