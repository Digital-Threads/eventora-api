<?php

namespace Modules\Company\Repositories\Interfaces;

use Modules\Company\Dto\CompanyCreateRequestDto;
use Modules\Company\Dto\CompanyUpdateRequestDto;
use Modules\Company\Dto\CompanyDeleteRequestDto;
use Infrastructure\Eloquent\Models\Company;

interface CompanyCommandRepositoryInterface
{
    /**
     * @param CompanyCreateRequestDto $dto
     *
     * @return Company
     */
    public function create(CompanyCreateRequestDto $dto): Company;

    /**
     * @param int                     $id
     * @param CompanyUpdateRequestDto $dto
     *
     * @return Company
     */
    public function update(int $id, CompanyUpdateRequestDto $dto): Company;

    /**
     * @param CompanyDeleteRequestDto $dto
     *
     * @return void
     */
    public function delete(CompanyDeleteRequestDto $dto): void;
}
