<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use PHPUnit\Framework\TestCase;
use Zend\Diactoros\ServerRequestFactory;

class IdentityTest extends TestCase
{
    public function test_extract_returns_same_request(): void
    {
        $extractor = new Identity();
        $request = (new ServerRequestFactory)
            ->createServerRequest('GET', 'https://example.com');

        $result = $extractor->extract($request);

        $this->assertSame($request, $result);
    }
}
