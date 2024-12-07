<?php

namespace Modules\Frontend\Dashboard\Company\Services;

use Infrastructure\Eloquent\Repositories\Company\EloquentCompanyQueryRepository;
use Infrastructure\Eloquent\Models\Company;
use Modules\Frontend\Dashboard\Company\Dto\CompanyViewRequestDto;

class CompanyQueryService
{
    /**
     */
    public function __construct(private readonly EloquentCompanyQueryRepository $companyQueryRepository)
    {
    }

    /**
     *
     */
    public function view(CompanyViewRequestDto $dto): Company
    {
        return $this->companyQueryRepository->view($dto);
    }
}
