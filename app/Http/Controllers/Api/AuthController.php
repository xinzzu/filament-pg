<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\MobileUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    use ApiResponse;

    // Register a new mobile user
    public function register(Request $request)
    {
        $request->validate([
            'medical_record_number' => 'required|unique:mobile_users,medical_record_number',
            'password' => 'required|min:6',
        ]);

        $user = MobileUser::create([
            'medical_record_number' => $request->medical_record_number,
            'password' => bcrypt($request->password),
        ]);

        return $this->successResponse('User registered successfully', $user);
    }

    // Login user
    public function login(Request $request)
    {
        $request->validate([
            'medical_record_number' => 'required',
            'password' => 'required',
        ]);

        $user = MobileUser::where('medical_record_number', $request->medical_record_number)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->errorResponse('Invalid credentials', 1001);
        }

        $token = $user->createToken('mobile_token')->plainTextToken;

        return $this->successResponse('Login successful', ['access_token' => $token]);
    }

    // Logout user
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->successResponse('Logged out successfully');
    }

    // Get user details
    public function user(Request $request)
    {
        return $this->successResponse('User retrieved successfully', $request->user());
    }
}
