<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\CastableExtractorInterface;
use N1215\RequestParameterExtractor\ExtractorInterface;

/**
 * @mixin ExtractorInterface
 */
trait HighOrder
{
    public function map(callable $callback): CastableExtractorInterface
    {
        return new Map($this, $callback);
    }

    public function filter(callable $callback): CastableExtractorInterface
    {
        return new Filter($this, $callback);
    }
}
