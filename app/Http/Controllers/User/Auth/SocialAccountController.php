<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\Provider;
use App\Models\SocialAccount;
use App\Models\User;
use App\Services\User\SocialAccountService;
use Illuminate\Support\Facades\Auth;

class SocialAccountController extends Controller
{   
    /**
     * The service implementation.
     *
     * @var [type]
     */
    protected $socialAccountService;

    /**
     * Create a new service instance.
     *
     * @param \App\Services\User\SocialAccountService $socialAccountService
     */
    public function __construct(SocialAccountService $socialAccountService)
    {
        $this->socialAccountService = $socialAccountService;
    }

    /**
     * Declare guard 
     */
    protected function guard()
    {
        return Auth::guard('user');
    }

    /**
     * Redirect to social network
     *
     * @param [type] $provider
     * @return void
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Login with social account
     *
     * @param [type] $provider
     * @return void
     */
    public function handleProviderCallback($provider)
    {        
        if ($provider == 'github') {
            $providerUser = Socialite::driver($provider)->stateless();
        } else {
            $providerUser = Socialite::driver($provider);
        }

        $user = $this->socialAccountService->create($providerUser);

        if ($user) {
            return redirect()->route('dashboard')->with('success', __('messages.login.success'));
        }

        return redirect()->back()->with('error', __('messages.login.error'));
    }
}
