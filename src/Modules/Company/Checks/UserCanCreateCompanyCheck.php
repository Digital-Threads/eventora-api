<?php

namespace Modules\Company\Checks;

use Infrastructure\Auth\Check;
use Infrastructure\Auth\CheckFailure;
use Infrastructure\Auth\CheckResponse;
use Infrastructure\Eloquent\Models\User;

class UserCanCreateCompanyCheck extends Check
{
    public function __construct(private readonly User $user)
    {
        //
    }

    public function execute(): CheckResponse
    {
        // Логика проверки может быть связана с правами или лимитами.
        $canCreateCompany = $this->user->isAdmin(); // Например, проверяем, что пользователь - администратор.

        return new CheckResponse(
            $canCreateCompany,
            CheckFailure::create($this)
        );
    }
}
