<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\IExtractor;

/**
 * @mixin IExtractor
 */
trait Mappable
{
    public function map(callable $callback): Map
    {
        return new Map($this, $callback);
    }
}