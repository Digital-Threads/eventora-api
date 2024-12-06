<?php

namespace Modules\Frontend\Dashboard\Company\Services;

use Infrastructure\Eloquent\Models\Company;
use Modules\Frontend\Dashboard\Company\Dto\CompanyCreateRequestDto;
use Modules\Frontend\Dashboard\Company\Dto\CompanyDeleteRequestDto;
use Modules\Frontend\Dashboard\Company\Dto\CompanyUpdateRequestDto;
use Modules\Frontend\Dashboard\Company\Repositories\Interfaces\CompanyCommandRepositoryInterface;

class CompanyCommandService
{
    /**
     */
    protected CompanyCommandRepositoryInterface $companyCommandRepository;

    /**
     */
    public function __construct(CompanyCommandRepositoryInterface $companyCommandRepository)
    {
        $this->companyCommandRepository = $companyCommandRepository;
    }

    /**
     *
     */
    public function create(CompanyCreateRequestDto $dto): Company
    {
        return $this->companyCommandRepository->create($dto);
    }

    /**
     *
     */
    public function update(int $id, CompanyUpdateRequestDto $dto): Company
    {
        return $this->companyCommandRepository->update($id, $dto);
    }

    /**
     *
     */
    public function delete(CompanyDeleteRequestDto $dto): void
    {
        $this->companyCommandRepository->delete($dto);
    }
}
