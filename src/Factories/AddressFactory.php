<?php

namespace Label84\NederlandPostcode\Factories;

use Label84\NederlandPostcode\DTO\Address;
use Label84\NederlandPostcode\DTO\Coordinates;
use Label84\NederlandPostcode\DTO\District;

class AddressFactory
{
    /**
     * @param array{
     *     postcode: string,
     *     number: int,
     *     addition?: string|null,
     *     street: string,
     *     city: string,
     *     municipality: string,
     *     province: string,
     *     country: string,
     *     coordinates?: array{
     *        latitude: float,
     *        longitude: float,
     *    },
     *    details?: array{
     *       district?: array{
     *          official: string,
     *          name: string,
     *      },
     *      function?: string,
     *      location_status?: string,
     *      property_status?: string,
     *      surface_area?: float,
     *      construction_year?: int,
     *    }
     * } $attributes
     */
    public static function make(array $attributes): Address
    {
        return new Address(
            postcode: $attributes['postcode'],
            number: $attributes['number'],
            addition: $attributes['addition'] ?? null,
            street: $attributes['street'],
            city: $attributes['city'],
            municipality: $attributes['municipality'],
            province: $attributes['province'],
            country: $attributes['country'],
            coordinates: isset($attributes['coordinates']) ? new Coordinates(
                latitude: $attributes['coordinates']['latitude'],
                longitude: $attributes['coordinates']['longitude'],
            ) : null,
            district: isset($attributes['details']['district']) ? new District(
                official: $attributes['details']['district']['official'],
                name: $attributes['details']['district']['name'],
            ) : null,
            function: $attributes['details']['function'] ?? null,
            location_status: $attributes['details']['location_status'] ?? null,
            property_status: $attributes['details']['property_status'] ?? null,
            surface_area: $attributes['details']['surface_area'] ?? null,
            construction_year: $attributes['details']['construction_year'] ?? null,
        );
    }
}
