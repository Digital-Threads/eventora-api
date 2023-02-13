<?php

namespace Modules\AuthProfile\Services;

use Infrastructure\Eloquent\Models\User;
use Modules\AuthProfile\Dto\AuthProfileViewDto;

final class AuthProfileQueryService
{
    public function view(AuthProfileViewDto $request): User
    {
        $user = User::findOrFail($request->userId);
        return $user->load('ownCompanies');
    }
}
