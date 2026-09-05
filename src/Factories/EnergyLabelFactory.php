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
     *     registration_date: string,
     *     inspection_date: string,
     *     valid_until_date: string,
     *     status: string|null,
     *     construction_type: string,
     *     building_type: string|null,
     *     energy_label: string|null,
     *     calculation_type: string,
     *     inspection_type: string|null,
     *     construction_year: int,
     *     thermal_zone_area?: float|null,
     *     compactness?: float|null,
     *     energy_demand?: float|null,
     *     energy_demand_requirement?: float|null,
     *     primary_fossil_energy?: float|null,
     *     primary_fossil_energy_requirement?: float|null,
     *     primary_fossil_energy_emg?: float|null,
     *     renewable_energy_share?: float|null,
     *     renewable_energy_share_requirement?: float|null,
     *     renewable_energy_share_emg?: float|null,
     *     calculated_energy_consumption?: float|null,
     *     heat_demand?: float|null,
     *     calculated_co2_emission?: float|null,
     *     temperature_excess?: float|null,
     *     temperature_excess_requirement?: float|null,
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
            registrationDate: DateTime::createFromFormat('d-m-Y', $attributes['registration_date']), // @phpstan-ignore argument.type
            inspectionDate: DateTime::createFromFormat('d-m-Y', $attributes['inspection_date']), // @phpstan-ignore argument.type
            validUntilDate: DateTime::createFromFormat('d-m-Y', $attributes['valid_until_date']), // @phpstan-ignore argument.type
            constructionType: $attributes['construction_type'],
            buildingType: $attributes['building_type'] ?? null,
            energyLabel: $attributes['energy_label'] ?? null,
            calculationType: $attributes['calculation_type'],
            inspectionType: $attributes['inspection_type'] ?? null,
            status: $attributes['status'] ?? null,
            constructionYear: $attributes['construction_year'],
            usageAreaThermalZone: $attributes['thermal_zone_area'] ?? null,
            compactness: $attributes['compactness'] ?? null,
            energyDemand: $attributes['energy_demand'] ?? null,
            energyDemandRequirement: $attributes['energy_demand_requirement'] ?? null,
            primaryFossilEnergy: $attributes['primary_fossil_energy'] ?? null,
            primaryFossilEnergyRequirement: $attributes['primary_fossil_energy_requirement'] ?? null,
            primaryFossilEnergyEmg: $attributes['primary_fossil_energy_emg'] ?? null,
            renewableShare: $attributes['renewable_energy_share'] ?? null,
            renewableShareRequirement: $attributes['renewable_energy_share_requirement'] ?? null,
            renewableShareEmg: $attributes['renewable_energy_share_emg'] ?? null,
            calculatedEnergyConsumption: $attributes['calculated_energy_consumption'] ?? null,
            heatDemand: $attributes['heat_demand'] ?? null,
            calculatedCo2Emission: $attributes['calculated_co2_emission'] ?? null,
            temperatureExcess: $attributes['temperature_excess'] ?? null,
            temperatureExcessRequirement: $attributes['temperature_excess_requirement'] ?? null,
        );
    }
}
