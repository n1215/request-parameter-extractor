<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor;

use N1215\RequestParameterExtractor\Extractors\FromBody;
use N1215\RequestParameterExtractor\Extractors\FromCookieParams;
use N1215\RequestParameterExtractor\Extractors\FromHeader;
use N1215\RequestParameterExtractor\Extractors\FromHeaderLine;
use N1215\RequestParameterExtractor\Extractors\FromHeaders;
use N1215\RequestParameterExtractor\Extractors\FromMethod;
use N1215\RequestParameterExtractor\Extractors\FromProtocolVersion;
use N1215\RequestParameterExtractor\Extractors\FromQueryParams;
use N1215\RequestParameterExtractor\Extractors\FromRequestTarget;
use N1215\RequestParameterExtractor\Extractors\FromUri;
use N1215\RequestParameterExtractor\Extractors\ToAssoc;

class Factory
{
    public function fromBody(): FromBody
    {
        return new FromBody();
    }

    public function fromCookieParams(): FromCookieParams
    {
        return new FromCookieParams();
    }

    public function fromHeader(string $name): FromHeader
    {
        return new FromHeader($name);
    }

    public function fromHeaderLine(string $name): FromHeaderLine
    {
        return new FromHeaderLine($name);
    }

    public function fromHeaders(): FromHeaders
    {
        return new FromHeaders();
    }

    public function fromMethod(): FromMethod
    {
        return new FromMethod();
    }

    public function fromProtocolVersion(): FromProtocolVersion
    {
        return new FromProtocolVersion();
    }

    public function fromQueryParams(): FromQueryParams
    {
        return new FromQueryParams();
    }

    public function fromRequestTarget(): FromRequestTarget
    {
        return new FromRequestTarget();
    }

    public function fromUri(): FromUri
    {
        return new FromUri();
    }

    /**
     * @param ExtractorInterface[] $extractors
     * @return ToAssoc
     */
    public function assoc(array $extractors): ToAssoc
    {
        return new ToAssoc($extractors);
    }
}
