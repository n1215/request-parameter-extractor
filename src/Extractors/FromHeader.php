<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\ArrayExtractorInterface;
use N1215\RequestParameterExtractor\Extractors\ArrayKey\ArrayGet;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class FromHeader
 * @package N1215\RequestParameterExtractor\Extractors
 */
class FromHeader implements ArrayExtractorInterface
{
    use HighOrder;
    use ArrayGet;

    /**
     * @var string
     */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param ServerRequestInterface $request
     * @return string[]
     */
    public function Cextract(ServerRequestInterface $request): array
    {
        return $request->getHeader($this->name);
    }
}
