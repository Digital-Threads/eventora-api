<?php

namespace Modules\Company\Http\Actions;

use Modules\Company\Http\Requests\CompanyViewRequest;
use Modules\Company\Http\Resources\CompanyResource;
use Modules\Company\Services\CompanyQueryService;

/**
 * @OA\Get(
 *     path="/companies/{id}",
 *     tags={"Companies"},
 *     description="Просмотр информации о компании",
 *     security={{"passport": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer"),
 *         description="ID компании для просмотра"
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Информация о компании",
 *         @OA\JsonContent(ref="#/components/schemas/CompanySchema"),
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Доступ к компании запрещён",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Компания не найдена",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
 *     )
 * )
 */
class CompanyViewAction
{
    public function __invoke(CompanyViewRequest $request, CompanyQueryService $service): CompanyResource
    {
        $dto = $request->toDto();
        $company = $service->view($dto);

        return new CompanyResource($company);
    }
}
