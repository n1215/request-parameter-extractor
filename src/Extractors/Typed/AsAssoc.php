<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors\Typed;

use N1215\RequestParameterExtractor\AssocExtractorInterface;
use N1215\RequestParameterExtractor\ExtractorInterface;
use N1215\RequestParameterExtractor\Extractors\ArrayKey\AssocGet;
use N1215\RequestParameterExtractor\Extractors\Mappable;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AsAssoc
 * @package N1215\RequestParameterExtractor\Extractors\Typed
 */
class AsAssoc implements AssocExtractorInterface
{
    use Mappable;
    use AssocGet;

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
