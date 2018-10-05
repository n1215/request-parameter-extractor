<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor;

use Psr\Http\Message\ServerRequestInterface;

interface ExtractorInterface
{
    public function bind(callable $callback): CastableExtractorInterface;

    public function filter(callable $callback): CastableExtractorInterface;

    public function extract(ServerRequestInterface $request);
}
