<?php

namespace Modules\AuthProfile\Services;

use Infrastructure\Eloquent\Models\User;
use Modules\AuthProfile\Dto\CompanyTypeViewDto;

final class AuthProfileQueryService
{
    public function view(CompanyTypeViewDto $request): User
    {
        return User::findOrFail($request->userId);
    }
}
