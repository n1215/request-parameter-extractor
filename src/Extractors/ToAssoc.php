<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor\Extractors;

use N1215\RequestParameterExtractor\AssocExtractorInterface;
use N1215\RequestParameterExtractor\ExtractorInterface;
use Psr\Http\Message\ServerRequestInterface;

class ToAssoc implements AssocExtractorInterface
{
    /** @var ExtractorInterface[] */
    private $extractors;

    public function __construct(array $extractors)
    {
        $this->extractors = [];

        foreach($extractors as $key => $extractor) {
            $this->add($key, $extractor);
        }
    }

    private function add(string $key, ExtractorInterface $extractor): void
    {
        $this->extractors[$key] = $extractor;
    }

    public function extract(ServerRequestInterface $request): array
    {
        $values = [];

        foreach($this->extractors as $key => $extractor) {
            $values[$key] = $extractor->extract($request);
        }

        return $values;
    }
}
