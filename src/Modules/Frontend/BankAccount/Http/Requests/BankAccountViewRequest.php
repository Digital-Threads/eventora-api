<?php

namespace Modules\Frontend\BankAccount\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\BankAccount\Dto\BankAccountViewDto;

final class BankAccountViewRequest extends FormRequest
{
    public function rules(): array
    {

        return [
            //
        ];
    }

    public function toDto(): BankAccountViewDto
    {

        return new BankAccountViewDto(

        );
    }
}
