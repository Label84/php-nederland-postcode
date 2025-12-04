<?php

namespace Label84\NederlandPostcode\Exceptions;

use Psr\Http\Client\ClientExceptionInterface;

class NederlandPostcodeRequestException extends NederlandPostcodeException
{
    public function __construct(ClientExceptionInterface $exception)
    {
        parent::__construct(
            $exception->getMessage(),
            $exception->getCode(),
            $exception,
        );
    }
}
