<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\Extractors\Typed\AsNullableStream;
use N1215\RequestParameterExtractor\NullableIntExtractorInterface;
use N1215\RequestParameterExtractor\NullableStreamExtractorInterface;
use N1215\RequestParameterExtractor\NullableStringExtractorInterface;
use N1215\RequestParameterExtractor\NullableUploadedFileExtractorInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;

/**
 * Class FromUploadedFile
 * @package N1215\RequestParameterExtractor\Extractors
 */
class FromUploadedFile implements NullableUploadedFileExtractorInterface
{
    use HighOrder;

    private $index;

    public function __construct(int $index)
    {
        $this->index = $index;
    }

    public function extract(ServerRequestInterface $request): ?UploadedFileInterface
    {
        $files = $request->getUploadedFiles();

        if (!array_key_exists($this->index, $files)) {
            return null;
        }

        return $files[$this->index];
    }

    public function getStream(): NullableStreamExtractorInterface
    {
        return new AsNullableStream($this->bind(function (UploadedFileInterface $uploadedFile) {
            return $uploadedFile->getStream();
        }));
    }

    public function getSize(): NullableIntExtractorInterface
    {
        return $this->bind(function (UploadedFileInterface $uploadedFile) {
            return $uploadedFile->getSize();
        })->asNullableInt();
    }

    public function getError(): NullableIntExtractorInterface
    {
        return $this->bind(function (UploadedFileInterface $uploadedFile) {
            return $uploadedFile->getError();
        })->asNullableInt();
    }

    public function getClientFileName(): NullableStringExtractorInterface
    {
        return $this->bind(function (UploadedFileInterface $uploadedFile) {
            return $uploadedFile->getClientFilename();
        })->asNullableString();
    }

    public function getClientMediaType(): NullableStringExtractorInterface
    {
        return $this->bind(function (UploadedFileInterface $uploadedFile) {
            return $uploadedFile->getClientMediaType();
        })->asNullableString();
    }
}
