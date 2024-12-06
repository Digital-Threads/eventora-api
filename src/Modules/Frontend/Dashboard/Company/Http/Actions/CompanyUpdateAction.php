<?php

namespace Modules\Frontend\Dashboard\Company\Http\Actions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\Frontend\Dashboard\Company\Checks\UserCanUpdateCompanyCheck;
use Modules\Frontend\Dashboard\Company\Dto\CompanyViewRequestDto;
use Modules\Frontend\Dashboard\Company\Http\Requests\CompanyUpdateRequest;
use Modules\Frontend\Dashboard\Company\Http\Resources\CompanyResource;
use Modules\Frontend\Dashboard\Company\Services\CompanyCommandService;
use Modules\Frontend\Dashboard\Company\Services\CompanyQueryService;

final class CompanyUpdateAction
{
    use AuthorizesRequests;

    /**
     * @OA\Put(
     *     path="/companies/{id}",
     *     tags={"Companies"},
     *     description="Обновление компании по ID",
     *     security={{"passport": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID компании"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CompanySchema")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Компания успешно обновлена",
     *         @OA\JsonContent(ref="#/components/schemas/CompanySchema")
     *     )
     * )
     * @throws AuthorizationException
     */
    public function __invoke(
        CompanyUpdateRequest $request,
        CompanyCommandService $commandService,
        CompanyQueryService $queryService,
        $id
    ): CompanyResource {
        $company = $queryService->view(new CompanyViewRequestDto($id));

        $this->authorize(UserCanUpdateCompanyCheck::class, $company);

        $dto = $request->toDto();
        $updatedCompany = $commandService->update($company->id, $dto);

        return new CompanyResource($updatedCompany);
    }
}
