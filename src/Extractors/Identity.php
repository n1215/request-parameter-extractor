<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\ExtractorInterface;
use Psr\Http\Message\ServerRequestInterface;

class Identity implements ExtractorInterface
{
    use HighOrder;

    public function extract(ServerRequestInterface $request): ServerRequestInterface
    {
        return $request;
    }
}
