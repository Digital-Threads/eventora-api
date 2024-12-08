<?php

namespace Modules\Auth\AuthFacebook\Services;

use Domain\SocialProvider\Repositories\SocialProviderCommandRepositoryInterface;
use Domain\SocialProvider\Repositories\SocialProviderQueryRepositoryInterface;
use Domain\User\Repositories\UserQueryRepositoryInterface;
use Modules\Auth\AuthFacebook\Dto\AuthFacebookForgetDto;
use Modules\Auth\AuthFacebook\Dto\AuthFacebookLinkDto;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Infrastructure\Eloquent\Models\User;
use Infrastructure\Socialite\Facebook\FacebookUserProvider;

final class AuthFacebookCommandService
{
    public function __construct(
        private readonly FacebookUserProvider $facebook,
        private readonly SocialProviderCommandRepositoryInterface $socialProviderCommandRepository,
        private readonly SocialProviderQueryRepositoryInterface $socialProviderQueryRepository,
        private readonly UserQueryRepositoryInterface $userQueryRepository
    ) {
        //
    }

    public function link(AuthFacebookLinkDto $request): void
    {
        DB::transaction(function () use ($request): void {
            $user = $this->userQueryRepository->findById($request->userId);
            $source = $this->facebook->request($request->token);

            if ($this->socialProviderQueryRepository->findByProviderId($source->id)) {
                throw new AuthorizationException();
            }

            $this->socialProviderCommandRepository->linkProvider($user->id, 'facebook', $source->id);

            Event::dispatch('auth_facebook.linked', [$user->id]);
        });
    }

    public function forget(AuthFacebookForgetDto $request): void
    {
        DB::transaction(static function () use ($request): void {
            $user = $this->userQueryRepository->findById($request->userId);

            $this->socialProviderCommandRepository->unlinkProvider($user->id, 'facebook');

            Event::dispatch('auth_facebook.forgot', [$user->id]);
        });
    }
}
