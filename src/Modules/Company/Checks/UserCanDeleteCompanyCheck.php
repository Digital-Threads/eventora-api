<?php

namespace Modules\Company\Checks;

use Infrastructure\Auth\Check;
use Infrastructure\Auth\CheckFailure;
use Infrastructure\Auth\CheckResponse;
use App\Models\User;
use Infrastructure\Eloquent\Models\Company;

class UserCanDeleteCompanyCheck extends Check
{
    public function __construct(private readonly User $user, private readonly Company $company)
    {
        //
    }

    public function execute(): CheckResponse
    {
        $canDeleteCompany = $this->user->id === $this->company->admin_id || $this->user->role === 'admin';

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
