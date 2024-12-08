<?php
namespace Domain\SocialProvider\Repositories;

use Infrastructure\Eloquent\Models\SocialProvider;


interface SocialProviderQueryRepositoryInterface
{
    public function findByProviderId(string $providerId): ?SocialProvider;

    public function findByUserIdAndProviderName(int $userId, string $providerName): ?SocialProvider;
}
