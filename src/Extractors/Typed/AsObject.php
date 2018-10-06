<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors\Typed;

use N1215\RequestParameterExtractor\ExtractorInterface;
use N1215\RequestParameterExtractor\Extractors\HighOrder;
use N1215\RequestParameterExtractor\ObjectExtractorInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AsObject
 * @package N1215\RequestParameterExtractor\Extractors\Typed
 */
class AsObject implements ObjectExtractorInterface
{
    use HighOrder;

    /** @var ExtractorInterface */
    private $original;

    /** @var int|null */
    private $default;

    public function __construct(ExtractorInterface $original, object $default = null)
    {
        $this->original = $original;
        $this->default = $default;
    }

    public function extract(ServerRequestInterface $request): object
    {
        $value = $this->original->extract($request);

        if ($value === null) {
            if ($this->default !== null) {
                return $this->default;
            }

            throw new \UnexpectedValueException('set default value');
        }

        return (object) $value;
    }
}
