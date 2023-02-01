<?php

namespace Tests\Infrastructure\Http\Macros;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Infrastructure\AbstractInfrastructureTestCase as TestCase;

final class ErrorListMacroTest extends TestCase
{
    use WithFaker;

    public function testJsonResponseWithErrorsAnd_400StatusCode(): void
    {
        /** @var JsonResponse $response */
        $response = response()->errorList(
            $errors = [
                $this->faker->slug(),
                $this->faker->slug(),
            ]
        );

        $body = $response->getData();

        $this->assertObjectHasAttribute('errors', $body);
        $this->assertEqualsCanonicalizing($errors, $body->errors);
        $this->assertEquals(JsonResponse::HTTP_BAD_REQUEST, $response->status());
    }
}
