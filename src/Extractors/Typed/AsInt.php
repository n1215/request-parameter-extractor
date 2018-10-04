<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors\Typed;

use N1215\RequestParameterExtractor\ExtractorInterface;
use N1215\RequestParameterExtractor\Extractors\Mappable;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AsInt
 * @package N1215\RequestParameterExtractor\Extractors\Typed
 */
class AsInt implements ExtractorInterface
{
    use Mappable;

    /** @var ExtractorInterface */
    private $original;

    /** @var int|null */
    private $default;

    public function __construct(ExtractorInterface $original, int $default = null)
    {
        $this->original = $original;
        $this->default = $default;
    }

    public function extract(ServerRequestInterface $request): int
    {
        $value = $this->original->extract($request);

        if ($value === null) {
            if ($this->default !== null) {
                return $this->default;
            }

            throw new \UnexpectedValueException('set default value');
        }

        return (int) $value;
    }
}
