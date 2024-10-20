<?php

namespace Infrastructure\Validation\Rules;

use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Rule;

class CurrentPasswordRule implements Rule
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * @param string $attribute
     */
    public function passes($attribute, $value): bool
    {
        return Hash::check($value, $this->user->password);
    }

    /**
     *
     */
    public function message(): string
    {
        return 'The current password is incorrect.';
    }
}
