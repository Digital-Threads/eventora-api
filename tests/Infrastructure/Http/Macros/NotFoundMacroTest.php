<?php

namespace Tests\Infrastructure\Http\Macros;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Infrastructure\AbstractInfrastructureTestCase as TestCase;

final class NotFoundMacroTest extends TestCase
{
    use WithFaker;

    public function testJsonResponseNotFoundWithErrorMessageAnd_404StatusCode(): void
    {
        /** @var JsonResponse $response */
        $response = response()->notFound(
            $message = $this->faker->text()
        );

        $body = $response->getData();

        $this->assertObjectHasAttribute('error', $body);
        $this->assertObjectHasAttribute('message', $body);
        $this->assertEquals('not_found', $body->error);
        $this->assertEquals($message, $body->message);
        $this->assertEquals(JsonResponse::HTTP_NOT_FOUND, $response->status());
    }
}
