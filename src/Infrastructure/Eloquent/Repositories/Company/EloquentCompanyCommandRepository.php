<?php

namespace Infrastructure\Eloquent\Repositories\Company;

use Domain\Company\Repositories\CompanyCommandRepositoryInterface;
use Infrastructure\Eloquent\Models\Company;
use Modules\Frontend\Dashboard\Company\Dto\CompanyCreateRequestDto;
use Modules\Frontend\Dashboard\Company\Dto\CompanyDeleteRequestDto;
use Modules\Frontend\Dashboard\Company\Dto\CompanyUpdateRequestDto;

class EloquentCompanyCommandRepository implements CompanyCommandRepositoryInterface
{
    public function create(CompanyCreateRequestDto $dto): Company
    {
        return Company::create([
            'name' => $dto->name,
            'slug' => $dto->slug,
            'description' => $dto->description,
            'avatar_url' => $dto->avatarUrl,
            'website_url' => $dto->websiteUrl,
            'activity_description' => $dto->activityDescription,
        ]);
    }

    public function update(int $id, CompanyUpdateRequestDto $dto): Company
    {
        $company = Company::findOrFail($id);
        $company->update([
            'name' => $dto->name,
            'slug' => $dto->slug,
            'description' => $dto->description,
            'avatar_url' => $dto->avatarUrl,
            'website_url' => $dto->websiteUrl,
            'activity_description' => $dto->activityDescription,
        ]);

        return $company;
    }

    public function delete(CompanyDeleteRequestDto $dto): void
    {
        $company = Company::findOrFail($dto->id);
        $company->delete();
    }
}
