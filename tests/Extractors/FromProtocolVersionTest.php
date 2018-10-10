<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use PHPUnit\Framework\TestCase;
use Zend\Diactoros\ServerRequestFactory;

class FromProtocolVersionTest extends TestCase
{
    /**
     * @param string $expected
     * @param string $protocolVersion
     * @dataProvider dataProvider_methods
     */
    public function test_extract_returns_method(string $expected, string $protocolVersion): void
    {
        $extractor = new FromProtocolVersion();
        $request = (new ServerRequestFactory)
            ->createServerRequest('GET', 'https://example.com')
            ->withProtocolVersion($protocolVersion);

        $result = $extractor->extract($request);

        $this->assertEquals($expected, $result);
    }

    public function dataProvider_methods(): array
    {
        return [
            ['1.0', '1.0'],
            ['1.1', '1.1'],
            ['2', '2'],
        ];
    }
}
