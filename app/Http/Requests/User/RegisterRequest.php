<?php

namespace App\Http\Requests\User;

use App\Http\Requests\User\BaseRequest;

class RegisterRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'avatar' => 'required|file|mimes:jpeg,png,psd',
            'address' => 'required|max:100',
            'phone' => 'required|digits:10',
            'gender' => 'required',
            'province' => 'required|max:50',
            'email' => 'required|email|unique:users|min:10|max:255',
            'password' => 'required|min:5|max:50',
            'confirm_password' => 'required|same:password',
            'agree_terms' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Nhập tên của bạn',
            'last_name.required' => 'Nhập họ và tên đệm của bạn',    
            'avatar.required' => 'Chọn ảnh đại diện',
            'avatar.file' => 'Ảnh đại diện phải là file ảnh',
            'avatar.mimes' => 'Chọn ảnh đại diện với định dạng jpeg, png, psd',
            'address.required' => 'Nhập địa chỉ của bạn',
            'phone.required' => 'Nhập số điện thoại của bạn',
            'phone.digits' => 'Số điện thoại phải là 10 ký tự số',
            'gender.required' => 'Chọn giới tính của bạn',
            'province.required' => 'Nhập tỉnh của bạn',
            'email.required' => 'Nhập địa chỉ email của bạn',
            'email.email' => 'Địa chỉ email không hợp lệ',
            'email.unique' => 'Email này đã tồn tại',
            'password.required' => 'Nhập mật khẩu',
            'password.min' => 'Mật khẩu có ít nhất 5 ký tự',
            'confirm_password.required' => 'Nhập lại mật khẩu',
            'confirm_password.same' => 'Mật khẩu nhập lại không đúng',
            'agree_terms.required' => 'Hãy đồng ý với các điều khoản dịch vụ của chúng tôi'
        ];
    }
}
