<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\NullableUploadedFileExtractorInterface;
use N1215\RequestParameterExtractor\UploadedFilesExtractorInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;

/**
 * Class FromUploadedFiles
 * @package N1215\RequestParameterExtractor\Extractors
 */
class FromUploadedFiles implements UploadedFilesExtractorInterface
{
    use HighOrder;

    /**
     * @param ServerRequestInterface $request
     * @return UploadedFileInterface[]
     */
    public function extract(ServerRequestInterface $request): array
    {
        return $request->getUploadedFiles();
    }

    public function get(int $index): NullableUploadedFileExtractorInterface
    {
        return new FromUploadedFile($index);
    }
}
