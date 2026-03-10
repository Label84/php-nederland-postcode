<?php

namespace Label84\NederlandPostcode\Enums;

enum AddressAttributesEnum: string
{
    case COORDINATES = 'coordinates';
    case DISTRICT = 'district';
    case FUNCTION = 'function';
    case LOCATION_STATUS = 'location_status';
    case PROPERTY_STATUS = 'property_status';
    case SURFACE_AREA = 'surface_area';
    case CONSTRUCTION_YEAR = 'construction_year';
}
