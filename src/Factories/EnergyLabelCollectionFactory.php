<?php

namespace Label84\NederlandPostcode\Factories;

use Label84\NederlandPostcode\DTO\EnergyLabelCollection;

class EnergyLabelCollectionFactory
{
    /**
     * @param array{
     *     data: array{
     *         postcode: string,
     *         number: int,
     *         addition?: string|null,
     *         street: string,
     *         city: string,
     *         energy_labels: array<array{
     *             inspection_date: string,
     *             valid_until_date: string,
     *             construction_type: string,
     *             building_type: string|null,
     *             energy_label: string,
     *             max_energy_demand: float,
     *             max_fossil_energy_demand: float,
     *             min_renewable_share: float,
     *         }>
     *     }
     * } $response
     */
    public static function make(array $response): EnergyLabelCollection
    {
        $shared = [
            'postcode' => $response['data']['postcode'],
            'number' => $response['data']['number'],
            'addition' => $response['data']['addition'] ?? null,
            'street' => $response['data']['street'],
            'city' => $response['data']['city'],
        ];

        $energyLabels = array_map(
            fn(array $attributes) => EnergyLabelFactory::make(array_merge($shared, $attributes)),
            $response['data']['energy_labels'],
        );

        return new EnergyLabelCollection(array_values($energyLabels));
    }
}
