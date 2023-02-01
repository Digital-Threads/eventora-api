<?php

namespace Tests\Utils\SchemaAssertions;

use Closure;
use Illuminate\Testing\TestResponse;

abstract class AssertSchema
{
    final public function __construct(
        protected TestResponse $response,
    ) {
        //
    }

    final public static function bind(): void
    {
        $static = static::class;
        $macro = lcfirst(class_basename($static));

        TestResponse::macro($macro, fn (...$args) => (new $static($this))->assert()(...$args)); // phpcs:ignore
        TestResponse::macro("{$macro}Collection", fn (...$args) => (new $static($this))->assertCollection()(...$args)); // phpcs:ignore
    }

    abstract public function assert(): Closure;

    final public function assertCollection(): Closure
    {
        $matcher = $this->assert();

        return function (iterable $collection, string $container = 'data') use ($matcher): TestResponse {
            foreach ($collection as $key => $value) {
                $matcher($value, "{$container}.{$key}");
            }

            return $this->response;
        };
    }
}
