<?php

namespace App\Services\User;

use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Enums\PostStatus;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\User\BaseService;

class ProfileService extends BaseService
{
    /**
     * Create a new model instance.
     *
     * @param \App\Models\User $model
     * @param \App\Models\Post $post
     */
    public function __construct(User $model, Post $post)
    {
        $this->model = $model;
        $this->post = $post;
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
     * Get list posts
     *
     * @param \App\Models\Post $model
     */
    public function listPost()
    {
        return $this->post->where('user_id', Auth::guard('user')->user()->id)
            ->where('status', PostStatus::ACTIVE)
            ->orderByDesc('created_at')
            ->paginate(config('api.pagination.per_page'));
    }

    /**
     * Count post viewed
     *
     * @param \App\Models\Post $model
     */
    public function postViewed() 
    {
        $postViewed = $this->post->where('user_id', Auth::guard('user')->user()->id)->sum('viewed');

        return number_format($postViewed, 0, ',', '.');
    }

    /**
     * Update user profile
     *
     */
    public function saveUserProfile($request)
    {    
        DB::beginTransaction();

        try {
            $user = $this->getUserProfile();

            $user->update([
                'email' => $request->email,
            ]);

            if ($request->hasFile('avatar')) {
                $avatarName = $this->imageChangeName($request);
            } else {
                $avatarName = $user->userProfile->avatar;
            }

            $user->userProfile->update([
                'avatar' => $avatarName,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'phone' => $request->phone,
                'province' => $request->province,
                'gender' => $request->gender,
            ]);

            DB::commit();

            return true;
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();

            return false;
        }
    }
}
