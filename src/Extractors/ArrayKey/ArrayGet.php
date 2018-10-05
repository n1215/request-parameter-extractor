<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors\ArrayKey;

use N1215\RequestParameterExtractor\ArrayExtractorInterface;
use N1215\RequestParameterExtractor\CastableExtractorInterface;

/**
 * @mixin ArrayExtractorInterface
 */
trait ArrayGet
{
    /**
     * @param int $index
     * @return CastableExtractorInterface
     */
    public function get(int $index): CastableExtractorInterface
    {
        return new FromArray($this, $index);
    }
}
