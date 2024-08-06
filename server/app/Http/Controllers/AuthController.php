<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
            }
            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;
            return response()->json(['user' => $user, 'token' => $token]);
        } catch (Exception $e) {
            Log::error('Login failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['error' => 'An error occurred during login'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function register(UserRequest $request)
    {
        try {
            $user = User::create($request->validated());
            return response()->json([
                'user' => $user,
                'token' => $user->createToken('API Token')->plainTextToken
            ]);
        } catch (Exception $e) {
            Log::error('Registration failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['error' => 'An error occurred during registration'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            return response()->json(['message' => 'Logged out successfully']);
        } catch (Exception $e) {
            Log::error('Logout failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['error' => 'An error occurred during logout'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
