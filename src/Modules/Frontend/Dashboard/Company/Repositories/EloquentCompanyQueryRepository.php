<?php

namespace Modules\Frontend\Dashboard\Company\Repositories;

use Infrastructure\Eloquent\Models\Company;
use Modules\Frontend\Dashboard\Company\Dto\CompanyViewRequestDto;
use Modules\Frontend\Dashboard\Company\Repositories\Interfaces\CompanyQueryRepositoryInterface;

class EloquentCompanyQueryRepository implements CompanyQueryRepositoryInterface
{
    /**
     *
     */
    public function view(CompanyViewRequestDto $dto): Company
    {
        return Company::findOrFail($dto->id);
    }
}
