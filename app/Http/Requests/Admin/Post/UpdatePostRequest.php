<?php

namespace App\Http\Requests\Admin\Post;

use App\Http\Requests\Admin\BaseRequest;

class UpdatePostRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please enter title',
            'description.required' => 'Please enter description',
            'content.required' => 'Please enter content'
        ];
    }
}
