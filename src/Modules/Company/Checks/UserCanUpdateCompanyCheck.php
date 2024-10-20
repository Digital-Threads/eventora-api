<?php

namespace Modules\Company\Checks;

use Infrastructure\Auth\Check;
use Infrastructure\Auth\CheckFailure;
use Infrastructure\Auth\CheckResponse;
use Infrastructure\Eloquent\Models\User;
use Infrastructure\Eloquent\Models\Company;

class UserCanUpdateCompanyCheck extends Check
{
    public function __construct(private readonly User $user, private readonly Company $company)
    {
        //
    }

    public function execute(): CheckResponse
    {
        // Проверяем, является ли пользователь администратором компании или системным администратором.
        $canUpdateCompany = $this->user->company_id === $this->company->id || $this->user->isAdmin();

        return new CheckResponse(
            $canUpdateCompany,
            CheckFailure::create($this)
        );
    }
}
