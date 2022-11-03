<?php

namespace App\Http\Requests\Admin;

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
        if (Auth::guard('admin')->user()->id) {
            $id = Auth::guard('admin')->user()->id;
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
            'avatar.file' => 'Please choose image file',
            'avatar.mimes' => 'Please choose image (jpeg, png, psd)',
            'address.required' => 'Please enter address',
            'email.required' => 'Please enter email',
            'email.email' => 'Invalid email',
            'email.unique' => 'This email already exists',
            'email.min' => 'Email with at least 10 characters',
            'first_name.required' => 'Please enter first name',
            'last_name.required' => 'Please enter last name',    
            'phone.required' => 'Please enter phone',
            'phone.digits' => 'Please enter a 10-digit phone number',
            'gender.required' => 'Please choose your gender',
            'province.required' => 'Please enter content',        
        ];
    }
}
