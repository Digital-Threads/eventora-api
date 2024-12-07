<?php

namespace Domain\Company\Repositories;

use Infrastructure\Eloquent\Models\Company;
use Modules\Frontend\Dashboard\Company\Dto\CompanyViewRequestDto;

interface CompanyQueryRepositoryInterface
{
    /**
     * @param CompanyViewRequestDto $dto
     *
     * @return Company
     */
    public function view(CompanyViewRequestDto $dto): Company;
}
