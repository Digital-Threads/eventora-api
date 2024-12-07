<?php

namespace Infrastructure\Eloquent\Repositories\Company;

use Domain\Company\Repositories\CompanyQueryRepositoryInterface;
use Infrastructure\Eloquent\Models\Company;
use Modules\Frontend\Dashboard\Company\Dto\CompanyViewRequestDto;

class EloquentCompanyQueryRepository implements CompanyQueryRepositoryInterface
{
    /**
     *
     */
    public function view(CompanyViewRequestDto $dto): Company
    {
        return Company::query()->findOrFail($dto->id);
    }
}
