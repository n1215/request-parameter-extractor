<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\ExtractorInterface;
use N1215\RequestParameterExtractor\StringExtractorInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class FromMethod
 * @package N1215\RequestParameterExtractor\Extractors
 */
class FromMethod implements StringExtractorInterface
{
    use HighOrder;

    /**
     * @param ServerRequestInterface $request
     * @return string
     */
    public function extract(ServerRequestInterface $request): string
    {
        return $request->getMethod();
    }
}
