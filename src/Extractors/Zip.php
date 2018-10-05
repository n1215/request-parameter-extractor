<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\ArrayExtractorInterface;
use N1215\RequestParameterExtractor\ExtractorInterface;
use N1215\RequestParameterExtractor\Extractors\ArrayKey\ArrayGet;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class Zip
 * @package N1215\RequestParameterExtractor\Extractors
 */
class Zip implements ArrayExtractorInterface
{
    use HighOrder;
    use ArrayGet;

    /**
     * @var ExtractorInterface[]
     */
    private $extractors;

    public function __construct(ExtractorInterface ...$extractors)
    {
        $this->extractors = $extractors;
    }

    public function extract(ServerRequestInterface $request): array
    {
        return array_map(function (ExtractorInterface $extractor) use ($request) {
            return $extractor->extract($request);
        }, $this->extractors);
    }
}
