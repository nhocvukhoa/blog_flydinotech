<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\User\BaseRequest;

class ChangePasswordWhenForgotRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'password' => 'required|min:6|max:30',
            'confirm_password' => 'required|same:password'
        ];
    }

    public function messages()  
    {
        return [
            'password.required' => 'Vui lòng nhập mật khẩu mới',
            'password.min' => 'Mật khẩu mới phải có ít nhất :min ký tự',
            'password.max' => 'Mật khẩu mới tối đa :max ký tự',
            'confirm_password.required' => 'Vui lòng nhập lại mật khẩu mới',
            'confirm_password.same' => 'Mật khẩu nhập lại không đúng'
        ];
    }
}
