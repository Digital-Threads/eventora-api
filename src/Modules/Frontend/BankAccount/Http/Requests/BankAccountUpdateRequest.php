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
            $this->input('bank_account'),
            $this->input('currency_id'),
        );
    }
}
