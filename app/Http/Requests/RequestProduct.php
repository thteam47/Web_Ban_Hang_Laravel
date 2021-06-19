<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestProduct extends FormRequest
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
            'p_name' => 'required|unique:products,p_name'.$this->p_id,
            'p_price' => 'required',
            'p_description' => 'required',
            'p_image' => 'img',
            'p_accessories' => 'required'
            // 'p_description' => 'required',

        ];

    }
    public function messages(){
        return [
            'p_name.required' => 'Trường này không được để trống',
            'p_name.unique' => 'Tên danh mục đã tồn tại',
            'p_price.required' => 'Trường này không được để trống',
            'p_description.required' => 'Trường này không được để trống',
            'p_accessories.required' => 'Trường này không được để trống'

            //'p_description.required' => 'Trường này không được để trống'
        ];
    }
}
