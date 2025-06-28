<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    // Show the login form or redirect if already logged in
    public function login(Request $request)
    {
        if (Auth::check()) {
            // User already logged in, redirect to home/dashboard
            return redirect()->intended('');
        }

        // Show the login view (resources/views/components/login_page.blade.php)
        return view('components.login_page');
    }

    // Process login form submission
    public function authenticate(Request $request): RedirectResponse
    {
        // Validate incoming request data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to authenticate with credentials
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Prevent session fixation attacks

            // Redirect to intended URL or home
            return redirect()->intended('index');
        }

        // Authentication failed, redirect back with error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    // Handle logout   
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout(); // Log out the user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }


    // Show the registration form
    public function showRegister()
    {
        if (Auth::check()) {
            // User already logged in, redirect to home/dashboard
            return redirect()->intended('');
        }

        // Show the registration view (resources/views/components/register_page.blade.php)
        return view('components.register_page');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect()->route('home')->with('success', 'Account created successfully!');
    }
}
