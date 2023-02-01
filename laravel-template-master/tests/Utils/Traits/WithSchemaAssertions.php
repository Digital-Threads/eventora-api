<?php

namespace Tests\Utils\Traits;

use Tests\Utils\SchemaAssertions\Finder;

trait WithSchemaAssertions
{
    protected function setUpWithSchemaAssertions(): void
    {
        foreach (Finder::locate() as $assertion) {
            $assertion::bind();
        }
    }
}
