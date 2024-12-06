<?php

namespace Infrastructure\Socialite\Facebook;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Exception\ClientException;
use Laravel\Socialite\Two\FacebookProvider;
use Infrastructure\Socialite\Exceptions\InvalidAccessTokenException;

final class FacebookUserProvider
{
    public function request(string $accessToken): FacebookUser
    {
        return Cache::remember("facebook_user_provider_{$accessToken}", 30, static function () use ($accessToken) {
            try {
                /** @var FacebookProvider $provider */
                $provider = Socialite::driver('facebook');

                $source = $provider->userFromToken($accessToken);

                return new FacebookUser(
                    $source->getId(),
                    $source->getNickname(),
                    $source->getName(),
                    $source->getEmail(),
                    $source->getAvatar(),
                );
            } catch (ClientException $e) {
                $body = json_decode($e->getResponse()->getBody(), true);

                if (Arr::get($body, 'error.code') === 190) {
                    throw new InvalidAccessTokenException(
                        Arr::get($body, 'error.message') ?? $e->getMessage(),
                        $e->getCode(),
                        $e
                    );
                }

                throw $e;
            }
        });
    }
}
