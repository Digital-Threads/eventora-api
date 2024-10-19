<?php

namespace Modules\Company\Http\Actions;

use Modules\Company\Http\Resources\CompanyResource;
use Modules\Company\Services\CompanyCommandService;
use Modules\Company\Checks\UserCanCreateCompanyCheck;
use Modules\Company\Http\Requests\CompanyCreateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CompanyCreateAction
{
    use AuthorizesRequests;

    /**
     * @OA\Post(
     *     path="/companies",
     *     tags={"Companies"},
     *     description="Создать новую компанию",
     *     security={{"passport": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CompanyCreateRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Компания создана",
     *         @OA\JsonContent(ref="#/components/schemas/CompanySchema"),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Некорректные данные",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     *     )
     * )
     */
    public function __invoke(CompanyCreateRequest $request, CompanyCommandService $service): CompanyResource
    {
        $this->authorize(UserCanCreateCompanyCheck::class, auth()->user());

        $dto = $request->toDto();
        $company = $service->create($dto);

        return new CompanyResource($company);
    }
}
