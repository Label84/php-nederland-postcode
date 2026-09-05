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
        public readonly DateTime $registrationDate,
        public readonly DateTime $inspectionDate,
        public readonly DateTime $validUntilDate,
        public readonly string $constructionType,
        public readonly ?string $buildingType,
        public readonly ?string $energyLabel,
        public readonly string $calculationType,
        public readonly ?string $inspectionType,
        public readonly ?string $status,
        public readonly int $constructionYear,
        public readonly ?float $usageAreaThermalZone,
        public readonly ?float $compactness,
        public readonly ?float $energyDemand,
        public readonly ?float $energyDemandRequirement,
        public readonly ?float $primaryFossilEnergy,
        public readonly ?float $primaryFossilEnergyRequirement,
        public readonly ?float $primaryFossilEnergyEmg,
        public readonly ?float $renewableShare,
        public readonly ?float $renewableShareRequirement,
        public readonly ?float $renewableShareEmg,
        public readonly ?float $calculatedEnergyConsumption,
        public readonly ?float $heatDemand,
        public readonly ?float $calculatedCo2Emission,
        public readonly ?float $temperatureExcess,
        public readonly ?float $temperatureExcessRequirement,
    ) {}
}
