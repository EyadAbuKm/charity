<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle the login process
    public function login(Request $request)
    {
        $request->validate([
            'user' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        $credentials = $request->only('user', 'password');

        // Check user credentials
        $user = User::where('user', $credentials['user'])->first();

        // if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return redirect()->route('home')->with('success', 'Logged in successfully');
        // }

        // return redirect()->back()->with('error', 'خطأ في الاسم أو كلمة المرور');
    }

    // Handle the logout process
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }

}
