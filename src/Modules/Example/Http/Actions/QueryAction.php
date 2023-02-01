<?php

namespace Modules\Example\Http\Actions;

use Infrastructure\Auth\Authorize;
use Infrastructure\Auth\Checks\ExampleCheck;
use Modules\Example\Services\ExampleService;
use Modules\Example\Http\Requests\QueryRequest;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Example\Http\Resources\ExampleResource;

final class QueryAction
{
    use Authorize;

    /**
     * @OA\Get(
     *      path="/example",
     *      operationId="example",
     *      tags={"Example"},
     *      security={
     *          {"token": {}},
     *      },
     *      @OA\Parameter(
     *          name="perPage",
     *          @OA\Schema(type="integer"),
     *          in="query",
     *      ),
     *      @OA\Parameter(
     *          name="cursor",
     *          @OA\Schema(type="string"),
     *          in="query",
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\Header(header="x-pagination-per-page", @OA\Schema(type="integer")),
     *          @OA\Header(header="x-pagination-previous", @OA\Schema(type="string", nullable=true)),
     *          @OA\Header(header="x-pagination-next", @OA\Schema(type="string", nullable=true)),
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/ExampleSchema")
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent(type="object", ref="#/components/schemas/ErrorSchema"),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(type="object", ref="#/components/schemas/ErrorSchema"),
     *      ),
     * )
     */
    public function __invoke(QueryRequest $request, ExampleService $service): JsonResource
    {
        $dto = $request->toDto();

        $this->authorize(
            new ExampleCheck(random_int(0, 1)),
        );

        $items = $service->query($dto);

        return ExampleResource::collection($items);
    }
}
