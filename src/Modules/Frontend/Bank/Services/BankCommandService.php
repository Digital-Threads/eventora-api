<?php

namespace Modules\Frontend\Bank\Services;

use Infrastructure\Eloquent\Models\Bank;
use Modules\Frontend\Bank\Dto\BankCreateDto;
use Modules\Frontend\Bank\Dto\BankUpdateDto;

final class BankCommandService
{
    /**
     * @param  BankCreateDto  $request
     * @return mixed
     */
    public function createBank(BankCreateDto $request): Bank
    {
        return Bank::create([
            'company_id' => $request->companyId,
            'name' => $request->bankName,
            'country' => $request->country,
            'city' => $request->city,
            'address' => $request->address,
        ]);
    }

//    /**
//     * @param  BankUpdateDto  $request
//     * @param  Bank  $bank
//     * @return Bank
//     */
//    public function updateBank(BankUpdateDto $request, Bank $bank): Bank
//    {
//        $bank->update([
//            'bank_id' => $request->bankId,
//            'card_number' => $request->cardNumber,
//            'card_employee_name' => $request->cardEmployeeName,
//            'currency_id' => $request->currencyId,
//            'expired_year' => $request->expiredYear,
//            'expired_month' => $request->expiredYear,
//        ]);
//        return $bank->fresh();
//    }
}
