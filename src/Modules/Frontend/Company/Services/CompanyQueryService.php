<?php

namespace Modules\Frontend\Company\Services;

use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Eloquent\Models\Company;
use Modules\Frontend\Company\Dto\CompanyViewDto;

final class CompanyQueryService
{
    public function view(CompanyViewDto $request): Collection|array
    {
        return Company::where('user_id',auth()->id())->get();
    }
}
