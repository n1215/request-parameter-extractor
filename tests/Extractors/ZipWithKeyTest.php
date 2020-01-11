<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use PHPUnit\Framework\TestCase;
use Laminas\Diactoros\ServerRequestFactory;

class ZipWithKeyTest extends TestCase
{
    public function test_extract_returns_zipped_value(): void
    {
        $extractor = new ZipWithKey([
            'method' => new FromMethod(),
            'protocol_version' => new FromProtocolVersion(),
            'attribute' => new FromAttribute('attr_key')
        ]);

        $request = (new ServerRequestFactory)
            ->createServerRequest('GET', 'https://example.com')
            ->withProtocolVersion('1.1')
            ->withAttribute('attr_key', 'attr_value');

        $result = $extractor->extract($request);
        $expected = [
            'method' => 'GET',
            'protocol_version' => '1.1',
            'attribute' => 'attr_value',
        ];

        $this->assertEquals($expected, $result);
    }
}
