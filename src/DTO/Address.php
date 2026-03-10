<?php

namespace Label84\NederlandPostcode\DTO;

class Address
{
    public function __construct(
        public readonly string $postcode,
        public readonly int $number,
        public readonly ?string $addition,
        public readonly string $street,
        public readonly string $city,
        public readonly string $municipality,
        public readonly string $province,
        public readonly string $country,
        public readonly ?Coordinates $coordinates,
        public readonly ?District $district,
        public readonly ?string $function,
        public readonly ?string $location_status,
        public readonly ?string $property_status,
        public readonly ?float $surface_area,
        public readonly ?int $construction_year,
    ) {}
}
