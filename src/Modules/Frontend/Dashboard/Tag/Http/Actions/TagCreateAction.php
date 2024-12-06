<?php

namespace Modules\Frontend\Dashboard\Tag\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Frontend\Dashboard\Tag\Http\Requests\TagCreateRequest;
use Modules\Frontend\Dashboard\Tag\Services\TagCommandService;

/**
 * @OA\Post(
 *      path="/tags",
 *      tags={"Tag"},
 *      description="Create a new tag",
 *      security={{"passport": {}}},
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="name", type="string"),
 *          ),
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Tag created successfully",
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *      ),
 * )
 */
final class TagCreateAction
{
    public function __invoke(TagCreateRequest $request, TagCommandService $service): JsonResponse
    {
        $dto = $request->toDto();
        $service->create($dto);

        return response()->json(['message' => 'Tag created successfully'], 201);
    }
}
