<?php

namespace Modules\Frontend\BankAccount\Services;

use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Eloquent\Models\Bank;
use Infrastructure\Eloquent\Models\BankAccount;
use Modules\Frontend\BankAccount\Dto\BankAccountViewDto;

final class BankAccountQueryService
{
    public function view(BankAccountViewDto $request, Bank $bank): Collection|array
    {
        return BankAccount::query()->where('bank_id',$bank->id)->get();
    }
}
