<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\AssocExtractorInterface;
use N1215\RequestParameterExtractor\Extractors\ArrayKey\AssocGet;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class FromServerParams
 * @package N1215\RequestParameterExtractor\Extractors
 */
class FromServerParams implements AssocExtractorInterface
{
    use HighOrder;
    use AssocGet;

    /**
     * @param ServerRequestInterface $request
     * @return string[][]
     */
    public function extract(ServerRequestInterface $request): array
    {
        return $request->getServerParams();
    }
}
