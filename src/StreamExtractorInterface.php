<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;

interface StreamExtractorInterface extends ExtractorInterface
{
    public function extract(ServerRequestInterface $request): StreamInterface;

    public function toString(): StringExtractorInterface;

    public function getSize(): NullableIntExtractorInterface;

    public function getMetaData($key = null): CastableExtractorInterface;
}
