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
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;


class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        $user->assignRole('User');

        return response()->json([
            'message' => 'Registration successful! Please check your email for verification.',
            'user' => $user,
        ], 201);

    }

    public function login(LoginRequest $request)
    {
        $validatedData = $request->validated();

        if (Auth::attempt($validatedData)) {
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
