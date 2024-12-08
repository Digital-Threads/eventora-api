<?php

namespace Modules\Auth\AuthGoogle\Services;

use Domain\SocialProvider\Repositories\SocialProviderCommandRepositoryInterface;
use Domain\SocialProvider\Repositories\SocialProviderQueryRepositoryInterface;
use Domain\User\Repositories\UserQueryRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Modules\Auth\AuthGoogle\Dto\AuthGoogleForgetDto;
use Modules\Auth\AuthGoogle\Dto\AuthGoogleLinkDto;
use Infrastructure\Socialite\Google\GoogleUserProvider;

final class AuthGoogleCommandService
{
    public function __construct(
        private readonly GoogleUserProvider $google,
        private readonly SocialProviderCommandRepositoryInterface $socialProviderCommandRepository,
        private readonly SocialProviderQueryRepositoryInterface $socialProviderQueryRepository,
        private readonly UserQueryRepositoryInterface $userQueryRepository,
    ) {}

    public function link(AuthGoogleLinkDto $request): void
    {
        DB::transaction(function () use ($request): void {
            $user = $this->userQueryRepository->findById($request->userId);
            $source = $this->google->request($request->token);

            if ($this->socialProviderQueryRepository->findByProviderId($source->id)) {
                throw new AuthorizationException('This Google account is already linked.');
            }

            $this->socialProviderCommandRepository->linkProvider($user->id, 'google', $source->id);

            Event::dispatch('auth_google.linked', [$user->id]);
        });
    }

    public function forget(AuthGoogleForgetDto $request): void
    {
        DB::transaction(function () use ($request): void {
            $user = $this->userQueryRepository->findById($request->userId);

            $this->socialProviderCommandRepository->unlinkProvider($user->id, 'google');

            Event::dispatch('auth_google.forgot', [$user->id]);
        });
    }
}
