<?php

namespace Infrastructure\Eloquent\Repositories\SocialProvider;

use Domain\SocialProvider\Repositories\SocialProviderQueryRepositoryInterface;
use Infrastructure\Eloquent\Models\SocialProvider;

class EloquentSocialProviderQueryRepository implements SocialProviderQueryRepositoryInterface
{
    public function findByProviderId(string $providerId): ?SocialProvider
    {
        return SocialProvider::query()->where('provider_id', $providerId)->first();
    }

    public function findByUserIdAndProviderName(int $userId, string $providerName): ?SocialProvider
    {
        return SocialProvider::query()->where('user_id', $userId)
            ->where('provider_name', $providerName)
            ->first();
    }
}
