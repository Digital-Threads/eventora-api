<?php

namespace Modules\Frontend\BankAccount\Services;

use Infrastructure\Eloquent\Models\BankAccount;
use Modules\Frontend\BankAccount\Dto\BankAccountCreateDto;
use Modules\Frontend\BankAccount\Dto\BankAccountUpdateDto;

final class BankAccountCommandService
{
    /**
     * @param  BankAccountCreateDto  $request
     * @return mixed
     */
    public function createBankAccount(BankAccountCreateDto $request): BankAccount
    {
        return BankAccount::create([
            'bank_id' => $request->bankId,
            'bank_account' => $request->bankAccount,
            'currency_id' => $request->currencyId,
        ]);
    }

    /**
     * @param  BankAccountUpdateDto  $request
     * @param  BankAccount  $bankAccount
     * @return BankAccount
     */
    public function updateBankAccount(BankAccountUpdateDto $request, BankAccount $bankAccount): BankAccount
    {
        $bankAccount->update([
            'bank_id' => $request->bankId,
            'bank_account' => $request->bankAccount,
            'currency_id' => $request->currencyId,
        ]);
        return $bankAccount->fresh();
    }
}
