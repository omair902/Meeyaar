<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
        switch($this->method())
        {
            case 'POST':
                return [
                    'sub_category_name'=>'required|max:255',
                    'category'=>'required',
                ];
            case 'PATCH':
                return [
                    'sub_category_name'=>'required|max:255',
                    'category'=>'required',
                ];
        }
    }
    public function messages()
    {
        return 
        [
            'sub_category_name.required'=>'Name field is required'
        ];
    }
}
