<?php

namespace Modules\Auth\AuthProfile\Services;


use Domain\User\Repositories\UserQueryRepositoryInterface;
use Infrastructure\Eloquent\Models\User;
use Modules\Auth\AuthProfile\Dto\AuthProfileViewDto;

final readonly class AuthProfileQueryService
{
    public function __construct(private UserQueryRepositoryInterface $userQueryRepository) {}

    public function view(AuthProfileViewDto $request): User
    {
        return $this->userQueryRepository->findById($request->userId);
    }
}
