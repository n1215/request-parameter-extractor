<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\ExtractorInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class FromUri
 * @package N1215\RequestParameterExtractor\Extractors
 */
class FromUri implements ExtractorInterface
{
    use Mappable;

    /**
     * @param ServerRequestInterface $request
     * @return UriInterface
     */
    public function extract(ServerRequestInterface $request): UriInterface
    {
        return $request->getUri();
    }
}
