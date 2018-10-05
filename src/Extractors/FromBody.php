<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\AssocExtractorInterface;
use N1215\RequestParameterExtractor\BodyExtractorInterface;
use N1215\RequestParameterExtractor\CastableExtractorInterface;
use N1215\RequestParameterExtractor\NullableIntExtractorInterface;
use N1215\RequestParameterExtractor\StringExtractorInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class FromBody
 * @package N1215\RequestParameterExtractor\Extractors
 */
class FromBody implements BodyExtractorInterface
{
    use HighOrder;

    /**
     * @param ServerRequestInterface $request
     * @return StreamInterface
     */
    public function extract(ServerRequestInterface $request): StreamInterface
    {
        return $request->getBody();
    }

    public function getJson(): AssocExtractorInterface
    {
        return $this->toString()->map(function (string $body) {
            $result = \json_decode($body, true);

            if ($result === false || $result === null) {
                return [];
            }

            return $result;
        })->asAssoc();
    }

    public function toString(): StringExtractorInterface
    {
        return $this->map(function (StreamInterface $stream) {
            return  $stream->__toString();
        })->asString();
    }

    public function getSize(): NullableIntExtractorInterface
    {
        return $this->map(function (StreamInterface $stream) {
            return  $stream->getSize();
        })->asNullableInt();
    }

    public function getMetaData($key = null): CastableExtractorInterface
    {
        return $this->map(function (StreamInterface $stream) use ($key) {
            return  $stream->getMetadata($key);
        });
    }
}
