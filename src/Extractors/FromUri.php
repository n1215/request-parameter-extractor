<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\NullableIntExtractorInterface;
use N1215\RequestParameterExtractor\StringExtractorInterface;
use N1215\RequestParameterExtractor\UriExtractorInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class FromUri
 * @package N1215\RequestParameterExtractor\Extractors
 */
class FromUri implements UriExtractorInterface
{
    use HighOrder;

    /**
     * @param ServerRequestInterface $request
     * @return UriInterface
     */
    public function extract(ServerRequestInterface $request): UriInterface
    {
        return $request->getUri();
    }

    public function getScheme(): StringExtractorInterface
    {
        return $this->bind(function (UriInterface $uri) {
            return $uri->getScheme();
        })->asString();
    }

    public function getAuthority(): StringExtractorInterface
    {
        return $this->bind(function (UriInterface $uri) {
            return $uri->getAuthority();
        })->asString();
    }

    public function getUserInfo(): StringExtractorInterface
    {
        return $this->bind(function (UriInterface $uri) {
            return $uri->getUserInfo();
        })->asString();
    }

    public function getHost(): StringExtractorInterface
    {
        return $this->bind(function (UriInterface $uri) {
            return $uri->getHost();
        })->asString();
    }

    public function getPort(): NullableIntExtractorInterface
    {
        return $this->bind(function (UriInterface $uri) {
            return $uri->getPort();
        })->asNullableInt();
    }

    public function getPath(): StringExtractorInterface
    {
        return $this->bind(function (UriInterface $uri) {
            return $uri->getPath();
        })->asString();
    }

    public function getQuery(): StringExtractorInterface
    {
        return $this->bind(function (UriInterface $uri) {
            return $uri->getQuery();
        })->asString();
    }

    public function getFragment(): StringExtractorInterface
    {
        return $this->bind(function (UriInterface $uri) {
            return $uri->getFragment();
        })
        ->asString();
    }

    public function toString(): StringExtractorInterface
    {
        return $this->bind(function (UriInterface $uri) {
            return $uri->__toString();
        })->asString();
    }
}
