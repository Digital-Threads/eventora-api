<?php

namespace Domain\Company\Repositories;

use Modules\Company\Dto\CompanyViewRequestDto;
use Infrastructure\Eloquent\Models\Company;

interface CompanyQueryRepositoryInterface
{
    /**
     * @param CompanyViewRequestDto $dto
     *
     * @return Company
     */
    public function view(CompanyViewRequestDto $dto): Company;
}
