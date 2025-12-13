<?php

namespace Label84\NederlandPostcode\Tests;

use Label84\NederlandPostcode\DTO\Address;
use Label84\NederlandPostcode\DTO\AddressCollection;
use Label84\NederlandPostcode\DTO\Quota;
use Label84\NederlandPostcode\Exceptions\AddressNotFoundException;
use Label84\NederlandPostcode\Exceptions\MultipleAddressesFoundException;

class NederlandPostcodeClientTest extends TestCase
{
    public function test_find(): void
    {
        $result = $this->client
            ->find(
                postcode: '1118BN',
                number: 800,
                addition: null,
            );

        $this->assertInstanceOf(Address::class, $result);
    }

    public function test_find_throws_address_not_found_exception(): void
    {
        $this->expectException(AddressNotFoundException::class);

        $this->client
            ->find(
                postcode: '1118BN',
                number: 999,
                addition: null,
            );
    }

    public function test_find_throws_multiple_addresses_found_exception(): void
    {
        $this->expectException(MultipleAddressesFoundException::class);

        $this->client
            ->find(
                postcode: '1015CN',
                number: 10,
                addition: null,
            );
    }

    public function test_list(): void
    {
        $result = $this->client
            ->list(
                postcode: '1015CN',
                number: 10,
                addition: null,
            );

        $this->assertInstanceOf(AddressCollection::class, $result);
        $this->assertCount(4, $result);
    }

    public function test_usage(): void
    {
        $result = $this->client
            ->usage();

        $this->assertInstanceOf(Quota::class, $result);

        $quota = $result;

        $this->assertEquals(1500, $quota->used);
        $this->assertEquals(10000, $quota->limit);
    }
}
