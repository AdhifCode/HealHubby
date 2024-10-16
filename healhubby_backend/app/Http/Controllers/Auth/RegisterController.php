<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $passwordConfirmation = $request->input('password_confirmation');

        if ($request->input('password') !== $passwordConfirmation) {
            throw ValidationException::withMessages([
                'password_confirmation' => ['The password confirmation does not match.'],
            ]);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        if ($user) {
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'success' => true,
                'data' => $user,
                'token' => $token,
            ], 201);
        }

        throw ValidationException::withMessages([
            'error' => ['Registration failed'],
        ]);
    }
}