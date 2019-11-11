<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
           'email'=>'required|email|unique:users,email',
           'password'=>'required|min:5',
           'full'=>'required|min:4',
           'phone'=>'required|min:7'
        ];
    }
    public function messages()
    {
        return [
            'email.required'=>'Email Không được để trống!',
            'email.email'=>'Email Không đúng định dạng!',
            'email.unique'=>'Email đã tồn tại!',
            'password.required'=>'Mật khẩu Không được để trống!',
            'password.min'=>'Mật khẩu không được nhỏ hơn 5 ký tự!',
            'full.required'=>'Họ tên Không được để trống!',
            'full.min'=>'Họ tên Không được nhỏ hơn 4 ký tự!',
            'phone.required'=>'số điện thoại Không được để trống!',
            'phone.min'=>'Số điện thoại Không được nhỏ hơn 7 ký tự!',
        ];
    }


}
