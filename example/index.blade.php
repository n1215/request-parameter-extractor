<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Id implements \JsonSerializable
{
    /** @var int */
    private $value;

    public function __construct(int $value)
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
}

class SampleRequestHandler implements RequestHandlerInterface
{
    private $extractor;

    public function __construct(\N1215\RequestParameterExtractor\Factory $extractors)
    {
        $queryParams = $extractors->fromQueryParams();

        $this->extractor = $extractors->assoc([
            'id' => $queryParams->get('id')->asNullableInt()
                ->map(function (int $id): Id {
                    return new Id($id);
                }),
            'name' => $queryParams->get('name')->asNonEmptyString('no name'),
            'token' => $extractors->fromHeaderLine('Authorization')
                ->map(function (string $value) {
                    return str_replace('Bearer ', '', $value);
                }),
            'my_cookie' => $extractors->fromCookieParams()->get('my_cookie')->asNullableString(),
        ]);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $params = $this->extractor->extract($request);
        return new \Zend\Diactoros\Response\JsonResponse($params);
    }
}

$request = (new \Zend\Diactoros\ServerRequestFactory())
    ->createServerRequest('GET', 'https://example.com')
    ->withQueryParams([
        'id' => '1',
        'name' => ''
    ])
    ->withHeader('Authorization', 'Bearer dummy_bearer_token')
    ->withCookieParams(['my_cookie' => 'dummy_cookie_value']);

$handler = new SampleRequestHandler(new \N1215\RequestParameterExtractor\Factory());
$response = $handler->handle($request);

$expected = [
    'id' => ['value' => 1],
    'name' => 'no name',
    'token' => 'dummy_bearer_token',
    'my_cookie' => 'dummy_cookie_value',
];

$contents = $response->getBody()->getContents();
$json = \json_decode($contents, true);
assert($expected === $json);

echo $contents . PHP_EOL;
