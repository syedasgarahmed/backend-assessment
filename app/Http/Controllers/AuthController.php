<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    //user registration
    public function showRegister()
    {
        return view('auth.user-registration');
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // Log the user in automatically
        Auth::guard('user')->login($user);
        
        return response()->json(['message' => 'Registration successful'], 201);
    }
    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }

    public function showUserLoginForm()
    {
        if (Auth::guard('user')->check()) { // Checking if the user is logged in
            return redirect()->route('user.dashboard');
        }

        return view('auth.user-login');
    }


    public function adminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();

            // Generate a token for this user
            $token = $user->createToken('AdminToken')->accessToken;

            // Store the token in session or localStorage via the response
            return response()->json(['access_token' => $token]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }


    public function userLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('user')->attempt($credentials)) {
            $user = Auth::guard('user')->user();
            // if (Auth::attempt($credentials)) {
            //     $user = Auth::user();
            // Generate a token for this user
            $token = $user->createToken('UserToken')->accessToken;
            // Store the token in session or localStorage via the response
            return response()->json(['access_token' => $token]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout(); // Logout for admin
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('api/admin/login'); // Redirect to admin login
    }
    public function userLogout(Request $request)
    {
        Auth::guard('user')->logout(); // Logout for user
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('api/user/login'); // Redirect to user login
    }
}
