<?php

namespace Modules\Frontend\BankCard\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\BankCard\Dto\BankCardViewDto;

final class BankCardViewRequest extends FormRequest
{
    public function rules(): array
    {

        return [
            //
        ];
    }

    public function toDto(): BankCardViewDto
    {

        return new BankCardViewDto(

        );
    }
}
