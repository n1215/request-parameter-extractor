<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\ExtractorInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class FromBody
 * @package N1215\RequestParameterExtractor\Extractors
 */
class FromBody implements ExtractorInterface
{
    use Mappable;

    /**
     * @param ServerRequestInterface $request
     * @return StreamInterface
     */
    public function extract(ServerRequestInterface $request): StreamInterface
    {
        return $request->getBody();
    }
}
