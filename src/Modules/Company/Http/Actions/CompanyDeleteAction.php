<?php

namespace Modules\Company\Http\Actions;

use Modules\Company\Checks\UserCanDeleteCompanyCheck;
use Modules\Company\Http\Requests\CompanyDeleteRequest;
use Modules\Company\Services\CompanyCommandService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class CompanyDeleteAction
{
    use AuthorizesRequests;

    /**
     * @OA\Delete(
     *     path="/companies/{id}",
     *     tags={"Companies"},
     *     description="Удалить компанию",
     *     security={{"passport": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID компании для удаления"
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Компания успешно удалена",
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Удаление компании не разрешено",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Компания не найдена",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     *     )
     * )
     * @throws AuthorizationException
     */
    public function __invoke(CompanyDeleteRequest $request, CompanyCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $this->authorize(UserCanDeleteCompanyCheck::class, $dto->id);

        $service->delete($dto);

        return response()->json(null, 204);
    }
}
