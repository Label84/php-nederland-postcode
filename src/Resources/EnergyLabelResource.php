<?php

namespace Label84\NederlandPostcode\Resources;

use Label84\NederlandPostcode\DTO\EnergyLabelCollection;
use Label84\NederlandPostcode\Factories\EnergyLabelCollectionFactory;

class EnergyLabelResource extends BaseResource
{
    public function get(
        string $postcode,
        int $number,
        ?string $addition,
    ): EnergyLabelCollection {
        // @phpstan-ignore-next-line
        return EnergyLabelCollectionFactory::make($this->request(
            method: 'GET',
            path: 'v1/energy-label',
            query: [
                'postcode' => $postcode,
                'number' => $number,
                'addition' => $addition,
            ],
        ));
    }
}
