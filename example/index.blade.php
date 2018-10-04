<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

class Id
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
}

$requestFactory = new \Zend\Diactoros\ServerRequestFactory();
$extractors = new \N1215\RequestParameterExtractor\Factory();

call_user_func(function () use ($requestFactory, $extractors) {
    $request = $requestFactory
        ->createServerRequest('GET', 'https://example.com')
        ->withQueryParams(['id' => '1']);

    $extractor = $extractors
        ->fromQueryParam('id')
        ->asInt()
        ->map(function (int $id): Id {
            return new Id($id);
        });

    $id = $extractor->extract($request);

    assert($id->equals(new Id(1)));
    var_dump($id);
});

call_user_func(function () use ($requestFactory, $extractors) {
    $request = $requestFactory
        ->createServerRequest('GET', 'https://example.com');

    $extractor = $extractors
        ->fromQueryParam('id')
        ->asInt(2);

    $id = $extractor->extract($request);

    assert($id === 2);
    var_dump($id);
});

call_user_func(function () use ($requestFactory, $extractors) {
    $request = $requestFactory
        ->createServerRequest('GET', 'https://example.com')
        ->withQueryParams(['id' => '1']);

    $extractor = $extractors
        ->fromQueryParam('id');

    $id = $extractor->extract($request);

    assert($id === '1');
    var_dump($id);
});

call_user_func(function () use ($requestFactory, $extractors) {
    $request = $requestFactory
        ->createServerRequest('GET', 'https://example.com')
        ->withQueryParams(['id' => '1']);

    $extractor = $extractors
        ->fromQueryParam('id')
        ->asInt();

    $id = $extractor->extract($request);

    assert($id === 1);
    var_dump($id);
});

call_user_func(function () use ($requestFactory, $extractors) {
    $request = $requestFactory
        ->createServerRequest('GET', 'https://example.com');

    $extractor = $extractors
        ->fromQueryParam('id')
        ->asInt(2);

    $id = $extractor->extract($request);

    assert($id === 2);
    var_dump($id);
});

call_user_func(function () use ($requestFactory, $extractors) {
    $request = $requestFactory
        ->createServerRequest('GET', 'https://example.com');

    $extractor = $extractors
        ->fromQueryParam('id')
        ->asNullableInt();

    $id = $extractor->extract($request);

    assert($id === null);
    var_dump($id);
});
