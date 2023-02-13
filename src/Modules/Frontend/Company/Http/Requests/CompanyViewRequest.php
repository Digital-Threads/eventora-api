<?php

namespace Modules\Frontend\Company\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\Company\Dto\CompanyViewDto;

final class CompanyViewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): CompanyViewDto
    {
        return new CompanyViewDto();
    }
}
