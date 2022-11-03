<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        if (Auth::guard('user')->user()->id) {
            $id = Auth::guard('user')->user()->id;
        }
        
        return [
            'avatar' => 'file|mimes:jpeg,png,psd',
            'email' => "required|unique:users,email,{$id},id|email|min:10|max:255",
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'address' => 'required|max:100',
            'phone' => 'required|digits:10',
            'gender' => 'required',
            'province' => 'required|max:50',    
        ];
    }

    public function messages()
    {
        return [
            'avatar.file' => 'Ảnh đại diện phải là file ảnh',
            'avatar.mimes' => 'Chọn ảnh đại diện với định dạng jpeg, png, psd',
            'address.required' => 'Nhập địa chỉ của bạn',
            'email.required' => 'Nhập email của bạn',
            'email.email' => 'Địa chỉ email không hợp lệ',
            'email.unique' => 'Email này đã tồn tại',
            'email.min' => 'Email có ít nhất 10 ký tự',
            'first_name.required' => 'Nhập tên của bạn',
            'last_name.required' => 'Nhập họ và tên đệm của bạn',    
            'phone.required' => 'Nhập số điện thoại của bạn',
            'phone.digits' => 'Số điện thoại phải là 10 ký tự',
            'gender.required' => 'Chọn giới tính của bạn',
            'province.required' => 'Nhập tỉnh của bạn',        
        ];
    }
}
