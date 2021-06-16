<?php


namespace App\Http\Requests\User;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateUserRequest
 *
 * @package App\Http\Requests\User
 */
class CreateUserRequest extends FormRequest
{
    public function rules(): array
    {
        $id = Auth::user()->getKey();

        return [
            'login'    => "required|string|alpha_num|max:255|unique:Scandinaver\User\Domain\Entity\User,login,$id",
            'email'    => "required|string|email|max:255|unique:Scandinaver\User\Domain\Entity\User,email,$id",
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
