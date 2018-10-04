<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\IExtractor;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class FromQueryParam
 * @package N1215\RequestParameterExtractor\Extractors
 */
class FromQueryParam implements IExtractor
{
    use TypedValue;

    /**
     * @var string
     */
    private $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * @param ServerRequestInterface $request
     * @return string|array|null
     */
    public function extract(ServerRequestInterface $request)
    {
        $params = $request->getQueryParams();

        if (!array_key_exists($this->key, $params)) {
            return null;
        }

        return $params[$this->key];
    }
}
