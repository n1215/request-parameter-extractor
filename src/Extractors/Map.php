<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\IExtractor;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class Map
 * @package N1215\RequestParameterExtractor\Extractors
 */
class Map implements IExtractor
{
    /**
     * @var IExtractor
     */
    private $original;

    /**
     * @var callable
     */
    private $callback;

    public function __construct(IExtractor $original, callable $callback)
    {
        $this->original = $original;
        $this->callback = $callback;
    }

    public function extract(ServerRequestInterface $request)
    {
        return call_user_func($this->callback, $this->original->extract($request));
    }
}