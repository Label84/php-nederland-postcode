<?php

namespace Label84\NederlandPostcode\Factories;

use DateTime;
use Label84\NederlandPostcode\DTO\EnergyLabel;
use Label84\NederlandPostcode\DTO\EnergyLabelCollection;

class EnergyLabelCollectionFactory
{
    /**
     * @param array{data: array{
     *      postcode: string,
     *      number: int,
     *      addition?: string|null,
     *      street: string,
     *      city: string,
     *      energy_labels: array<array{
     *          inspection_date: string,
     *          valid_until_date: string,
     *          construction_type: string,
     *          building_type: string|null,
     *          energy_label: string,
     *          max_energy_demand: float,
     *          max_fossil_energy_demand: float,
     *          min_renewable_share: float,
     *      }>,
     * }} $response
     */
    public static function make(array $response): EnergyLabelCollection
    {
        $postcode = $response['data']['postcode'];
        $number = $response['data']['number'];
        $addition = $response['data']['addition'] ?? null;
        $street = $response['data']['street'];
        $city = $response['data']['city'];

        $energyLabels = array_map(function (array $attributes) use ($postcode, $number, $addition, $street, $city) {
            return new EnergyLabel(
                postcode: $postcode,
                number: $number,
                addition: $addition,
                street: $street,
                city: $city,
                inspectionDate: new DateTime($attributes['inspection_date']),
                validUntilDate: new DateTime($attributes['valid_until_date']),
                constructionType: $attributes['construction_type'],
                buildingType: $attributes['building_type'],
                energyLabel: $attributes['energy_label'],
                maxEnergyDemand: $attributes['max_energy_demand'],
                maxFossilEnergyDemand: $attributes['max_fossil_energy_demand'],
                minRenewableShare: $attributes['min_renewable_share'],
            );
        }, $response['data']['energy_labels']);

        $energyLabels = array_values($energyLabels);

        return new EnergyLabelCollection($energyLabels);
    }
}
