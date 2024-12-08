<?php

namespace Modules\Auth\AuthProfile\Services;


use Domain\User\Repositories\UserCommandRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Modules\Auth\AuthProfile\Dto\AuthProfileUpdateDto;

final class AuthProfileCommandService
{

    public function __construct(private readonly UserCommandRepositoryInterface $userCommandRepository,) {}

    public function update(AuthProfileUpdateDto $request): void
    {
        DB::transaction(static function () use ($request): void {
            $user = $this->userCommandRepository->update($request->userId, [
                'first_name' => $request->firstName,
                'last_name'  => $request->lastName,
            ]);

            Event::dispatch('auth_profile.updated', [$user->id]);
        });
    }
}
