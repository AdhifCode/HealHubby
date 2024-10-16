<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use App\Models\SocialAccount;
use App\Models\User;

class SocialiteController extends Controller
{
    public function redirectToProvider($provider)
    {
        try {
            return Socialite::driver($provider)->redirect();
        } catch (\Throwable $th) {
            return response()->json(['data' => $th]);
        }
    }

    public function handleProviderCallback($provider)
{
    try {
        $user = Socialite::driver($provider)->stateless()->user();
    } catch (Exception $e) {
        // Handle the exception as needed
        return response()->json(['error' => 'Social login failed']);
    }

    $authUser = $this->findOrCreateUser($user, $provider);

    Auth::login($authUser, true);

    $token = $authUser->createToken('authToken')->plainTextToken;

    // Additional data to be passed to the front-end
    $additionalData = [
        'email' => $authUser->email,
        'remember_token' => $authUser->remember_token,
    ];

    $redirectUrl = env('CLIENT_BASE_URL') . '/auth/social-callback?token=' . $token . '&origin=' . ($user ? 'register' : 'login') . '&provider=' . $provider;

    foreach ($additionalData as $key => $value) {
        $redirectUrl .= "&{$key}={$value}";
    }

    return redirect($redirectUrl);
}


    public function findOrCreateUser($socialUser, $provider)
    {
        $socialAccount = SocialAccount::where('provider_id', $socialUser->getId())->where('provider_name', $provider)->first();

        if ($socialAccount) {
            return $socialAccount->user;
        } else {
            $randomNumber = rand(1, 100);
            $userName = 'User_' . $randomNumber;

            $user = User::where('email', $socialUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $socialUser->getName() ?? $userName,
                    'email' => $socialUser->getEmail()
                ]);
            }

            $user->socialAccounts()->create([
                'provider_id' => $socialUser->getId(),
                'provider_name' => $provider
            ]);

            return $user;
        }
    }
}
