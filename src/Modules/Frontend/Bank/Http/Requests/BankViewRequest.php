<?php

namespace Modules\Frontend\Bank\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\Bank\Dto\BankViewDto;

final class BankViewRequest extends FormRequest
{
    public function rules(): array
    {

        return [
            //
        ];
    }

    public function toDto(): BankViewDto
    {

        return new BankViewDto(

        );
    }
}
