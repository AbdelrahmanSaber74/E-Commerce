<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\SocialAuthService;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\RedirectResponse;
use Exception;

class SocialAuthController extends Controller
{
    public function __construct(
        protected SocialAuthService $socialAuthService
    ) {}

    /**
     * Redirect to provider
     */
    public function redirectToProvider(string $provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle callback
     */
    public function handleCallback(string $provider): RedirectResponse
    {
        try {
            $this->socialAuthService->handleSocialCallback($provider);
            return redirect()->route('front.index')->with('success', __('messages.login_success'));
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', __('messages.social_login_failed'));
        }
    }
}
