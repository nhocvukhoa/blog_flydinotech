<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Models\User;
use App\Services\User\ChangePasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    public function __construct(ChangePasswordService $changePasswordService)
    {
        $this->changePasswordService = $changePasswordService;
    }

    /**
     * Show change password form.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        $user = $this->changePasswordService->getUserProfile();
        $postViewed = $this->changePasswordService->postViewed();

        return view('user.profile.form.ChangePassword', compact('user', 'postViewed'));
    }

    /**
     * Change new password user account
     *
     * @param \App\Http\Requests\Auth\ChangePasswordRequest $request
     * @return \Illuminate\Http\Response
     */
    public function saveNewPassword(Request $params)
    {
        $password = new ChangePasswordRequest();
        $validator = Validator::make($params->all(), $password->rules(), $password->messages()); 

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $this->changePasswordService->changePassword($params);

            return response()->json([
                'status' => 200,
                'message' => 'Thay đổi mật khẩu thành công'
            ]);
        }
    }
}
