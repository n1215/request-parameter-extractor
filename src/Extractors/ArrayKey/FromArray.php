<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors\ArrayKey;

use N1215\RequestParameterExtractor\ArrayExtractorInterface;
use N1215\RequestParameterExtractor\ExtractorInterface;
use N1215\RequestParameterExtractor\Extractors\Mappable;
use N1215\RequestParameterExtractor\Extractors\Typed\Typing;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class FromArray
 * @package N1215\RequestParameterExtractor\Extractors
 */
class FromArray implements ExtractorInterface
{
    use Typing;
    use Mappable;

    /**
     * @var ArrayExtractorInterface
     */
    private $original;

    /**
     * @var int
     */
    private $index;

    public function __construct(ArrayExtractorInterface $original, int $index)
    {
        $this->original = $original;
        $this->index = $index;
    }

    /**
     * @param ServerRequestInterface $request
     * @return mixed|null
     */
    public function extract(ServerRequestInterface $request)
    {
        $array = $this->original->extract($request);

        if (!array_key_exists($this->index, $array)) {
            return null;
        }

        return $array[$this->index];
    }
}
