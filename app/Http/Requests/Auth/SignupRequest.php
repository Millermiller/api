<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SignupRequest
 *
 * @package App\Http\Requests\Auth
 */
class SignupRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'login'    => "required|string|alpha_num|max:255|unique:Scandinaver\User\Domain\Entity\User,login",
            'email'    => "required|string|email|max:255|unique:Scandinaver\User\Domain\Entity\User,email",
            'password' => 'nullable|string|min:6|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'required'  => 'Обязательное поле',
            'alpha_num' => 'Только латинские буквы и цифры',
            'confirmed' => 'Пароли не совпадают',
            'unique'    => 'Пользователь уже зарегистрирован',
            'min'       => 'Минимум :min символов',
            'email'     => 'Укажите корректный email',
        ];
    }
}
