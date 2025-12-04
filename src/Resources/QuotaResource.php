<?php

namespace Label84\NederlandPostcode\Resources;

use Label84\NederlandPostcode\DTO\Quota;
use Label84\NederlandPostcode\Factories\QuotaFactory;

class QuotaResource extends BaseResource
{
    public function get(): Quota
    {
        // @phpstan-ignore-next-line
        return QuotaFactory::make($this->request(
            method: 'GET',
            path: 'quota',
        ));
    }
}
