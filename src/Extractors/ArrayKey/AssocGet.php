<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors\ArrayKey;

use N1215\RequestParameterExtractor\AssocExtractorInterface;

/**
 * @mixin AssocExtractorInterface
 */
trait AssocGet
{
    /**
     * @param string $key
     * @return FromAssoc
     */
    public function get(string $key): FromAssoc
    {
        return new FromAssoc($this, $key);
    }
}
