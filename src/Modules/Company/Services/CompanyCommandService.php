<?php

namespace Modules\Company\Services;


use Infrastructure\Eloquent\Models\Company;
use Modules\Company\Dto\CompanyCreateRequestDto;
use Modules\Company\Dto\CompanyDeleteRequestDto;
use Modules\Company\Dto\CompanyUpdateRequestDto;
use Modules\Company\Repositories\Interfaces\CompanyCommandRepositoryInterface;

class CompanyCommandService
{
    /**
     * @var CompanyCommandRepositoryInterface
     */
    protected CompanyCommandRepositoryInterface $companyCommandRepository;

    /**
     * @param CompanyCommandRepositoryInterface $companyCommandRepository
     */
    public function __construct(CompanyCommandRepositoryInterface $companyCommandRepository)
    {
        $this->companyCommandRepository = $companyCommandRepository;
    }

    /**
     * @param CompanyCreateRequestDto $dto
     *
     * @return Company
     */
    public function create(CompanyCreateRequestDto $dto): Company
    {
        return $this->companyCommandRepository->create($dto);
    }

    /**
     * @param int                     $id
     * @param CompanyUpdateRequestDto $dto
     *
     * @return Company
     */
    public function update(int $id, CompanyUpdateRequestDto $dto): Company
    {
        return $this->companyCommandRepository->update($id, $dto);
    }

    /**
     * @param CompanyDeleteRequestDto $dto
     *
     * @return void
     */
    public function delete(CompanyDeleteRequestDto $dto): void
    {
        $this->companyCommandRepository->delete($dto);
    }
}
