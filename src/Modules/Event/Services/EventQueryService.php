<?php

namespace Modules\Event\Services;

use Domain\Event\Repositories\EventQueryRepositoryInterface;
use Domain\EventMetric\Repositories\EventMetricQueryRepositoryInterface;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Infrastructure\Eloquent\Models\Event;
use Modules\Event\Dto\EventQueryRequestDto;
use Modules\Event\Dto\EventViewRequestDto;

final readonly class EventQueryService
{
    public function __construct(private EventQueryRepositoryInterface $eventQueryRepository, private EventMetricQueryRepositoryInterface $eventMetricQueryRepository) {}

    public function query(EventQueryRequestDto $dto): CursorPaginator
    {
        return $this->eventQueryRepository->query($dto);
    }

    public function view(EventViewRequestDto $dto): Event
    {
        return $this->eventQueryRepository->view($dto);
    }

    public function findPopular(int $perPage, ?string $cursor): CursorPaginator
    {
        $popularEventIds = $this->eventMetricQueryRepository->getPopularEventIds($perPage, $cursor);

        return $this->eventQueryRepository->findPopular($popularEventIds, $perPage, $cursor);
    }

    public function findBetweenDates(string $startDate, string $endDate, int $perPage, ?string $cursor): CursorPaginator
    {
        return $this->eventQueryRepository->findBetweenDates($startDate, $endDate, $perPage, $cursor);
    }

    public function findIncoming(int $perPage, ?string $cursor): CursorPaginator
    {
        return $this->eventQueryRepository->findIncoming($perPage, $cursor);
    }
}
