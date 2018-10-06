<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors\Typed;

use N1215\RequestParameterExtractor\ExtractorInterface;
use N1215\RequestParameterExtractor\Extractors\HighOrder;
use N1215\RequestParameterExtractor\NullableBoolExtractorInterface;
use N1215\RequestParameterExtractor\NullableIntExtractorInterface;
use N1215\RequestParameterExtractor\NullableStreamExtractorInterface;
use N1215\RequestParameterExtractor\NullableStringExtractorInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class AsNullableStream
 * @package N1215\RequestParameterExtractor\Extractors\Typed
 */
class AsNullableStream implements NullableStreamExtractorInterface
{
    use HighOrder;

    /** @var ExtractorInterface */
    private $original;

    public function __construct(ExtractorInterface $original)
    {
        $this->original = $original;
    }

    public function extract(ServerRequestInterface $request): ?StreamInterface
    {
        $value = $this->original->extract($request);

        if ($value === null) {
            return null;
        }

        return $value;
    }

    public function getSize(): NullableIntExtractorInterface
    {
        return $this->bind(function (StreamInterface $stream) {
            return $stream->getSize();
        })->asNullableInt();
    }

    public function getMetaData($key = null): ExtractorInterface
    {
        return $this->bind(function (StreamInterface $stream) {
            return $stream->getMetadata();
        });
    }

    public function toString(): NullableStringExtractorInterface
    {
        return $this->bind(function (StreamInterface $stream) {
            return $stream->__toString();
        })->asNullableString();
    }
}
