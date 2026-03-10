<?php

namespace Label84\NederlandPostcode\DTO;

class District
{
    public function __construct(
        public readonly string $official,
        public readonly string $name,
    ) {}
}
