<?php

namespace App\Http\Requests\Admin\Post;

use App\Http\Requests\Admin\BaseRequest;

class AddPostRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required',
            'content' => 'required',
            'image' =>  'required|file|mimes:jpeg,png,psd'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please enter title',
            'description.required' => 'Please enter description',
            'content.required' => 'Please enter content',
            'image.required' => 'Please choose image',
            'image.file' => 'Please choose image file',
            'image.mimes' => 'Please choose image (jpeg, png, psd)'
        ];
    }
}
