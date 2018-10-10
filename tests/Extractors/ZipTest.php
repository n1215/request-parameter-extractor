<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use PHPUnit\Framework\TestCase;
use Zend\Diactoros\ServerRequestFactory;

class ZipTest extends TestCase
{
    public function test_extract_returns_zipped_value(): void
    {
        $extractor = new Zip(
            new FromMethod(),
            new FromProtocolVersion(),
            new FromAttribute('attr_key')
        );

        $request = (new ServerRequestFactory)
            ->createServerRequest('GET', 'https://example.com')
            ->withProtocolVersion('1.1')
            ->withAttribute('attr_key', 'attr_value');

        $result = $extractor->extract($request);
        $expected = ['GET', '1.1', 'attr_value'];

        $this->assertEquals($expected, $result);
    }
}
