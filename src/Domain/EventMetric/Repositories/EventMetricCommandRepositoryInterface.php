<?php

namespace Domain\EventMetric\Repositories;

use Infrastructure\Eloquent\Models\EventMetric;

interface EventMetricCommandRepositoryInterface
{
    public function incrementViews(int $eventId): void;

    public function incrementTicketsSold(int $eventId, int $count): void;

    public function incrementSubscriptions(int $eventId, int $count): void;

    public function updateMetrics(int $eventId, array $data): void;


    public function incrementComments(int $eventId, int $count): void;

    public function incrementLikes(int $eventId, int $count): void;

    public function updateRating(int $eventId, float $rating): void;

    public function incrementParticipants(int $eventId, int $count): void;

    public function incrementShares(int $eventId, int $count): void;

}
