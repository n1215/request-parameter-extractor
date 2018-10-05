<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors\Typed;

use N1215\RequestParameterExtractor\BoolExtractorInterface;
use N1215\RequestParameterExtractor\ExtractorInterface;
use N1215\RequestParameterExtractor\Extractors\HighOrder;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AsBool
 * @package N1215\RequestParameterExtractor\Extractors\Typed
 */
class AsBool implements BoolExtractorInterface
{
    use HighOrder;

    /** @var ExtractorInterface */
    private $original;

    /** @var float|null */
    private $default;

    public function __construct(ExtractorInterface $original, bool $default = null)
    {
        $this->original = $original;
        $this->default = $default;
    }

    public function extract(ServerRequestInterface $request): bool
    {
        $value = $this->original->extract($request);

        if ($value === null) {
            if ($this->default !== null) {
                return $this->default;
            }

            throw new \UnexpectedValueException('set default value');
        }

        return (bool) $value;
    }
}
