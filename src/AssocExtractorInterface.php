<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor;

use Psr\Http\Message\ServerRequestInterface;

interface AssocExtractorInterface extends ExtractorInterface
{
    public function extract(ServerRequestInterface $request): array;
}