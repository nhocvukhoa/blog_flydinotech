<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|max:255',
            'description' => 'required',
            'content' => 'required',
            'image' =>  'required|file|mimes:jpeg,png,psd',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng điền chủ đề',
            'description.required' => 'Vui lòng điền mô tả',
            'content.required' => 'Vui lòng điền nội dung',
            'image.required' => 'Hãy chọn ảnh',
            'image.file' => 'Hãy chọn thư mục ảnh',
            'image.mimes' => 'Thư mục ảnh phải có định dạng: jpeg, png, psd',
            'category.required' => 'Hãy chọn danh mục',
        ];
    }
}
