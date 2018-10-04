<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors\Typed;

use N1215\RequestParameterExtractor\ExtractorInterface;
use N1215\RequestParameterExtractor\Extractors\Mappable;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AsNullableFloat
 * @package N1215\RequestParameterExtractor\Extractors\Typed
 */
class AsNullableFloat implements ExtractorInterface
{
    use Mappable;

    /** @var ExtractorInterface */
    private $original;

    public function __construct(ExtractorInterface $original)
    {
        $this->original = $original;
    }

    public function extract(ServerRequestInterface $request): ?float
    {
        $value = $this->original->extract($request);

        if ($value === null) {
            return null;
        }

        return (float) $value;
    }
}
