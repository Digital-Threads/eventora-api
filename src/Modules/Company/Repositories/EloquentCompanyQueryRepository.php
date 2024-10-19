<?php

namespace Modules\Company\Repositories;


use Infrastructure\Eloquent\Models\Company;
use Modules\Company\Dto\CompanyViewRequestDto;
use Modules\Company\Repositories\Interfaces\CompanyQueryRepositoryInterface;

class EloquentCompanyQueryRepository implements CompanyQueryRepositoryInterface
{
    /**
     * @param CompanyViewRequestDto $dto
     *
     * @return Company
     */
    public function view(CompanyViewRequestDto $dto): Company
    {
        return Company::findOrFail($dto->id);
    }

}
