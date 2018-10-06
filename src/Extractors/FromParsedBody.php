<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\CastableExtractorInterface;
use N1215\RequestParameterExtractor\Extractors\Typed\Cast;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class FromParsedBody
 * @package N1215\RequestParameterExtractor\Extractors
 */
class FromParsedBody implements CastableExtractorInterface
{
    use HighOrder;
    use Cast;

    /**
     * @param ServerRequestInterface $request
     * @return array|object|null
     */
    public function extract(ServerRequestInterface $request)
    {
        return $request->getServerParams();
    }
}
