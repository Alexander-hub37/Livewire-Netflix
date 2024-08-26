<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|confirmed|min:8',
            ]);

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            $user->assignRole('User');

            return response()->json([
                'message' => 'Registration successful! Please check your email for verification.',
                'user' => $user,
            ], 201);

        } catch (ValidationException $e) {
            
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        }
    }

    public function login(Request $request)
{
    try {

        $validatedData = $request->validate([
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string',
        ]);


        if (Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {
            $user = Auth::user();

            if ($user->hasVerifiedEmail()) {
                $token = $user->createToken('Personal Access Token')->plainTextToken;

                return response()->json([
                    'message' => 'Login successful',
                    'data' => [
                        'user' => $user,
                        'token' => $token,
                    ],
                ], 200);
            } else {

                Auth::logout();

                return response()->json([
                    'message' => 'Please verify your email before logging in.',
                ], 403);
            }
        }

        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);

    } catch (ValidationException $e) {
        return response()->json([
            'errors' => $e->errors(),
        ], 422);
    } 
}

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->tokens()->delete();

        return response()->json([
            'message' => 'Logout successful',
        ]);
    }
}
