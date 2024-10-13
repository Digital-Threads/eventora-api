<?php

namespace Modules\Company\Checks;

use Infrastructure\Auth\Check;
use Infrastructure\Auth\CheckFailure;
use Infrastructure\Auth\CheckResponse;
use App\Models\User;
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
        $canUpdateCompany = $this->user->id === $this->company->admin_id || $this->user->role === 'admin';

        return new CheckResponse(
            $canUpdateCompany,
            CheckFailure::create($this)
        );
    }
}
