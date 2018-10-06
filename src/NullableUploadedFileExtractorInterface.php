<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;

interface NullableUploadedFileExtractorInterface extends ExtractorInterface
{
    public function extract(ServerRequestInterface $request): ?UploadedFileInterface;

    public function getStream(): NullableStreamExtractorInterface;

    public function getSize(): NullableIntExtractorInterface;

    public function getError(): NullableIntExtractorInterface;

    public function getClientFileName(): NullableStringExtractorInterface;

    public function getClientMediaType(): NullableStringExtractorInterface;
}
