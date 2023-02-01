<?php

namespace Modules\Example\Services;

use Infrastructure\Eloquent\Models\User;
use Modules\Example\Dto\QueryRequestDto;
use Illuminate\Contracts\Pagination\CursorPaginator;

final class ExampleService
{
    public function query(QueryRequestDto $request): CursorPaginator
    {
        return User::query()->cursorPaginate($request->perPage, cursor: $request->cursor);
    }
}
