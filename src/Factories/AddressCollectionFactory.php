<?php

namespace Label84\NederlandPostcode\Factories;

use Label84\NederlandPostcode\DTO\AddressCollection;

class AddressCollectionFactory
{
    /**
     * @param array{
     *     data: array<array{
     *         postcode: string,
     *         number: int,
     *         addition?: string|null,
     *         street: string,
     *         city: string,
     *         municipality: string,
     *         province: string,
     *         country: string,
     *         coordinates?: array{
     *            latitude: float,
     *            longitude: float,
     *        },
     *        details?: array{
     *           district?: array{
     *             official: string,
     *             name: string,
     *          },
     *          function?: string,
     *          location_status?: string,
     *          property_status?: string,
     *          surface_area?: float,
     *          construction_year?: int,
     *        }
     *     }>
     * } $response
     */
    public static function make(array $response): AddressCollection
    {
        $addresses = array_map(
            fn(array $attributes) => AddressFactory::make($attributes),
            $response['data'],
        );

        return new AddressCollection($addresses);
    }
}
