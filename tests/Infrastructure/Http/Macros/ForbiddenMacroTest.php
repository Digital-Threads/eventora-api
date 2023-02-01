<?php

namespace Tests\Infrastructure\Http\Macros;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Infrastructure\AbstractInfrastructureTestCase as TestCase;

final class ForbiddenMacroTest extends TestCase
{
    use WithFaker;

    public function testJsonResponseNotFoundWithErrorMessageAnd_403StatusCode(): void
    {
        /** @var JsonResponse $response */
        $response = response()->forbidden(
            $message = $this->faker->text()
        );

        $body = $response->getData();

        $this->assertObjectHasAttribute('error', $body);
        $this->assertObjectHasAttribute('message', $body);
        $this->assertEquals('forbidden', $body->error);
        $this->assertEquals($message, $body->message);
        $this->assertEquals(JsonResponse::HTTP_FORBIDDEN, $response->status());
    }
}
