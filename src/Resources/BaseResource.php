<?php

namespace Label84\NederlandPostcode\Resources;

use Label84\NederlandPostcode\Exceptions\NederlandPostcodeRequestException;
use Label84\NederlandPostcode\NederlandPostcodeClient;
use Psr\Http\Client\ClientExceptionInterface;

class BaseResource
{
    public function __construct(
        protected NederlandPostcodeClient $nederlandPostcodeClient,
    ) {}

    /**
     * @param  array<string, string|int|null|array<string>>  $query
     * @return array<mixed, mixed>
     */
    public function request(string $method, string $path, array $query = []): array
    {
        try {
            return $this->nederlandPostcodeClient->request($method, $path, ['query' => $query]);
        } catch (ClientExceptionInterface $exception) {
            throw new NederlandPostcodeRequestException($exception);
        }
    }
}
