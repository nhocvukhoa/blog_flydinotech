<?php

namespace App\Services\User;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\SocialAccount;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Services\User\BaseService;

class SocialAccountService extends BaseService
{
    /**
     * Create a new model instance.
     *
     * @param \App\Models\User $model
     */
    public function __construct(SocialAccount $model)
    {
        $this->model = $model;
    }

    /**
     * Callback from google
     *
     * @return boolean
     */
    public function create($provider)
    {
        DB::beginTransaction();

        try {
            $providerUser = $provider->user();
            $providerName = class_basename($provider);
            $user = User::whereEmail($providerUser->getEmail())->first();
            $account = $this->model->whereProvider($providerName)
                ->whereProviderUserId($providerUser->getId())
                ->first();

            if ($account) {
                Auth::guard('user')->login($account->user);

                return true;
            } else {
                if ($user) {
                    $account = $this->model->create([
                        'user_id' => $user->id,
                        'provider_user_id' => $providerUser->getId(),
                        'provider' => $providerName
                    ]);
                } else {
                    $user = User::create([
                        'email' => $providerUser->getEmail(),
                        'role' => UserRole::USER,
                        'status' => UserStatus::ACTIVE
                    ]);

                    if ($providerName == 'GithubProvider') {
                        $user->userProfile()->create([
                            'first_name' => $providerUser->getNickname(),
                            'avatar' => $providerUser->getAvatar()
                        ]);
                    }

                    if ($providerName == 'TwitterProvider') {
                        $user->userProfile()->create([
                            'first_name' => $providerUser->getNickname(),
                            'avatar' => $providerUser->getAvatar()
                        ]);
                    }
        
                    if ($providerName == 'GoogleProvider') {
                        $user->userProfile()->create([
                            'first_name' => $providerUser->user['family_name'],
                            'last_name' => $providerUser->user['given_name'],
                            'avatar' => $this->getAvatarNameSocial($provider),
                        ]);
                    } 
                    
                    if ($providerName == 'FacebookProvider') {
                        $user->userProfile()->create([
                            'first_name' => $providerUser->getName(),
                            'avatar' => $this->getAvatarNameSocial($provider),
                        ]);
                    }  
                    
                    $account = $this->model->create([
                        'user_id' => $user->id,
                        'provider_user_id' => $providerUser->getId(),
                        'provider' => $providerName
                    ]);
                }
                    
                Auth::guard('user')->login($account->user);

                DB::commit();

                return true;
            }
        } catch (Exception $e) {
            Log::error($e);
            DB::rollback();

            return false;
        }
    }
}
