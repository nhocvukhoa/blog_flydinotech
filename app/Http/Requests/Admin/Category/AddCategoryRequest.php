<?php

namespace App\Http\Requests\Admin\Category;

use App\Http\Requests\Admin\BaseRequest;

class AddCategoryRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title' => 'required|unique:categories|max:255',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please enter title',
            'title.unique' => 'Please enter another title',
            'description.required' => 'Please enter description'
        ];
    }
}
