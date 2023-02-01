<?php

namespace Infrastructure\Http\Resources;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection as BaseAnonymousResourceCollection;

class AnonymousResourceCollection extends BaseAnonymousResourceCollection
{
    protected function preparePaginatedResponse($request)
    {
        $response = response()->json(
            array_merge(['data' => $this->resource->items()], $this->additional),
        );

        if ($this->resource instanceof CursorPaginator) {
            $response->withHeaders([
                'x-pagination-per-page' => $this->resource->perPage(),
                'x-pagination-previous' => $this->resource->previousCursor()?->encode(),
                'x-pagination-next' => $this->resource->nextCursor()?->encode(),
            ]);
        } elseif ($this->resource instanceof LengthAwarePaginator) {
            $response->withHeaders([
                'x-pagination-per-page' => $this->resource->perPage(),
                'x-pagination-last' => $this->resource->lastPage(),
                'x-pagination-total' => $this->resource->total(),
            ]);
        }

        return $response;
    }
}
