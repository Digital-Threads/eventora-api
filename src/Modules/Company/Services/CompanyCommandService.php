<?php

namespace Modules\Company\Services;

use Modules\Company\Dto\CompanyCreateRequestDto;
use Modules\Company\Dto\CompanyDeleteRequestDto;
use Modules\Company\Dto\CompanyUpdateRequestDto;
use Domain\Company\Repositories\CompanyCommandRepositoryInterface;
use Infrastructure\Eloquent\Models\Company;

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
