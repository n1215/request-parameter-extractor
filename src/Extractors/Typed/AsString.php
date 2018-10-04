<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors\Typed;

use N1215\RequestParameterExtractor\ExtractorInterface;
use N1215\RequestParameterExtractor\Extractors\Mappable;
use N1215\RequestParameterExtractor\StringExtractorInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AsString
 * @package N1215\RequestParameterExtractor\Extractors\Typed
 */
class AsString implements StringExtractorInterface
{
    use Mappable;

    /** @var ExtractorInterface */
    private $original;

    /** @var string|null */
    private $default;

    public function __construct(ExtractorInterface $original, string $default = null)
    {
        $this->original = $original;
        $this->default = $default;
    }

    public function extract(ServerRequestInterface $request): string
    {
        $value = $this->original->extract($request);

        if ($value === null) {
            if ($this->default !== null) {
                return $this->default;
            }

            throw new \UnexpectedValueException('set default value');
        }

        return (string) $value;
    }
}
