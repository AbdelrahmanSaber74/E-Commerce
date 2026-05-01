<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthService
{
    /**
     * Handle social login/registration
     */
    public function handleSocialCallback(string $provider): User
    {
        $socialUser = Socialite::driver($provider)->user();

        $user = User::where("{$provider}_id", $socialUser->getId())
                    ->orWhere('email', $socialUser->getEmail())
                    ->first();

        if ($user) {
            // Update social ID if not set
            $user->update([
                "{$provider}_id" => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
                'social_type' => $provider
            ]);
        } else {
            // Create new user
            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                "{$provider}_id" => $socialUser->getId(),
                'social_type' => $provider,
                'avatar' => $socialUser->getAvatar(),
                'password' => Hash::make(Str::random(24)), // Random password
                'email_verified_at' => now(),
            ]);
        }

        Auth::login($user);

        return $user;
    }
}
