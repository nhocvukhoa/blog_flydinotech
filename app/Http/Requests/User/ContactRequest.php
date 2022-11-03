<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'full_name' => 'required|max:255',
            'email' => 'required',
            'phone' => 'required|digits:10',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Vui lòng điền họ và tên',
            'full_name.max' => 'Họ và tên không quá 255 chữ',
            'email.required' => 'Vui lòng điền email',
            'phone.required' => 'Vui lòng điền số điện thoại',
            'phone.digits' => 'Vui lòng điền số điện thoại có 10 chữ cái',
            'content.required' => 'Hãy ghi một thứ gì đó'
        ];
    }
}
