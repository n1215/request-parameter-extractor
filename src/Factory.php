<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor;

use N1215\RequestParameterExtractor\Extractors\FromQueryParam;

class Factory
{
    public function fromQueryParam(string $key): FromQueryParam
    {
        return new FromQueryParam($key);
    }
}