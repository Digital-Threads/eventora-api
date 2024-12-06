<?php

namespace Modules\Frontend\Dashboard\Event\Dto;

/**
 *
 */
final class EventViewRequestDto
{
    public function __construct(
        public readonly int $id
    ) {
        //
    }
}
