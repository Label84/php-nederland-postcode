<?php

namespace Label84\NederlandPostcode\Factories;

use DateTime;
use Label84\NederlandPostcode\DTO\EnergyLabel;

class EnergyLabelFactory
{
    /**
     * @param array{
     *     postcode: string,
     *     number: int,
     *     addition?: string|null,
     *     street: string,
     *     city: string,
     *     inspection_date: string,
     *     valid_until_date: string,
     *     construction_type: string,
     *     building_type: string|null,
     *     energy_label: string,
     *     max_energy_demand: float,
     *     max_fossil_energy_demand: float,
     *     min_renewable_share: float,
     * } $attributes
     */
    public static function make(array $attributes): EnergyLabel
    {
        return new EnergyLabel(
            postcode: $attributes['postcode'],
            number: $attributes['number'],
            addition: $attributes['addition'] ?? null,
            street: $attributes['street'],
            city: $attributes['city'],
            inspectionDate: new DateTime($attributes['inspection_date']),
            validUntilDate: new DateTime($attributes['valid_until_date']),
            constructionType: $attributes['construction_type'],
            buildingType: $attributes['building_type'],
            energyLabel: $attributes['energy_label'],
            maxEnergyDemand: $attributes['max_energy_demand'],
            maxFossilEnergyDemand: $attributes['max_fossil_energy_demand'],
            minRenewableShare: $attributes['min_renewable_share'],
        );
    }
}
