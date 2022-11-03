<?php

namespace App\Http\Requests\Admin\Category;

use App\Http\Requests\Admin\BaseRequest;

class UpdateCategoryRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please enter title',
            'description.required' => 'Please enter description'
        ];
    }
}
