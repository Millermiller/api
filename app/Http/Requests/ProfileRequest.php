<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        $id = Auth::user()->getKey();

        return [
            'login' => "required|string|alpha_num|max:255|unique:App\Entities\User,login,$id",
            'email' => "required|string|email|max:255|unique:App\Entities\User,email,$id",
            'password' => 'nullable|string|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Обязательное поле',
            'alpha_num' => 'Только латинские буквы и цифры',
            'confirmed' => 'Пароли не совпадают',
            'unique' => 'Пользователь уже зарегистрирован',
            'min' => 'Минимум :min символов',
            'email' => 'Укажите корректный email',
        ];
    }
}
