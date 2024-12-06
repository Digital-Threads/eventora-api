<?php

namespace Modules\Frontend\Dashboard\Company\Repositories\Interfaces;

use Infrastructure\Eloquent\Models\Company;
use Modules\Frontend\Dashboard\Company\Dto\CompanyCreateRequestDto;
use Modules\Frontend\Dashboard\Company\Dto\CompanyDeleteRequestDto;
use Modules\Frontend\Dashboard\Company\Dto\CompanyUpdateRequestDto;

interface CompanyCommandRepositoryInterface
{
    /**
     *
     */
    public function create(CompanyCreateRequestDto $dto): Company;

    /**
     *
     */
    public function update(int $id, CompanyUpdateRequestDto $dto): Company;

    /**
     *
     */
    public function delete(CompanyDeleteRequestDto $dto): void;
}
