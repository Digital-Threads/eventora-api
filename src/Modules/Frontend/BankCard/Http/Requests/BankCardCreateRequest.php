<?php

namespace Modules\Frontend\BankCard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\BankCard\Dto\BankCardCreateDto;

final class BankCardCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): BankCardCreateDto
    {
        return new BankCardCreateDto(
            $this->input('bank_id'),
            $this->input('card_number'),
            $this->input('card_employee_name'),
            $this->input('expired_month'),
            $this->input('expired_year'),
            $this->input('currency_id'),

        );
    }
}
