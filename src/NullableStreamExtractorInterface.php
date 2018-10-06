<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;

interface NullableStreamExtractorInterface extends ExtractorInterface
{
    public function extract(ServerRequestInterface $request): ?StreamInterface;

    public function toString(): NullableStringExtractorInterface;

    public function getSize(): NullableIntExtractorInterface;

    public function getMetaData($key = null): ExtractorInterface;
}
