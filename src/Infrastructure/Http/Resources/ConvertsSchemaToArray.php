<?php

namespace Infrastructure\Http\Resources;

use Illuminate\Http\Request;
use Infrastructure\Http\Schemas\AbstractSchema;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

trait ConvertsSchemaToArray
{
    /**
     * @param Request $request
     */
    abstract public function toSchema($request): AbstractSchema;

    public static function schema($resource): ?AbstractSchema
    {
        return $resource ? (new static($resource))->toSchema(request()) : null;
    }

    public static function schemas($collection): ?array
    {
        return collect($collection)->map(static fn ($item) => self::schema($item))->toArray();
    }

    /**
     */
    public static function collection($resource): AnonymousResourceCollection
    {
        return parent::collection($resource);
    }

    /**
     * @param Request $request
     */
    final public function toArray($request): array
    {
        return $this
            ->toSchema($request)
            ->toArray();
    }
}
