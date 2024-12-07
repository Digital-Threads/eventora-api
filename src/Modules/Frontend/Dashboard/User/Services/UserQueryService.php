<?php

namespace Modules\Frontend\Dashboard\User\Services;

use Domain\User\Repositories\UserQueryRepositoryInterface;
use Infrastructure\Eloquent\Models\User;
use Modules\Frontend\Dashboard\User\Dto\UserViewRequestDto;

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
