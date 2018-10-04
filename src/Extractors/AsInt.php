<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\IExtractor;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AsInt
 * @package N1215\RequestParameterExtractor\Extractors
 */
class AsInt implements IExtractor
{
    use Mappable;

    /** @var IExtractor */
    private $original;

    /** @var int|null */
    private $default;

    public function __construct(IExtractor $original, int $default = null)
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
