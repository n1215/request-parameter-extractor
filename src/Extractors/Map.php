<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\CastableExtractorInterface;
use N1215\RequestParameterExtractor\ExtractorInterface;
use N1215\RequestParameterExtractor\Extractors\Typed\Cast;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class Map
 * @package N1215\RequestParameterExtractor\Extractors
 */
class Map implements CastableExtractorInterface
{
    use HighOrder;
    use Cast;

    /**
     * @var ExtractorInterface
     */
    private $original;

    /**
     * @var callable
     */
    private $callback;

    public function __construct(ExtractorInterface $original, callable $callback)
    {
        $this->original = $original;
        $this->callback = $callback;
    }

    public function extract(ServerRequestInterface $request)
    {
        return \call_user_func($this->callback, $this->original->extract($request));
    }
}