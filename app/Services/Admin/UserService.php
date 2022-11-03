<?php

namespace App\Services\Admin;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Enums\UserStatus;
use App\Services\Admin\BaseService;

class UserService extends BaseService
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of user.
     *
     * @param \Illuminate\Http\Request $request
     * @return $this->model
     */
    public function listUsers($request)
    {
        if (isset($request)){
            return $this->model->where('email', 'like', '%' . $request->keyword . '%')
                ->orWhereHas('userProfile', function ($query) use ($request) {
                    $query->where('first_name', 'like', '%' . $request->keyword . '%')
                        ->orWhere('last_name', 'like', '%' . $request->keyword . '%');
                })
                ->orderByDesc('created_at')
                ->paginate(10);
        }
        else {
            return $this->model->orderByDesc('created_at')->paginate(10);
        }
    }

    /**
     * Update user profile.
     *
     * @param \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return boolean
     */
    public function update($request, $user)
    {
        DB::beginTransaction();
        try {
            $user->update([
                'email' => $request->email,
                'password' => $request->password,
            ]);

            if ($request->hasFile('avatar')) {
                $avatarName = $this->imageChangeName($request);
            } else {
                $avatarName = $user->userProfile->avatar;
            }
            $user->userProfile->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'phone' => $request->phone,
                'province' => $request->province,
                'gender' => $request->gender,
                'avatar' => $avatarName,
            ]);

            DB::commit();

            return true;
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();

            return false;
        }
    }

    /**
     * Create a new user and user profile.
     *
     * @param \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function saveUser($request)
    {
        DB::beginTransaction();
        try {
            $user = $this->model->create([
                'email' => $request->email,
                'password' => $request->password,
            ]);

            if ($request->hasFile('avatar')) {
                $avatarName = $this->imageChangeName($request);
            } else {
                $avatarName = null;
            }
            $user->userProfile()->create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'phone' => $request->phone,
                'province' => $request->province,
                'gender' => $request->gender,
                'avatar' => $avatarName,
            ]);

            DB::commit();

            return true;
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();

            return false;
        }
    }

    /**
     * Delete user.
     *
     * @param  \App\Models\User  $user
     * @return boolean
     */
    public function delete($user)
    {
        try {
            $user->delete();
            
            return true;
        } catch (Exception  $e) {
            Log::error($e);

            return false;
        }
    }
    
    /**
     * Block user.
     *
     * @param  \App\Models\User  $user
     * @return boolean
     */
    public function blockUser($user)
    {
        try {
            $user['status'] == UserStatus::BLOCK ? $data = ['status' => UserStatus::ACTIVE] :  $data = ['status' => UserStatus::BLOCK];
            $user->update($data);

            return true;
        } catch (Exception  $e) {
            Log::error($e);

            return false;
        }
    }
}
