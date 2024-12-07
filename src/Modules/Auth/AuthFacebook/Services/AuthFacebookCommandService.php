<?php

namespace Modules\Auth\AuthFacebook\Services;

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
    ) {
        //
    }

    public function link(AuthFacebookLinkDto $request): void
    {
        DB::transaction(function () use ($request): void {
            $user = User::findOrFail($request->userId);
            $source = $this->facebook->request($request->token);

            if (User::where('facebook_id', $source->id)->exists()) {
                throw new AuthorizationException();
            }

            $user->update([
                'facebook_id' => $source->id,
            ]);

            Event::dispatch('auth_facebook.linked', [$user->id]);
        });
    }

    public function forget(AuthFacebookForgetDto $request): void
    {
        DB::transaction(static function () use ($request): void {
            $user = User::findOrFail($request->userId);

            $user->update([
                'facebook_id' => null,
            ]);

            Event::dispatch('auth_facebook.forgot', [$user->id]);
        });
    }
}
