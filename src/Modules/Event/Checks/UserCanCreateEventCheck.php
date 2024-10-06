<?php

namespace Infrastructure\Auth\Checks;

use Infrastructure\Auth\Check;
use Infrastructure\Auth\CheckFailure;
use Infrastructure\Auth\CheckResponse;
use App\Models\User;
use Infrastructure\Eloquent\Models\Event;

final class UserCanCreateEventCheck extends Check
{
    public function __construct(private readonly User $user)
    {
        //
    }

    public function execute(): CheckResponse
    {
        // Здесь ваша логика проверки, может ли пользователь создавать события
        // Например, проверка, что пользователь аутентифицирован
        $canCreate = $this->user->is_authenticated;

        return new CheckResponse(
            $canCreate,
            CheckFailure::create($this)
        );
    }
}
