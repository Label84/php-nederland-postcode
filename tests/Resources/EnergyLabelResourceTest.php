<?php

namespace Label84\NederlandPostcode\Tests\Resources;

use Label84\NederlandPostcode\DTO\EnergyLabelCollection;
use Label84\NederlandPostcode\Tests\TestCase;

class EnergyLabelResourceTest extends TestCase
{
    public function test_get_single_result(): void
    {
        $result = $this->client
            ->energyLabels()
            ->get(
                postcode: '1118BN',
                number: 800,
                addition: null,
            );

        $this->assertInstanceOf(EnergyLabelCollection::class, $result);
        $this->assertCount(1, $result);
    }

    public function test_get_multiple_results(): void
    {
        $result = $this->client
            ->energyLabels()
            ->get(
                postcode: '1015CN',
                number: 10,
                addition: 'A',
            );

        $this->assertInstanceOf(EnergyLabelCollection::class, $result);
        $this->assertCount(2, $result);
    }
}
