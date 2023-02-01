<?php

namespace Tests\Integration\Http;

use Tests\Integration\AbstractIntegrationTestCase as TestCase;

final class IndexRouteTest extends TestCase
{
    public function testIndexRouteNotFound(): void
    {
        $this
            ->get('/')
            ->assertNotFound()
            ->assertJsonPath('error', 'not_found');
    }
}
