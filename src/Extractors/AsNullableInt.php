<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\IExtractor;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AsNullableInt
 * @package N1215\RequestParameterExtractor\Extractors
 */
class AsNullableInt implements IExtractor
{
    use Mappable;

    /** @var IExtractor */
    private $original;

    public function __construct(IExtractor $original)
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
