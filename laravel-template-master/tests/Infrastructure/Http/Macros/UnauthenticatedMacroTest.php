<?php

namespace Tests\Infrastructure\Http\Macros;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Infrastructure\AbstractInfrastructureTestCase as TestCase;

final class UnauthenticatedMacroTest extends TestCase
{
    use WithFaker;

    public function testJsonResponseNotFoundWithErrorMessageAnd_401StatusCode(): void
    {
        /** @var JsonResponse $response */
        $response = response()->unauthenticated(
            $message = $this->faker->text()
        );

        $body = $response->getData();

        $this->assertObjectHasAttribute('error', $body);
        $this->assertObjectHasAttribute('message', $body);
        $this->assertEquals('unauthenticated', $body->error);
        $this->assertEquals($message, $body->message);
        $this->assertEquals(JsonResponse::HTTP_UNAUTHORIZED, $response->status());
    }
}
