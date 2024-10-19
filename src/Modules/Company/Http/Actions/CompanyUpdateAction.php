<?php

namespace Modules\Company\Http\Actions;

use Modules\Company\Dto\CompanyViewRequestDto;
use Modules\Company\Services\CompanyQueryService;
use Illuminate\Auth\Access\AuthorizationException;
use Modules\Company\Http\Resources\CompanyResource;
use Modules\Company\Services\CompanyCommandService;
use Modules\Company\Checks\UserCanUpdateCompanyCheck;
use Modules\Company\Http\Requests\CompanyUpdateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
