<?php

namespace Tests\Infrastructure\Http\Macros;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Infrastructure\AbstractInfrastructureTestCase as TestCase;

final class ErrorMacroTest extends TestCase
{
    use WithFaker;

    public function testJsonResponseWithErrorsAnd_400StatusCode(): void
    {
        /** @var JsonResponse $response */
        $response = response()->error(
            $error = $this->faker->slug(),
            $errorDescription = $this->faker->text(),
            $message = $this->faker->slug(),
            $hint = $this->faker->text(),
        );

        $body = $response->getData();

        $this->assertObjectHasAttribute('error', $body);
        $this->assertObjectHasAttribute('errorDescription', $body);
        $this->assertObjectHasAttribute('message', $body);
        $this->assertObjectHasAttribute('hint', $body);

        $this->assertEquals($error, $body->error);
        $this->assertEquals($errorDescription, $body->errorDescription);
        $this->assertEquals($message, $body->message);
        $this->assertEquals($hint, $body->hint);

        $this->assertEquals(JsonResponse::HTTP_BAD_REQUEST, $response->status());
    }
}
