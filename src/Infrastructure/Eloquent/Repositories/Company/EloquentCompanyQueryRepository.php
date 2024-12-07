<?php

namespace Infrastructure\Eloquent\Repositories\Company;

use Modules\Company\Dto\CompanyViewRequestDto;
use Domain\Company\Repositories\CompanyQueryRepositoryInterface;
use Infrastructure\Eloquent\Models\Company;

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
