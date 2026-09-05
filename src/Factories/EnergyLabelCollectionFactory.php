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
     *             registration_date: string,
     *             inspection_date: string,
     *             valid_until_date: string,
     *             status: string|null,
     *             construction_type: string,
     *             building_type: string|null,
     *             energy_label: string|null,
     *             calculation_type: string,
     *             inspection_type: string|null,
     *             construction_year: int,
     *             thermal_zone_area?: float|null,
     *             compactness?: float|null,
     *             energy_demand?: float|null,
     *             energy_demand_requirement?: float|null,
     *             primary_fossil_energy?: float|null,
     *             primary_fossil_energy_requirement?: float|null,
     *             primary_fossil_energy_emg?: float|null,
     *             renewable_energy_share?: float|null,
     *             renewable_energy_share_requirement?: float|null,
     *             renewable_energy_share_emg?: float|null,
     *             calculated_energy_consumption?: float|null,
     *             heat_demand?: float|null,
     *             calculated_co2_emission?: float|null,
     *             temperature_excess?: float|null,
     *             temperature_excess_requirement?: float|null,
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
