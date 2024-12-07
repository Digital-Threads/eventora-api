<?php

namespace Modules\Company\Services;

use Modules\Company\Dto\CompanyViewRequestDto;
use Infrastructure\Eloquent\Models\Company;
use Infrastructure\Eloquent\Repositories\Company\EloquentCompanyQueryRepository;

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
