<?php

namespace Modules\Frontend\Dashboard\Company\Http\Actions;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\Frontend\Dashboard\Company\Http\Resources\CompanyResource;
use Modules\Frontend\Dashboard\Company\Services\CompanyCommandService;
use Modules\Frontend\Dashboard\Company\Checks\UserCanCreateCompanyCheck;
use Modules\Frontend\Dashboard\Company\Http\Requests\CompanyCreateRequest;

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
