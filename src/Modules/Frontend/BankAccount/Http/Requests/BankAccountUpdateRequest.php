<?php

namespace Modules\Frontend\BankAccount\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\BankAccount\Dto\BankAccountCreateDto;

final class BankAccountUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): BankAccountCreateDto
    {
        return new BankAccountCreateDto(
            $this->input('bank_id'),
            $this->input('card_number'),
            $this->input('card_employee_name'),
            $this->input('expired_month'),
            $this->input('expired_year'),
            $this->input('currency_id'),

        );
    }
}
