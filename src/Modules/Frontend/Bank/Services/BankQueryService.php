<?php

namespace Modules\Frontend\Bank\Services;

use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Eloquent\Models\Bank;
use Infrastructure\Eloquent\Models\Company;
use Modules\Frontend\Bank\Dto\BankViewDto;

final class BankQueryService
{
    public function view(BankViewDto $request, int $companyId): Collection|array
    {
        return Bank::query()->with('companies')->whereHas('companies', function ($query) use ($companyId) {
            $query->where('company_id', $companyId);
        })->get();
    }
}
