<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors\Typed;

use N1215\RequestParameterExtractor\ExtractorInterface;

/**
 * Trait Typing
 * @package N1215\RequestParameterExtractor\Extractors\Typed
 * @mixin ExtractorInterface
 */
trait Typing
{
    public function asArray(array $default = []): AsArray
    {
        return new AsArray($this, $default);
    }

    public function asAssoc(array $default = []): AsAssoc
    {
        return new AsAssoc($this, $default);
    }

    public function asBool(bool $default = null): AsBool
    {
        return new AsBool($this, $default);
    }

    public function asNullableBool(): AsNullableBool
    {
        return new AsNullableBool($this);
    }

    public function asFloat(float $default = null): AsFloat
    {
        return new AsFloat($this, $default);
    }

    public function asNullableFloat(): AsNullableFloat
    {
        return new AsNullableFloat($this);
    }

    public function asInt(int $default = null): AsInt
    {
        return new AsInt($this, $default);
    }

    public function asNullableInt(): AsNullableInt
    {
        return new AsNullableInt($this);
    }

    public function asString(string $default = null): AsString
    {
        return new AsString($this, $default);
    }

    public function asNonEmptyString(string $default = null): AsNonEmptyString
    {
        return new AsNonEmptyString($this, $default);
    }

    public function asNullableString(): AsNullableString
    {
        return new AsNullableString($this);
    }
}
