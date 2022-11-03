<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Services\Admin\BaseService;

class ProfileService extends BaseService
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
     * Display admin information
     *
     * @return \Illuminate\Http\Response
     */
    public function getAdmin()
    {
        return $this->model->where('id', Auth::guard('admin')->user()->id)->first();
    }

    /**
     * Update the specified resource
     *
     * @param \App\Http\Requests\User\UpdateProfileRequest $request
     * @return boolean
     */
    public function update($request)
    {
        DB::beginTransaction();

        try {
            $admin = $this->getAdmin();

            $admin->update([
                'email' => $request->email
            ]);

            if ($request->hasFile('avatar')) {
                $avatar = $this->imageChangeName($request);
            } else {
                $avatar = $admin->userProfile->avatar;
            }

            $admin->userProfile->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'phone' => $request->phone,
                'province' => $request->province,
                'gender' => $request->gender,
                'avatar' => $avatar
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
