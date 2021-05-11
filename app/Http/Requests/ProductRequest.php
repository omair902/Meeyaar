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
        switch($this->method())
        {
            case 'POST':
                return [
                    'video'  => 'max:20000 | required',
                    'images'=>'required',
                    'title'=>'required',
                    'who'=>'required',
                    'what'=>'required',
                    'when'=>'required',
                    'price'=>'required',
                    'category'=>'required',
                    'type'=>'required',
                    'description'=>'required|max:2000',
                ];
            case 'PATCH':
                    return [
                        'video'  => 'max:20000',
                        'title'=>'required',
                        'who'=>'required',
                        'what'=>'required',
                        'when'=>'required',
                        'price'=>'required',
                        'category'=>'required',
                        'type'=>'required',
                        'description'=>'required|max:2000',
                    ];
        }
        
    }
}
