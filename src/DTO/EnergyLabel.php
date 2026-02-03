<?php

namespace Label84\NederlandPostcode\DTO;

use DateTime;

class EnergyLabel
{
    public function __construct(
        public readonly string $postcode,
        public readonly int $number,
        public readonly ?string $addition,
        public readonly string $street,
        public readonly string $city,
        public readonly DateTime $inspectionDate,
        public readonly DateTime $validUntilDate,
        public readonly string $constructionType,
        public readonly ?string $buildingType,
        public readonly string $energyLabel,
        public readonly ?float $maxEnergyDemand,
        public readonly ?float $maxFossilEnergyDemand,
        public readonly ?float $minRenewableShare,
    ) {}
}
