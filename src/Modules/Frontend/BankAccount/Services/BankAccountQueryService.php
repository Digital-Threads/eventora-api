<?php

namespace Modules\Frontend\BankAccount\Services;

use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Eloquent\Models\BankAccount;
use Modules\Frontend\BankAccount\Dto\BankAccountViewDto;

final class BankAccountQueryService
{
    public function view(BankAccountViewDto $request, int $companyId): Collection|array
    {
        return BankAccount::query()->with('companies')->whereHas('companies', function ($query) use ($companyId) {
            $query->where('company_id', $companyId);
        })->get();
    }
}
