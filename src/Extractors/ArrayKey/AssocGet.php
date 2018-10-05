<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors\ArrayKey;

use N1215\RequestParameterExtractor\AssocExtractorInterface;
use N1215\RequestParameterExtractor\CastableExtractorInterface;

/**
 * @mixin AssocExtractorInterface
 */
trait AssocGet
{
    /**
     * @param string $key
     * @return CastableExtractorInterface
     */
    public function get(string $key): CastableExtractorInterface
    {
        return new FromAssoc($this, $key);
    }
}
