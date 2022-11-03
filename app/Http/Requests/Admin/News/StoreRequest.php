<?php

namespace App\Http\Requests\Admin\News;

use App\Http\Requests\Admin\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required',
            'content' => 'required',
            'image' => 'required|image',
            'status' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please enter title',
            'title.max' => 'Please enter 255 characters or less for the title',
            'description.required' => 'Please enter description',
            'content.required' => 'Please enter content',
            'image.required' => 'Please choose an image',
            'image.image' => 'File is not an image',
            'status.required' => 'Please choose status'
        ];
    }
}
