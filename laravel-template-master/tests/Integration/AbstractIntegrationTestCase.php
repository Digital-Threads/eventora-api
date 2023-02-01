<?php

namespace Tests\Integration;

use Tests\AbstractApplicationTestCase;
use Tests\Utils\Traits\WithSocialiteFake;
use Tests\Utils\Traits\WithSchemaAssertions;

abstract class AbstractIntegrationTestCase extends AbstractApplicationTestCase
{
    use WithSchemaAssertions, WithSocialiteFake;
}
