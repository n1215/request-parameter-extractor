<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use PHPUnit\Framework\TestCase;
use Laminas\Diactoros\ServerRequestFactory;

class FromMethodTest extends TestCase
{
    /**
     * @param string $expected
     * @param string $method
     * @dataProvider dataProvider_methods
     */
    public function test_extract_returns_method(string $expected, string $method): void
    {
        $extractor = new FromMethod();
        $request = (new ServerRequestFactory)
            ->createServerRequest($method, 'https://example.com');

        $result = $extractor->extract($request);

        $this->assertEquals($expected, $result);
    }

    public function dataProvider_methods(): array
    {
        return [
            ['GET', 'GET'],
            ['HEAD', 'HEAD'],
            ['POST', 'POST'],
            ['PUT', 'PUT'],
            ['DELETE', 'DELETE'],
            ['CONNECT', 'CONNECT'],
            ['OPTIONS', 'OPTIONS'],
            ['TRACE', 'TRACE'],
            ['PATCH', 'PATCH'],
        ];
    }
}
