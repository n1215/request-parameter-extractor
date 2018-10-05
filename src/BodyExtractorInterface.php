<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor;

interface BodyExtractorInterface extends StreamExtractorInterface
{
    public function getJson(): AssocExtractorInterface;
}
