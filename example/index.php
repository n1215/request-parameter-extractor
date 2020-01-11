<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class Id implements \JsonSerializable
{
    /** @var int */
    private $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function equals(Id $another): bool
    {
        return $this->value === $another->value;
    }

    public function jsonSerialize()
    {
        return ['value' => $this->value];
    }

    public static function of(int $value): self
    {
        return new self($value);
    }
}

abstract class AbstractExtractor implements \N1215\RequestParameterExtractor\AssocExtractorInterface
{
    use \N1215\RequestParameterExtractor\Extractors\HighOrder;
    use \N1215\RequestParameterExtractor\Extractors\Typed\Cast;
    use \N1215\RequestParameterExtractor\Extractors\ArrayKey\AssocGet;

    private $inner;

    public function __construct(\N1215\RequestParameterExtractor\Factory $extractors)
    {
        $this->inner = $extractors->zipWithKey($this->createExtractorAssoc($extractors));
    }

    public function extract(ServerRequestInterface $request): array
    {
        return $this->inner->extract($request);
    }

    /**
     * @param \N1215\RequestParameterExtractor\Factory $extractors
     * @return \N1215\RequestParameterExtractor\ExtractorInterface[]
     */
    abstract protected function createExtractorAssoc(\N1215\RequestParameterExtractor\Factory $extractors): array;
}

class SampleExtractor extends AbstractExtractor
{
    protected function createExtractorAssoc(\N1215\RequestParameterExtractor\Factory $extractors): array
    {
        $queryParams = $extractors->fromQueryParams();
        return [
            'id' => $queryParams->get('id')->asInt(0)
                ->bind(function (int $id): Id {
                    return Id::of($id);
                }),
            'name' => $queryParams->get('name')
                ->filter(function (?string $value): bool {
                    return !empty($value);
                })->asString('no name'),
            'token' => $extractors->fromHeaderLine('Authorization')
                ->bind(function (string $value): string {
                    return str_replace('Bearer ', '', $value);
                })->asNullableString(),
            'my_cookie' => $extractors->fromCookieParams()->get('my_cookie')->asNullableString(),
            'host' => $extractors->fromUri()->getHost(),
            'json' => $extractors->fromBody()->getJson(),
            'zip' => $extractors->zip($extractors->fromMethod(), $extractors->fromUri()->getScheme()),
            'port' => $extractors
                ->bind(function (ServerRequestInterface $request): ?int {
                    return $request->getUri()->getPort();
                })
                ->asNullableInt(),
            'attribute' => $extractors->fromAttribute('my_attr')->asString(),
        ];
    }
}

class SampleRequestHandler implements RequestHandlerInterface
{
    /** @var \N1215\RequestParameterExtractor\AssocExtractorInterface */
    private $extractor;

    public function __construct(SampleExtractor $extractor)
    {
        $this->extractor = $extractor;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $params = $this->extractor->extract($request);
        return new \Laminas\Diactoros\Response\JsonResponse($params);
    }
}

$streamFactory = new \Laminas\Diactoros\StreamFactory();
$request = (new \Laminas\Diactoros\ServerRequestFactory())
    ->createServerRequest('GET', 'https://example.com:8080')
    ->withBody($streamFactory->createStream('{"message": "hello"}'))
    ->withQueryParams([
        'id' => '1',
        'name' => ''
    ])
    ->withAttribute('my_attr', 'dummy_attr_value')
    ->withHeader('Authorization', 'Bearer dummy_bearer_token')
    ->withCookieParams(['my_cookie' => 'dummy_cookie_value']);

$handler = new SampleRequestHandler(new SampleExtractor(new \N1215\RequestParameterExtractor\Factory()));
$response = $handler->handle($request);

$expected = [
    'id' => ['value' => 1],
    'name' => 'no name',
    'token' => 'dummy_bearer_token',
    'my_cookie' => 'dummy_cookie_value',
    'host' => 'example.com',
    'json' => ['message' => 'hello'],
    'zip' => ['GET', 'https'],
    'port' => 8080,
    'attribute' => 'dummy_attr_value',
];

$contents = $response->getBody()->getContents();
$json = \json_decode($contents, true);
assert($expected === $json);

echo $contents . PHP_EOL;
