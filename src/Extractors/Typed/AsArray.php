<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors\Typed;

use N1215\RequestParameterExtractor\ArrayExtractorInterface;
use N1215\RequestParameterExtractor\ExtractorInterface;
use N1215\RequestParameterExtractor\Extractors\ArrayKey\ArrayGet;
use N1215\RequestParameterExtractor\Extractors\HighOrder;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AsArray
 * @package N1215\RequestParameterExtractor\Extractors\Typed
 */
class AsArray implements ArrayExtractorInterface
{
    use HighOrder;
    use ArrayGet;

    /** @var ExtractorInterface */
    private $original;

    /** @var array */
    private $default;

    public function __construct(ExtractorInterface $original, array $default = [])
    {
        $this->original = $original;
        $this->default = $default;
    }

    public function extract(ServerRequestInterface $request): array
    {
        $value = $this->original->extract($request);

        if ($value === null) {
            return $this->default;
        }

        return (array) $value;
    }
}
