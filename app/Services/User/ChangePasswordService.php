<?php

namespace App\Services\User;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordService
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Get user profile
     *
     * @param \App\Models\User $model
     */
    public function getUserProfile()
    {
        return $this->model->where('id', Auth::guard('user')->user()->id)->first();
    }

    /**
     * Count post viewed
     *
     * @param \App\Models\Post $model
     */
    public function postViewed() 
    {
        $postViewed = Post::where('user_id', Auth::guard('user')->user()->id)->sum('viewed');

        return number_format($postViewed, 0, ',', '.');
    }

    public function changePassword($request)
    {
        $hashedPassword = Auth::guard('user')->user()->password;

        if (Hash::check($request->old_password, $hashedPassword)) {
            $user = $this->model->where('id', '=', Auth::guard('user')->id())->update([
                'password' => Hash::make($request->password),
            ]);
            return $user;
        }

        return false;
    }
}
