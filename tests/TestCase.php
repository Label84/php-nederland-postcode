<?php

namespace Label84\NederlandPostcode\Tests;

use DateTime;
use Label84\NederlandPostcode\DTO\Address;
use Label84\NederlandPostcode\DTO\AddressCollection;
use Label84\NederlandPostcode\DTO\Coordinates;
use Label84\NederlandPostcode\DTO\EnergyLabel;
use Label84\NederlandPostcode\DTO\EnergyLabelCollection;
use Label84\NederlandPostcode\DTO\Quota;
use Label84\NederlandPostcode\NederlandPostcodeClient;
use Label84\NederlandPostcode\Resources\AddressesResource;
use Label84\NederlandPostcode\Resources\EnergyLabelResource;
use Label84\NederlandPostcode\Resources\QuotaResource;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected NederlandPostcodeClient $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockNederlandPostcodeClient();
    }

    protected function mockNederlandPostcodeClient(): void
    {
        $mockAddresses = $this->createStub(AddressesResource::class);
        $mockAddresses->method('get')
            ->willReturnCallback(function (string $postcode, int $number, ?string $addition, array $attributes = []) {
                return match (true) {
                    $postcode === '1118BN' && $number === 800 => $this->singleAddressResponse(),
                    $postcode === '1015CN' && $number === 10 => $this->multipleAddressesResponse(),
                    default => new AddressCollection([]),
                };
            });

        $mockEnergyLabels = $this->createStub(EnergyLabelResource::class);
        $mockEnergyLabels->method('get')
            ->willReturnCallback(function (string $postcode, int $number, ?string $addition) {
                return match (true) {
                    $postcode === '1118BN' && $number === 800 => $this->singleEnergyLabelsResponse(),
                    $postcode === '1015CN' && $number === 10 => $this->multipleEnergyLabelsResponse(),
                    default => new EnergyLabelCollection([]),
                };
            });


        $mockQuota = $this->createStub(QuotaResource::class);
        $mockQuota->method('get')->willReturn(new Quota(used: 1500, limit: 10000));

        $this->client = new class($mockAddresses, $mockEnergyLabels, $mockQuota) extends NederlandPostcodeClient {
            public AddressesResource $addressesResource;
            public EnergyLabelResource $energyLabelsResource;
            public QuotaResource $quotaResource;

            public function __construct($addresses, $energyLabels, $quota)
            {
                $this->addressesResource = $addresses;
                $this->energyLabelsResource = $energyLabels;
                $this->quotaResource = $quota;
            }

            public function addresses(): AddressesResource
            {
                return $this->addressesResource;
            }

            public function energyLabels(): EnergyLabelResource
            {
                return $this->energyLabelsResource;
            }

            public function quota(): QuotaResource
            {
                return $this->quotaResource;
            }
        };
    }

    private function singleAddressResponse(): AddressCollection
    {
        return new AddressCollection([
            new Address(
                postcode: '1118BN',
                number: 800,
                addition: '',
                street: 'Schiphol Boulevard',
                city: 'Schiphol',
                municipality: 'Haarlemmermeer',
                province: 'Noord-Holland',
                country: 'Nederland',
                coordinates: new Coordinates(
                    latitude: 52.30528553688755,
                    longitude: 4.750645160863609,
                ),
            ),
        ]);
    }

    private function multipleAddressesResponse(): AddressCollection
    {
        return new AddressCollection([
            new Address(
                postcode: '1015CN',
                number: 10,
                addition: 'A',
                street: 'Keizersgracht',
                city: 'Amsterdam',
                municipality: 'Amsterdam',
                province: 'Noord-Holland',
                country: 'Nederland',
                coordinates: new Coordinates(
                    latitude: 52.379401496779124,
                    longitude: 4.889216673725493,
                ),
            ),
            new Address(
                postcode: '1015CN',
                number: 10,
                addition: 'B',
                street: 'Keizersgracht',
                city: 'Amsterdam',
                municipality: 'Amsterdam',
                province: 'Noord-Holland',
                country: 'Nederland',
                coordinates: new Coordinates(
                    latitude: 52.379401496779124,
                    longitude: 4.889216673725493,
                ),
            ),
            new Address(
                postcode: '1015CN',
                number: 10,
                addition: 'C',
                street: 'Keizersgracht',
                city: 'Amsterdam',
                municipality: 'Amsterdam',
                province: 'Noord-Holland',
                country: 'Nederland',
                coordinates: new Coordinates(
                    latitude: 52.379401496779124,
                    longitude: 4.889216673725493,
                ),
            ),
            new Address(
                postcode: '1015CN',
                number: 10,
                addition: 'D',
                street: 'Keizersgracht',
                city: 'Amsterdam',
                municipality: 'Amsterdam',
                province: 'Noord-Holland',
                country: 'Nederland',
                coordinates: new Coordinates(
                    latitude: 52.379401496779124,
                    longitude: 4.889216673725493,
                ),
            ),
        ]);
    }

    private function singleEnergyLabelsResponse(): EnergyLabelCollection
    {
        return new EnergyLabelCollection([
            new EnergyLabel(
                postcode: '1118BN',
                number: 800,
                addition: '',
                street: 'Schiphol Boulevard',
                city: 'Schiphol',
                inspectionDate: new DateTime('2026-01-15'),
                validUntilDate: new DateTime('2036-01-15'),
                constructionType: 'utiliteitsbouw',
                buildingType: null,
                energyLabel: 'A+++',
                maxEnergyDemand: 98.4,
                maxFossilEnergyDemand: 55.48,
                minRenewableShare: 55.3,
            ),
        ]);
    }

    private function multipleEnergyLabelsResponse(): EnergyLabelCollection
    {
        return new EnergyLabelCollection([
            new EnergyLabel(
                postcode: '1015CN',
                number: 10,
                addition: 'A',
                street: 'Keizersgracht',
                city: 'Amsterdam',
                inspectionDate: new DateTime('2026-01-05'),
                validUntilDate: new DateTime('2036-01-05'),
                constructionType: 'woningbouw',
                buildingType: 'vrijstaande woning',
                energyLabel: 'B',
                maxEnergyDemand: 99.57,
                maxFossilEnergyDemand: 150,
                minRenewableShare: 33.5,
            ),
            new EnergyLabel(
                postcode: '1015CN',
                number: 10,
                addition: 'A',
                street: 'Keizersgracht',
                city: 'Amsterdam',
                inspectionDate: new DateTime('2015-06-01'),
                validUntilDate: new DateTime('2025-06-01'),
                constructionType: 'woningbouw',
                buildingType: 'vrijstaande woning',
                energyLabel: 'G',
                maxEnergyDemand: 177.57,
                maxFossilEnergyDemand: 218.86,
                minRenewableShare: 11,
            ),
        ]);
    }
}
