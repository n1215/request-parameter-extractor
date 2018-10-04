<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors\ArrayKey;

use N1215\RequestParameterExtractor\AssocExtractorInterface;
use N1215\RequestParameterExtractor\ExtractorInterface;
use N1215\RequestParameterExtractor\Extractors\Mappable;
use N1215\RequestParameterExtractor\Extractors\Typed\Typing;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class FromAssoc
 * @package N1215\RequestParameterExtractor\Extractors
 */
class FromAssoc implements ExtractorInterface
{
    use Typing;
    use Mappable;

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
