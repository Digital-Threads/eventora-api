<?php

namespace Modules\Company\Repositories\Interfaces;

use Infrastructure\Eloquent\Models\Company;
use Modules\Company\Dto\CompanyViewRequestDto;

interface CompanyQueryRepositoryInterface
{
    /**
     *
     */
    public function view(CompanyViewRequestDto $dto): Company;
}
