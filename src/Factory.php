<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor;

use N1215\RequestParameterExtractor\Extractors;

/**
 * Class Factory
 * @package N1215\RequestParameterExtractor
 */
class Factory
{
    public function fromBody(): BodyExtractorInterface
    {
        return new Extractors\FromBody();
    }

    public function fromCookieParams(): AssocExtractorInterface
    {
        return new Extractors\FromCookieParams();
    }

    public function fromHeader(string $name): ArrayExtractorInterface
    {
        return new Extractors\FromHeader($name);
    }

    public function fromHeaderLine(string $name): StringExtractorInterface
    {
        return new Extractors\FromHeaderLine($name);
    }

    public function fromHeaders(): AssocExtractorInterface
    {
        return new Extractors\FromHeaders();
    }

    public function fromMethod(): StringExtractorInterface
    {
        return new Extractors\FromMethod();
    }

    public function fromProtocolVersion(): StringExtractorInterface
    {
        return new Extractors\FromProtocolVersion();
    }

    public function fromQueryParams(): AssocExtractorInterface
    {
        return new Extractors\FromQueryParams();
    }

    public function fromRequestTarget(): StringExtractorInterface
    {
        return new Extractors\FromRequestTarget();
    }

    public function fromUri(): UriExtractorInterface
    {
        return new Extractors\FromUri();
    }

    public function bind(callable $callback): CastableExtractorInterface
    {
        return new Extractors\Bind(new Extractors\Identity(), $callback);
    }

    public function filter(callable $callback): CastableExtractorInterface
    {
        return new Extractors\Filter(new Extractors\Identity(), $callback);
    }

    public function zip(ExtractorInterface ...$extractors): ArrayExtractorInterface
    {
        return new Extractors\Zip(...$extractors);
    }

    /**
     * @param ExtractorInterface[] $extractors
     * @return AssocExtractorInterface
     */
    public function zipWithKey(array $extractors): AssocExtractorInterface
    {
        return new Extractors\ZipWithKey($extractors);
    }
}
