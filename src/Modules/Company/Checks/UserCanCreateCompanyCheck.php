<?php

namespace Modules\Company\Checks;

use Infrastructure\Eloquent\Models\User;
use Infrastructure\Auth\Check;
use Infrastructure\Auth\CheckFailure;
use Infrastructure\Auth\CheckResponse;

class UserCanCreateCompanyCheck extends Check
{
    public function __construct(private readonly User $user)
    {
        //
    }

    public function execute(): CheckResponse
    {
        // Логика проверки может быть связана с правами или лимитами.
        $canCreateCompany = $this->user->role === 'admin'; // Например, проверяем, что пользователь - администратор.

        return new CheckResponse(
            $canCreateCompany,
            CheckFailure::create($this)
        );
    }
}
