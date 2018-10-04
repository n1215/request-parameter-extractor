<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors\ArrayKey;

use N1215\RequestParameterExtractor\ArrayExtractorInterface;

/**
 * @mixin ArrayExtractorInterface
 */
trait ArrayGet
{
    /**
     * @param int $index
     * @return FromArray
     */
    public function get(int $index): FromArray
    {
        return new FromArray($this, $index);
    }
}
