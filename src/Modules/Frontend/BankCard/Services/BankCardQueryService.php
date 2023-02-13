<?php

namespace Modules\Frontend\BankCard\Services;

use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Eloquent\Models\Bank;
use Infrastructure\Eloquent\Models\BankCard;
use Modules\Frontend\BankCard\Dto\BankCardViewDto;

final class BankCardQueryService
{
    public function view(BankCardViewDto $request, Bank $bank): Collection|array
    {
        return BankCard::query()->where('bank_id',$bank->id)->get();
    }
}
