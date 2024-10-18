<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // User Registration
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'success' => true,
            'token' => $token
        ], 201);
    }

    // User Login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::validate($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $token = Auth::attempt($credentials);

        $user_details = Auth::user();
        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user_details
        ]);
    }


    // User Logout
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json([
            'success' => true,
            'message' => 'User successfully logged out'
        ]);
    }
}
