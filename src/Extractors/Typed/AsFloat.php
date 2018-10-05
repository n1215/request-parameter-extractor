<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors\Typed;

use N1215\RequestParameterExtractor\ExtractorInterface;
use N1215\RequestParameterExtractor\Extractors\HighOrder;
use N1215\RequestParameterExtractor\FloatExtractorInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AsFloat
 * @package N1215\RequestParameterExtractor\Extractors\Typed
 */
class AsFloat implements FloatExtractorInterface
{
    use HighOrder;

    /** @var ExtractorInterface */
    private $original;

    /** @var float|null */
    private $default;

    public function __construct(ExtractorInterface $original, float $default = null)
    {
        $this->original = $original;
        $this->default = $default;
    }

    public function extract(ServerRequestInterface $request): float
    {
        $value = $this->original->extract($request);

        if ($value === null) {
            if ($this->default !== null) {
                return $this->default;
            }

            throw new \UnexpectedValueException('set default value');
        }

        return (float) $value;
    }
}
