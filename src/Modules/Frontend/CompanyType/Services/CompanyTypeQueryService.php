<?php

namespace Modules\Frontend\CompanyType\Services;

use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Eloquent\Models\CompanyType;
use Modules\Frontend\CompanyType\Dto\CompanyTypeViewDto;

final class CompanyTypeQueryService
{
    public function view(CompanyTypeViewDto $request): Collection|array
    {
        return CompanyType::all();
    }
}
