<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => (!empty($this->segment(3)) ? "required|min:3|max:50|unique:products,name,{$this->segment(3)},id" : "required|min:3|max:50|unique:products,name"),
            'description' => 'max:1000',
            'image' => 'image',
            'category_id' => 'required|exists:categories,id'
        ];
    }
}
