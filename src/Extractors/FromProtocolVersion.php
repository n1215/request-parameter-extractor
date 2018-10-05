<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\StringExtractorInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class FromProtocolVersion
 * @package N1215\RequestParameterExtractor\Extractors
 */
class FromProtocolVersion implements StringExtractorInterface
{
    use HighOrder;

    /**
     * @param ServerRequestInterface $request
     * @return string
     */
    public function extract(ServerRequestInterface $request): string
    {
        return $request->getProtocolVersion();
    }
}
