<?php

namespace Modules\Frontend\Dashboard\Event\Dto;

final class EventDeleteRequestDto
{
    public function __construct(public readonly int $id)
    {
    }
}
