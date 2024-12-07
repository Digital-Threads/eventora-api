<?php

namespace Modules\User\Services;

use Modules\User\Dto\UserViewRequestDto;
use Domain\User\Repositories\UserQueryRepositoryInterface;
use Infrastructure\Eloquent\Models\User;

final readonly class UserQueryService
{
    public function __construct(private UserQueryRepositoryInterface $userQueryRepository)
    {
    }

    public function view(UserViewRequestDto $dto): User
    {
        return $this->userQueryRepository->view($dto);
    }
}
