<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\User\BaseRequest;

class ForgotPasswordRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email|max:30'
        ];
    }

    public function messages()  
    {
        return [
            'email.required' => 'Nhập địa chỉ email của bạn',
            'email.email' => 'Địa chỉ email không hợp lệ',
            'email.max' => 'Địa chỉ email không vượt quá 30 ký tự'
        ];
    }
}
