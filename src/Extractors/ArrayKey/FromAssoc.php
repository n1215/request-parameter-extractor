<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors\ArrayKey;

use N1215\RequestParameterExtractor\AssocExtractorInterface;
use N1215\RequestParameterExtractor\CastableExtractorInterface;
use N1215\RequestParameterExtractor\Extractors\HighOrder;
use N1215\RequestParameterExtractor\Extractors\Typed\Cast;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class FromAssoc
 * @package N1215\RequestParameterExtractor\Extractors
 */
class FromAssoc implements CastableExtractorInterface
{
    use Cast;
    use HighOrder;

    /**
     * @var AssocExtractorInterface
     */
    private $original;

    /**
     * @var string
     */
    private $key;

    public function __construct(AssocExtractorInterface $original, string $key)
    {
        $this->original = $original;
        $this->key = $key;
    }

    /**
     * @param ServerRequestInterface $request
     * @return mixed|null
     */
    public function extract(ServerRequestInterface $request)
    {
        $array = $this->original->extract($request);

        if (!array_key_exists($this->key, $array)) {
            return null;
        }

        return $array[$this->key];
    }
}
