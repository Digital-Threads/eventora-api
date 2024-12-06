<?php

namespace Modules\Frontend\Dashboard\Tag\Http\Actions;

use Infrastructure\Http\Resources\AnonymousResourceCollection;
use Modules\Frontend\Dashboard\Tag\Http\Requests\TagSearchRequest;
use Modules\Frontend\Dashboard\Tag\Http\Resources\TagResource;
use Modules\Frontend\Dashboard\Tag\Services\TagQueryService;

final class TagSearchAction
{
    /**
     * @OA\Get(
     *      path="/tags/search",
     *      tags={"Tag"},
     *      description="Search tags",
     *      security={{"passport": {}}},
     *      @OA\Parameter(
     *          name="query",
     *          in="query",
     *          required=true,
     *          @OA\Schema(type="string"),
     *          description="Search query for tags"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/TagSchema"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No tags found",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="message", type="string", example="No tags found"),
     *          ),
     *      ),
     * )
     */
    public function __invoke(TagSearchRequest $request, TagQueryService $service): AnonymousResourceCollection
    {
        $dto = $request->toDto();
        $tags = $service->search($dto);

        return TagResource::collection($tags);
    }
}
