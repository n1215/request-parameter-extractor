<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\AssocExtractorInterface;
use N1215\RequestParameterExtractor\CastableExtractorInterface;
use N1215\RequestParameterExtractor\Extractors\ArrayKey\AssocGet;
use N1215\RequestParameterExtractor\Extractors\Typed\Cast;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class FromAttribute
 * @package N1215\RequestParameterExtractor\Extractors
 */
class FromAttribute implements CastableExtractorInterface
{
    use HighOrder;
    use Cast;

    /**
     * @var string
     */
    private $name;

    /**
     * @var mixed|null
     */
    private $default;

    public function __construct(string $name, $default = null)
    {
        $this->name = $name;
        $this->default = $default;
    }

    public function extract(ServerRequestInterface $request)
    {
        return $request->getAttribute($this->name, $this->default);
    }
}
