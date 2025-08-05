<?php

namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return Inertia::render('Auth/Login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        
        try {
            $credentials = $request->only('email', 'password');
            $remember = $request->boolean('remember');
    
            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            }
    
            return back()->withErrors([
                'error_msg' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        } catch (\Exception $e) {
            return back()->withErrors(['error_msg' => 'An error occurred while processing your request.'])->onlyInput('email');
        }
    }
}