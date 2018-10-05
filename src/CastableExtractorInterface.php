<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor;

interface CastableExtractorInterface extends ExtractorInterface
{
    public function asArray(array $default = []): ArrayExtractorInterface;

    public function asAssoc(array $default = []): AssocExtractorInterface;

    public function asBool(bool $default = null): BoolExtractorInterface;

    public function asNullableBool(): NullableBoolExtractorInterface;

    public function asFloat(float $default = null): FloatExtractorInterface;

    public function asNullableFloat(): NullableFloatExtractorInterface;

    public function asInt(int $default = null): IntExtractorInterface;

    public function asNullableInt(): NullableIntExtractorInterface;

    public function asString(string $default = null): StringExtractorInterface;

    public function asNonEmptyString(string $default = null): NonEmptyStringExtractorInterface;

    public function asNullableString(): NullableStringExtractorInterface;
}
