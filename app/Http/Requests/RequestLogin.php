<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class RequestLogin extends FormRequest
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
            'email' => 'required|email|',
            'password' => 'required',
        ];
    }
    public function messages(){
        return [
            'email.required' => 'Trường này không được để trống',
            'password.required' => 'Trường này không được để trống',
            'email.email' => 'Email không hợp lệ',
        ];
    }
}
