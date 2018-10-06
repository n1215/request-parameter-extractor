<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors\Typed;

use N1215\RequestParameterExtractor\ArrayExtractorInterface;
use N1215\RequestParameterExtractor\AssocExtractorInterface;
use N1215\RequestParameterExtractor\BoolExtractorInterface;
use N1215\RequestParameterExtractor\ExtractorInterface;
use N1215\RequestParameterExtractor\FloatExtractorInterface;
use N1215\RequestParameterExtractor\IntExtractorInterface;
use N1215\RequestParameterExtractor\NonEmptyStringExtractorInterface;
use N1215\RequestParameterExtractor\NullableBoolExtractorInterface;
use N1215\RequestParameterExtractor\NullableFloatExtractorInterface;
use N1215\RequestParameterExtractor\NullableIntExtractorInterface;
use N1215\RequestParameterExtractor\NullableObjectExtractorInterface;
use N1215\RequestParameterExtractor\NullableStringExtractorInterface;
use N1215\RequestParameterExtractor\ObjectExtractorInterface;
use N1215\RequestParameterExtractor\StringExtractorInterface;

/**
 * Trait Cast
 * @package N1215\RequestParameterExtractor\Extractors\Typed
 * @mixin ExtractorInterface
 */
trait Cast
{
    public function asArray(array $default = []): ArrayExtractorInterface
    {
        return new AsArray($this, $default);
    }

    public function asAssoc(array $default = []): AssocExtractorInterface
    {
        return new AsAssoc($this, $default);
    }

    public function asBool(bool $default = null): BoolExtractorInterface
    {
        return new AsBool($this, $default);
    }

    public function asNullableBool(): NullableBoolExtractorInterface
    {
        return new AsNullableBool($this);
    }

    public function asFloat(float $default = null): FloatExtractorInterface
    {
        return new AsFloat($this, $default);
    }

    public function asNullableFloat(): NullableFloatExtractorInterface
    {
        return new AsNullableFloat($this);
    }

    public function asInt(int $default = null): IntExtractorInterface
    {
        return new AsInt($this, $default);
    }

    public function asNullableInt(): NullableIntExtractorInterface
    {
        return new AsNullableInt($this);
    }

    public function asObject(object $default = null): ObjectExtractorInterface
    {
        return new AsObject($this, $default);
    }

    public function asNullableObject(): NullableObjectExtractorInterface
    {
        return new AsNullableObject($this);
    }

    public function asString(string $default = null): StringExtractorInterface
    {
        return new AsString($this, $default);
    }

    public function asNonEmptyString(string $default = null): NonEmptyStringExtractorInterface
    {
        return new AsNonEmptyString($this, $default);
    }

    public function asNullableString(): NullableStringExtractorInterface
    {
        return new AsNullableString($this);
    }
}
