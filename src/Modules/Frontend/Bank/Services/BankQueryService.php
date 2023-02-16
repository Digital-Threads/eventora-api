<?php

namespace Modules\Frontend\Bank\Services;

use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Eloquent\Models\Bank;
use Modules\Frontend\Bank\Dto\BankViewDto;

final class BankQueryService
{
    public function view(BankViewDto $request, int $companyId): Collection|array
    {
        return Bank::query()->where('company_id', $companyId)->get();
    }
}
