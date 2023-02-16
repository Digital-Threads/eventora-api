<?php

namespace Modules\Frontend\Bank\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\Bank\Dto\BankCreateDto;

final class BankCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): BankCreateDto
    {
        return new BankCreateDto(
            $this->input('company_id'),
            $this->input('bank_name'),
            $this->input('countr'),
            $this->input('city'),
            $this->input('address'),
        );
    }
}
