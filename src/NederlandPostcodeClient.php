<?php

namespace Label84\NederlandPostcode;

use GuzzleHttp\Client;
use Label84\NederlandPostcode\DTO\Address;
use Label84\NederlandPostcode\DTO\AddressCollection;
use Label84\NederlandPostcode\DTO\Quota;
use Label84\NederlandPostcode\Enums\AddressAttributesEnum;
use Label84\NederlandPostcode\Exceptions\AddressNotFoundException;
use Label84\NederlandPostcode\Exceptions\MultipleAddressesFoundException;
use Label84\NederlandPostcode\Resources\AddressesResource;
use Label84\NederlandPostcode\Resources\EnergyLabelResource;
use Label84\NederlandPostcode\Resources\QuotaResource;

/**
 * @method AddressesResource addresses()
 * @method QuotaResource quota()
 * @method EnergyLabelResource energyLabels()
 * @method AddressCollection<Address> list(string $postcode, int $number, ?string $addition = null, array<int|string, string|AddressAttributesEnum> $attributes = [])
 * @method Address find(string $postcode, int $number, ?string $addition = null, array<int|string, string|AddressAttributesEnum> $attributes = [])
 * @method Quota usage()
 */
class NederlandPostcodeClient
{
    public const DEFAULT_BASE_URL = 'https://api.nederlandpostcode.nl/';

    protected Client $client;

    /**
     * @param  array<string, string>  $headers
     */
    public function __construct(
        public string $key,
        public string $baseUrl = self::DEFAULT_BASE_URL,
        public int $timeout = 5,
        array $headers = []
    ) {
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => $this->timeout,
            'headers' => array_merge([
                'Authorization' => "Bearer {$this->key}",
                'Accept' => 'application/json',
            ], $headers),
        ]);
    }

    /**
     * @param  array<string, mixed>  $options
     * @return array<string, mixed>
     */
    public function request(string $method, string $uri, array $options = []): array
    {
        $response = $this->client->request($method, $uri, $options);

        $body = $response->getBody()->getContents();

        return json_decode($body, true); // @phpstan-ignore return.type
    }

    public function addresses(): AddressesResource
    {
        return new AddressesResource($this);
    }

    public function energyLabels(): EnergyLabelResource
    {
        return new EnergyLabelResource($this);
    }

    public function quota(): QuotaResource
    {
        return new QuotaResource($this);
    }

    /**
     * Fetch a list of addresses by postcode, number, and addition.
     *
     * @param  array<int|string, string|AddressAttributesEnum>  $attributes
     * @return AddressCollection<Address>
     */
    public function list(string $postcode, int $number, ?string $addition = null, array $attributes = []): AddressCollection
    {
        return $this->addresses()->get(
            postcode: $postcode,
            number: $number,
            addition: $addition,
            attributes: $attributes,
        );
    }

    /**
     * Fetch a single address by postcode, number, and addition.
     *
     * @param  array<int|string, string|AddressAttributesEnum>  $attributes
     *
     * @throws AddressNotFoundException
     * @throws MultipleAddressesFoundException
     */
    public function find(string $postcode, int $number, ?string $addition = null, array $attributes = []): Address
    {
        $addresses = $this->addresses()->get(
            postcode: $postcode,
            number: $number,
            addition: $addition,
            attributes: $attributes,
        );

        if ($addresses->isEmpty()) {
            throw new AddressNotFoundException();
        } elseif ($addresses->count() > 1) {
            throw new MultipleAddressesFoundException();
        }

        return $addresses->all()[0];
    }

    /**
     * Fetch the current quota usage.
     */
    public function usage(): Quota
    {
        return $this->quota()->get();
    }
}
