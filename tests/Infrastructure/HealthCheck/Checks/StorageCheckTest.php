<?php

namespace Tests\Infrastructure\HealthCheck\Checks;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Infrastructure\HealthCheck\Checks\StorageCheck;
use Infrastructure\HealthCheck\Exceptions\CheckFailedException;
use Tests\Infrastructure\AbstractInfrastructureTestCase as TestCase;

final class StorageCheckTest extends TestCase
{
    use WithFaker;

    public function testPutFail(): void
    {
        $e = new Exception($this->faker->uuid());
        $facade = Storage::spy();

        $facade
            ->shouldReceive('put')
            ->once()
            ->andReturnUsing(static function () use ($e) {
                throw $e;
            });

        $check = new StorageCheck();

        $this->expectException(CheckFailedException::class);
        $this->expectExceptionMessage($e->getMessage());

        $check->check();
    }

    public function testGetFail(): void
    {
        $e = new Exception($this->faker->uuid());
        $facade = Storage::spy()->shouldAllowMockingProtectedMethods();

        $facade
            ->shouldReceive('put')
            ->once()
            ->andReturnNull();

        $facade
            ->shouldReceive('get')
            ->once()
            ->andReturnUsing(static function () use ($e) {
                throw $e;
            });

        $check = new StorageCheck();

        $this->expectException(CheckFailedException::class);
        $this->expectExceptionMessage($e->getMessage());

        $check->check();
    }

    public function testGetReturnedWrongContents(): void
    {
        $facade = Storage::spy()->shouldAllowMockingProtectedMethods();

        $facade
            ->shouldReceive('put')
            ->withArgs(['1'])
            ->andReturnNull();

        $facade
            ->shouldReceive('get')
            ->andReturn('0');

        $check = new StorageCheck();

        $this->expectException(CheckFailedException::class);

        $check->check();
    }
}
