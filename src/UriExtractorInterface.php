<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;

interface UriExtractorInterface extends ExtractorInterface
{
    public function extract(ServerRequestInterface $request): UriInterface;

    public function getScheme(): StringExtractorInterface;

    public function getAuthority(): StringExtractorInterface;

    public function getUserInfo(): StringExtractorInterface;

    public function getHost(): StringExtractorInterface;

    public function getPort(): NullableIntExtractorInterface;

    public function getPath(): StringExtractorInterface;

    public function getQuery(): StringExtractorInterface;

    public function getFragment(): StringExtractorInterface;

    public function toString(): StringExtractorInterface;
}
