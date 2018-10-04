<?php
declare(strict_types=1);

namespace N1215\RequestParameterExtractor;

use Psr\Http\Message\ServerRequestInterface;

interface IExtractor
{
    public function extract(ServerRequestInterface $request);
}