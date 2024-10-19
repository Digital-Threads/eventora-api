<?php

namespace Modules\Company\Services;


use Infrastructure\Eloquent\Models\Company;
use Modules\Company\Dto\CompanyViewRequestDto;
use Modules\Company\Repositories\EloquentCompanyQueryRepository;

class CompanyQueryService
{
    /**
     * @param EloquentCompanyQueryRepository $companyQueryRepository
     */
    public function __construct(private readonly EloquentCompanyQueryRepository $companyQueryRepository) {}

    /**
     * @param CompanyViewRequestDto $dto
     *
     * @return Company
     */
    public function view(CompanyViewRequestDto $dto): Company
    {
        return $this->companyQueryRepository->view($dto);
    }
}
