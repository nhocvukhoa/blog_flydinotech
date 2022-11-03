<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\User\BaseRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if( !Hash::check($value, Auth::guard('user')->user()->password) ){
                        return $fail(__('Mật khẩu cũ là không đúng. Mời nhập lại'));
                    }
                },
            ],
            'password' => 'required|min:6|max:30',
            'confirm_password' => 'required|same:password'
        ];
    }

    public function messages()  
    {
        return [
            'old_password.required' => 'Vui lòng nhập mật khẩu cũ',
            'password.required' => 'Vui lòng nhập mật khẩu mới',
            'password.min' => 'Mật khẩu mới phải có ít nhất :min ký tự',
            'password.max' => 'Mật khẩu mới tối đa :max ký tự',
            'confirm_password.required' => 'Vui lòng nhập lại mật khẩu',
            'confirm_password.same' => 'Mật khẩu nhập không khớp với mật khẩu trên'
        ];
    }
}
