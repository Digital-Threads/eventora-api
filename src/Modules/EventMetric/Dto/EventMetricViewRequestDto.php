<?php

namespace Modules\EventMetric\Dto;

final class EventMetricViewRequestDto
{
    public function __construct(
        public int $eventId
    ) {}
}
