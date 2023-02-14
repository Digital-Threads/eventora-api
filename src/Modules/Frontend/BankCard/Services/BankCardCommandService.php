<?php

namespace Modules\Frontend\BankCard\Services;

use Infrastructure\Eloquent\Models\BankCard;
use Modules\Frontend\BankCard\Dto\BankCardCreateDto;
use Modules\Frontend\BankCard\Dto\BankCardUpdateDto;

final class BankCardCommandService
{
    /**
     * @param  BankCardCreateDto  $request
     * @return mixed
     */
    public function createBankCard(BankCardCreateDto $request): BankCard
    {
        return BankCard::create([
            'bank_id' => $request->bankId,
            'card_number' => $request->cardNumber,
            'card_employee_name' => $request->cardEmployeeName,
            'currency_id' => $request->currencyId,
            'expired_year' => $request->expiredYear,
            'expired_month' => $request->expiredYear,
        ]);
    }

    /**
     * @param  BankCardUpdateDto  $request
     * @param  BankCard  $bankCard
     * @return BankCard
     */
    public function updateBankCard(BankCardUpdateDto $request, BankCard $bankCard): BankCard
    {
        $bankCard->update([
            'bank_id' => $request->bankId,
            'card_number' => $request->cardNumber,
            'card_employee_name' => $request->cardEmployeeName,
            'currency_id' => $request->currencyId,
            'expired_year' => $request->expiredYear,
            'expired_month' => $request->expiredYear,
        ]);
        return $bankCard->fresh();
    }
}
