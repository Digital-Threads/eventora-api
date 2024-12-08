<?php

namespace Modules\EventMetric\Dto;

final class EventMetricPopularRequestDto
{
    public function __construct(
        public ?int $perPage = 10,
        public ?string $cursor = null
    ) {}
}
