<?php

namespace Modules\Frontend\CompanyType\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\CompanyType\Dto\CompanyTypeViewDto;

final class CompanyTypeViewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): CompanyTypeViewDto
    {
        return new CompanyTypeViewDto();
    }
}
