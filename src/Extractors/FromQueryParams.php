<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\AssocExtractorInterface;
use N1215\RequestParameterExtractor\Extractors\ArrayKey\AssocGet;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class FromQueryParams
 * @package N1215\RequestParameterExtractor\Extractors
 */
class FromQueryParams implements AssocExtractorInterface
{
    use Mappable;
    use AssocGet;

    /**
     * @param ServerRequestInterface $request
     * @return array
     */
    public function extract(ServerRequestInterface $request): array
    {
        return $request->getQueryParams();
    }
}
