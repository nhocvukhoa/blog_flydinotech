<?php

namespace App\Services\User;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordService
{
    /**
     * Create a new model instance.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Find email user from form
     *
     * @param \App\Http\Requests\Auth\UserRequest $request
     * @return void
     */
    public function findEmail($request)
    {
        return $this->model->where('email', $request->email)->first();
    }

    /**
     * Update new password for user account
     *
     * @param \App\Http\Requests\Auth\ChangePasswordRequest $request
     * @param \App\Models\User $user
     * @return boolean
     */
    public function updatePassword($request, $user)
    {
        try {
            $user->update([
                'password' => $request->password
            ]);

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }

    /**
     * Send password change request to user account
     *
     * @param \App\Http\Requests\Auth\ForgotPasswordRequest $request
     * @return void
     */
    public function sendEmail($request)
    {   
        $user = $this->model->where('email', $request->email)->first();
        $user_email = $user->email;
        $user_fullName = $user->userProfile->full_name;
        $userInfo = [
            'email' => $user_email
        ];

        Mail::send('user.auth.ForgotPassword.verify', $userInfo, function ($message) use ($user_email, $user_fullName) {
            $message->from(config('mail.mailers.smtp.username'), 'Flydino blog');
            $message->to($user_email, $user_fullName);
            $message->subject('[Flydino blog] Thay đổi mật khẩu');
        });
    }
}
