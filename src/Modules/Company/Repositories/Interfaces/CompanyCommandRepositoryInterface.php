<?php

namespace Modules\Company\Repositories\Interfaces;

use Infrastructure\Eloquent\Models\Company;
use Modules\Company\Dto\CompanyCreateRequestDto;
use Modules\Company\Dto\CompanyDeleteRequestDto;
use Modules\Company\Dto\CompanyUpdateRequestDto;

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
