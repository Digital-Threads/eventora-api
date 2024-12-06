<?php

namespace Modules\Frontend\Dashboard\Company\Repositories\Interfaces;

use Infrastructure\Eloquent\Models\Company;
use Modules\Frontend\Dashboard\Company\Dto\CompanyViewRequestDto;

interface CompanyQueryRepositoryInterface
{
    /**
     *
     */
    public function view(CompanyViewRequestDto $dto): Company;
}
