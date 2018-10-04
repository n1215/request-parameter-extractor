<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\StringExtractorInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class FromRequestTarget
 * @package N1215\RequestParameterExtractor\Extractors
 */
class FromRequestTarget implements StringExtractorInterface
{
    use Mappable;

    /**
     * @param ServerRequestInterface $request
     * @return string
     */
    public function extract(ServerRequestInterface $request): string
    {
        return $request->getRequestTarget();
    }
}
