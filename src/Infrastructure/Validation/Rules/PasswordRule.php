<?php

namespace Infrastructure\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordRule implements Rule
{
    /**
     * @param string $attribute
     */
    public function passes($attribute, $value): bool
    {
        // Проверяем, что длина пароля не менее 8 символов
        // и он содержит хотя бы одну заглавную букву, одну цифру и один символ
        return preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*\W).{8,}$/', $value);
    }

    /**
     *
     */
    public function message(): string
    {
        return 'The password must be at least 8 characters long, contain at least one uppercase letter, one number, and one special character.';
    }
}
