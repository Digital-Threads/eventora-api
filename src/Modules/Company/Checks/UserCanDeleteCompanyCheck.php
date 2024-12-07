<?php

namespace Modules\Company\Checks;

use Infrastructure\Auth\Check;
use Infrastructure\Auth\CheckFailure;
use Infrastructure\Auth\CheckResponse;
use Infrastructure\Eloquent\Models\Company;
use Infrastructure\Eloquent\Models\User;

class UserCanDeleteCompanyCheck extends Check
{
    public function __construct(private readonly User $user, private readonly Company $company)
    {
        //
    }

    public function execute(): CheckResponse
    {
        $canDeleteCompany = $this->user->company_id === $this->company->id || $this->user->isAdmin();

        $companiesCount = Company::count();
        if ($companiesCount <= 1) {
            return new CheckResponse(
                false, // Не разрешаем удаление, если это единственная компания
                CheckFailure::create($this, 'Нельзя удалить последнюю компанию в системе.')
            );
        }

        return new CheckResponse(
            $canDeleteCompany,
            CheckFailure::create($this)
        );
    }
}
