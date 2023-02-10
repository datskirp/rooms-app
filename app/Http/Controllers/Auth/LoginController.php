<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\Provider;
use Laravel\Socialite\Two\User as SocialiteUser;
use Laravel\Socialite\Two\AbstractProvider;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    private AbstractProvider $provider;

    public function __construct(private readonly AuthService $authService)
    {
        $this->provider = Socialite::driver('google');
    }

    final public function loginWithGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    final public function callbackFromGoogle(): RedirectResponse
    {
        /** @var SocialiteUser $googleUser */
        $googleUser = Socialite::driver('google')->user();
        auth()->login($this->authService->getUser($googleUser), true);

        return redirect(config('app.url'));
    }

    final public function logout(Request $request): RedirectResponse
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return redirect(config('app.url'));
    }
}
