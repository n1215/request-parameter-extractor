<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\IExtractor;

/**
 * @mixin IExtractor
 */
trait TypedValue
{
    public function asInt(int $default = null): AsInt
    {
        return new AsInt($this, $default);
    }

    public function asNullableInt(): AsNullableInt
    {
        return new AsNullableInt($this);
    }
}
