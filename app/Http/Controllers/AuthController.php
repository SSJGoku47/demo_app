<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{   
    public function register(Request $request)
    {   
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email', 
                'password' => 'required|min:8',
                'confirm_password' => 'required|same:password',
            ]);
            
            // Create a new user
            $registerUser = new User();
            $registerUser->name = $request->name;
            $registerUser->email = $request->email;
            $registerUser->password = bcrypt($request->password);
            $registerUser->save();

            session()->flash('success', 'User registered successfully');

            return redirect()->route('login');

        } catch (\Throwable $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('register')->withInput();
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $credentials = $request->only('email', 'password');
        try {
            // Attempt to authenticate the user
            if (Auth::guard('web')->attempt($credentials)) {
                // Create an access token for the authenticated user
                $token = auth()->user()->createToken('authToken')->accessToken; 
                session()->flash('success', 'Login successful!');
                $response = [
                    'success' => true,
                    'token' => $token
                ];
                
                return redirect()->route('post.index');
            } else {
                session()->flash('error', 'Invalid credentials. Please try again.');
                return redirect()->route('login')->withInput();
            }
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            \Log::error('Login error: ' . $e->getMessage());
            return redirect()->route('login')->withInput();
        }
    }
    public function resetPassword(Request $request)
    {   
        try {
            // Validate the incoming request
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:8|',
                'confirm_password' => 'required|same:password',
            ]);
            // Find the user by email
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $user->password = Hash::make($request->password);
                $user->save();
                session()->flash('success', 'Passwerd Updated successfully!');
                return redirect()->route('login');
            }
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('password.reset')->withInput();
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        Auth::guard('web')->logout();
        session()->flash('success', 'You have been logged out successfully.');
        return redirect()->route('login');
    }

    public function mobileLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('MobileAppToken')->accessToken;

            return response()->json(['status' => 'success', 'message' => 'Login successful','token' => $token], 200);
        } else {
            return response()->json(['success' => false,'message' => 'Invalid credentials',], 401);
        }
    }

    public function mobileRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false,'errors' => $validator->errors(),], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('MobileAppToken')->accessToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Registration successful.',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ], 201);
    }
}
