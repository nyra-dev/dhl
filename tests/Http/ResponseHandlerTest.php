<?php

namespace Nyra\Internetmarke\Tests\Http;

use GuzzleHttp\Psr7\Response;
use Nyra\Dhl\Http\ApiException;
use Nyra\Dhl\Http\ResponseHandler;
use PHPUnit\Framework\TestCase;

final class ResponseHandlerTest extends TestCase
{
    public function testSuccessfulResponsesAreDecoded(): void
    {
        $data = ResponseHandler::decodeOrThrow(new Response(200, [], '{"shopOrderId":"1234567"}'));

        $this->assertSame(['shopOrderId' => '1234567'], $data);
    }

    public function testInternetmarkeErrorsUseTheirDescription(): void
    {
        $e = $this->thrown(new Response(400, [], json_encode([
            'statusCode' => '400',
            'title' => 'Bad Request',
            'description' => 'Voucher not refundable',
        ])));

        $this->assertSame('Voucher not refundable', $e->getMessage());
        $this->assertSame(400, $e->statusCode);
        $this->assertSame(400, $e->getCode());
        $this->assertSame('400', $e->error?->statusCode);
        $this->assertSame('Bad Request', $e->error?->title);
    }

    public function testProblemDetailsUseTheirDetail(): void
    {
        $e = $this->thrown(new Response(401, [], json_encode([
            'type' => 'about:blank',
            'title' => 'Unauthorized',
            'status' => 401,
            'detail' => 'The access token is invalid.',
        ])));

        $this->assertSame('The access token is invalid.', $e->getMessage());
        $this->assertSame('401', $e->error?->statusCode);
        $this->assertSame('Unauthorized', $e->error?->title);
        $this->assertSame('The access token is invalid.', $e->error?->description);
    }

    public function testOAuthErrorsUseTheirErrorDescription(): void
    {
        $e = $this->thrown(new Response(400, [], json_encode([
            'error' => 'invalid_grant',
            'error_description' => 'Invalid username or password.',
        ])));

        $this->assertSame('Invalid username or password.', $e->getMessage());
        $this->assertSame('invalid_grant', $e->error?->title);
    }

    public function testAnEmptyDescriptionFallsBackToTheTitle(): void
    {
        $e = $this->thrown(new Response(409, [], json_encode([
            'statusCode' => '409',
            'title' => 'Conflict',
            'description' => '',
        ])));

        $this->assertSame('Conflict', $e->getMessage());
    }

    public function testAJsonBodyWithoutKnownFieldsBecomesTheMessage(): void
    {
        $e = $this->thrown(new Response(400, [], '{"hint":"contact support"}'));

        $this->assertSame('{"hint":"contact support"}', $e->getMessage());
        $this->assertSame('{"hint":"contact support"}', $e->body);
    }

    public function testAnErrorBodyThatIsNotJsonKeepsTheStatus(): void
    {
        $e = $this->thrown(new Response(503, [], "<html><body><h1>Service\n  Unavailable</h1></body></html>"));

        $this->assertSame('Service Unavailable', $e->getMessage());
        $this->assertSame(503, $e->statusCode);
        $this->assertNull($e->error);
        $this->assertStringContainsString('<h1>', (string) $e->body);
    }

    public function testALongBodyIsShortened(): void
    {
        $e = $this->thrown(new Response(502, [], str_repeat('ä', 300)));

        $this->assertSame(str_repeat('ä', 200).'…', $e->getMessage());
    }

    public function testAnEmptyErrorBodyStillHasAMessage(): void
    {
        $e = $this->thrown(new Response(500));

        $this->assertSame('API error (HTTP 500)', $e->getMessage());
        $this->assertNull($e->error);
        $this->assertSame('', $e->body);
    }

    public function testAnExplicitMessageWins(): void
    {
        $e = new ApiException(400, null, 'Custom message');

        $this->assertSame('Custom message', $e->getMessage());
        $this->assertNull($e->body);
    }

    private function thrown(Response $response): ApiException
    {
        try {
            ResponseHandler::decodeOrThrow($response);
        } catch (ApiException $e) {
            return $e;
        }

        $this->fail('No ApiException was thrown.');
    }
}
