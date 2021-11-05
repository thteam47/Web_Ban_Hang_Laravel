<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class RequestRegister extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email'.$this->id,
            'username' => 'required|unique:users,username'.$this->id,
            'phone' => 'required',
            'password' => 'required',
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Trường này không được để trống',
            'email.unique' => 'Email người dùng đã tồn tại',
            'username.unique' => 'Tài khoản người dùng đã tồn tại',
            'username.required' => 'Trường này không được để trống',
            'email.required' => 'Trường này không được để trống',
            'password.required' => 'Trường này không được để trống',
            'phone.required' => 'Trường này không được để trống',
            'email.email' => 'Email không hợp lệ',
        ];
    }
}
