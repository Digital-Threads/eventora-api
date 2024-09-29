<?php

namespace Modules\Event\Dto;

final class EventDeleteRequestDto
{
    public function __construct(public readonly int $id) {}
}
