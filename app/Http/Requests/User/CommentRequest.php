<?php

namespace App\Http\Requests\User;

use App\Http\Requests\User\BaseRequest;

class CommentRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'Please enter comment'
        ];
    }
}
