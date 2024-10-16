<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        
        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request->input('email'))->firstOrFail();
            $token = $user->createToken('authToken')->plainTextToken;
        
            return response()->json([
                'success' => true,
                'data' => $user,
                'token' => $token,
            ], 200);
        }
        
        throw ValidationException::withMessages([
            'loginIdentifier' => ["Invalid email or password"],
        ]);
        
    }
    public function loginSocialite(Request $request)
{
    $request->validate([
        'email' => 'required|string',
        'remember_token' => 'required|string',
    ]);

    $user = User::where('email', $request->input('email'))->first();

    if (!$user) {
        $user = User::create([
            'email' => $request->input('email'),
            'remember_token' => $request->input('remember_token'),
        ]);
    }

    Auth::login($user, true);

    $token = $user->createToken('authToken')->plainTextToken;

    return response()->json([
        'success' => true,
        'data' => $user,
        'token' => $token,
    ], 200);
}

}