<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors\Typed;

use N1215\RequestParameterExtractor\ExtractorInterface;
use N1215\RequestParameterExtractor\Extractors\HighOrder;
use N1215\RequestParameterExtractor\NullableIntExtractorInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AsNullableInt
 * @package N1215\RequestParameterExtractor\Extractors\Typed
 */
class AsNullableInt implements NullableIntExtractorInterface
{
    use HighOrder;

    /** @var ExtractorInterface */
    private $original;

    public function __construct(ExtractorInterface $original)
    {
        $this->original = $original;
    }

    public function extract(ServerRequestInterface $request): ?int
    {
        $value = $this->original->extract($request);

        if ($value === null) {
            return null;
        }

        return (int) $value;
    }
}
