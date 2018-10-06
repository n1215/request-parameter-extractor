<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;

interface UploadedFilesExtractorInterface extends ExtractorInterface
{
    /**
     * @param ServerRequestInterface $request
     * @return UploadedFileInterface[]
     */
    public function extract(ServerRequestInterface $request): array;

    public function get(int $index): NullableUploadedFileExtractorInterface;
}
