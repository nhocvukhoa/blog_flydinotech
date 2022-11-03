<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|unique:users|min:10|max:255',
            'password' => 'required|min:5|max:100',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'address' => 'required|max:100',
            'phone' => 'required|digits:10',
            'province' => 'required|max:50',
        ];
    }

    public function messages()
    {
        return[
            'email.unique' => 'Please enter another email address',
            'email.required' => 'Please enter a valid email address',
            'password.required' => 'Please enter a valid password',
            'first_name.required' => 'Please enter first name',
            'last_name.required' => 'Please enter last name',
            'address.required' => 'Please enter address',
            'phone.required' => 'Please enter a valid phone number',
            'phone.digits' => 'Please enter a 10-digit phone number',
            'province.required' => 'Please enter province',
        ];
    }
}
