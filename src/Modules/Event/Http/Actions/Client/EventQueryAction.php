<?php

namespace App\Modules\Event\Http\Actions\Client;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Event\Http\Requests\EventQueryRequest;
use Modules\Event\Http\Resources\ClientEventResource;
use Modules\Event\Services\EventQueryService;

/**
 * @OA\Get(
 *     path="/client/events",
 *     tags={"Client Events"},
 *     summary="Получить предстоящие события",
 *     @OA\Parameter(
 *         name="perPage",
 *         in="query",
 *         required=false,
 *         @OA\Schema(type="integer"),
 *         description="Количество записей на странице"
 *     ),
 *     @OA\Parameter(
 *         name="cursor",
 *         in="query",
 *         required=false,
 *         @OA\Schema(type="string"),
 *         description="Курсор для пагинации"
 *     ),
 *     @OA\Parameter(
 *           name="companyId",
 *           in="query",
 *           required=false,
 *           @OA\Schema(type="integer"),
 *           description="Ид компании"
 *       ),
 *     @OA\Parameter(
 *          name="orderBy",
 *          in="query",
 *          required=false,
 *          @OA\Schema(type="string"),
 *          description="Сортировка"
 *      ),
 *     @OA\Parameter(
 *           name="startDate",
 *           in="query",
 *           required=false,
 *           @OA\Schema(type="string"),
 *           description="Дата начала события"
 *       ),
 *          @OA\Parameter(
 *            name="endDate",
 *            in="query",
 *            required=false,
 *            @OA\Schema(type="string"),
 *            description="Дата конца события"
 *        ),
 *     @OA\Response(
 *         response=200,
 *         description="Успешный ответ",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/ClientEventSchema"))
 *         )
 *     )
 * )
 */
final class EventQueryAction
{
    public function __invoke(EventQueryRequest $request, EventQueryService $service): AnonymousResourceCollection
    {
        $dto = $request->toDto();
        $events = $service->query($dto);

        return ClientEventResource::collection($events);
    }
}
