# Nederland Postcode PHP

![Nederland Postcode API](./docs/nederlandpostcodeapi.png)

Nederland Postcode PHP makes it easy to integrate Dutch address validations into your PHP application using the [Nederland Postcode API](https://nederlandpostcode.nl).

Register for free to obtain a **test API key** at [nederlandpostcode.nl](https://nederlandpostcode.nl) to get started.

- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
  - [Address Endpoint](#address-endpoint)
    - [Single Address](#single-address)
    - [Multiple Addresses](#multiple-addresses)
  - [Quota Endpoint](#quota-endpoint)
- [Error Handling](#error-handling)

## Requirements

- PHP 8.2+

## Installation

Install the package via Composer:

```bash
composer require label84/php-nederland-postcode
```

## Usage

```php
require_once __DIR__ . '/vendor/autoload.php';

use Label84\NederlandPostcode\NederlandPostcodeClient;

$client = new NederlandPostcodeClient(
    key: 'npa_live_XXX',
);

try {
    $address = $client->find(
        postcode: '1118BN',
        number: 800,
        addition: ['coordinates'],
    );
} catch (NederlandPostcodeException $exception) {
    // handle exception
}

echo $address->street; // Schiphol Boulevard
echo $address->coordinates->latitude; // 52.30703569036619
```

### Address Endpoint

The address endpoint allows you to fetch address information from the Nederland Postcode API.

You can search addresses using either the `find` method for a single address or the `list` method for multiple addresses. The `find` method will throw an exception if no address is found or if multiple addresses are found for the given postcode and house number (ie. when the house number has multiple additions like A, B, C, etc.).

The following optional attributes can be requested to be included in the response:

- `coordinates`: Includes latitude and longitude of the address.

#### Single Address

To fetch a single address for a given postcode and house number, you can use the `find` method.

The `postcode` and `number` parameters are required. The `addition` parameter is optional.

```php
use Label84\NederlandPostcode\NederlandPostcodeClient;

$client = new NederlandPostcodeClient(
    key: 'npa_live_XXX'
);

$address = $client->find(
    postcode: '1118BN',
    number: 800,
    addition: null,
    attributes: ['coordinates']
);
```

This will return an `Address` object like this:

```php
Address {
    postcode: "1118BN",
    number: 800,
    addition: null,
    street: "Schiphol Boulevard",
    city: "Schiphol",
    municipality: "Haarlemmermeer",
    province: "Noord-Holland",
    coordinates: Coordinates {
        latitude: 52.30528553688755,
        longitude: 4.750645160863609
    }
}
```

When no address is found for the given postcode and number, an `AddressNotFoundException` is thrown. If multiple addresses are found, a `MultipleAddressesFoundException` is thrown.

#### Multiple Addresses

To fetch multiple addresses for a given postcode and house number, you can use the `list` method.

The `postcode` and `number` parameters are required. The `addition` parameter is optional.

```php
use Label84\NederlandPostcode\NederlandPostcodeClient;

$client = new NederlandPostcodeClient(
    key: 'npa_live_XXX'
);

$address = $client->list(
    postcode: '1015CN',
    number: 10,
    addition: null,
    attributes: ['coordinates']
);
```

This will return an `AddressCollection` object like this:

```php
AddressCollection {
    items: [
        Address {
            postcode: "1015CN",
            number: 10,
            addition: 'A',
            street: "Keizersgracht",
            city: "Amsterdam",
            municipality: "Amsterdam",
            province: "Noord-Holland",
            coordinates: Coordinates {
                latitude: 52.379401496779124,
                longitude: 4.889216673725493
            }
        },
        Address {
            postcode: "1015CN",
            number: 10,
            addition: 'B',
            street: "Keizersgracht",
            city: "Amsterdam",
            municipality: "Amsterdam",
            province: "Noord-Holland",
            coordinates: Coordinates {
                latitude: 52.379401496779124,
                longitude: 4.889216673725493
            }
        },
        Address {
            postcode: "1015CN",
            number: 10,
            addition: 'C',
            street: "Keizersgracht",
            city: "Amsterdam",
            municipality: "Amsterdam",
            province: "Noord-Holland",
            coordinates: Coordinates {
                latitude: 52.379401496779124,
                longitude: 4.889216673725493
            }
        },
        Address {
            postcode: "1015CN",
            number: 10,
            addition: 'D',
            street: "Keizersgracht",
            city: "Amsterdam",
            municipality: "Amsterdam",
            province: "Noord-Holland",
            coordinates: Coordinates {
                latitude: 52.379401496779124,
                longitude: 4.889216673725493
            }
        },
    ]
}
```

### Quota Endpoint

The quota endpoint allows you to check your current API usage and limits. This endpoint does not increment your usage count.

> [!NOTE]
> Values may lag behind the actual usage. They're cached for up to five minutes, so the `used` and `limit` numbers might not be fully up-to-date.

```php
use Label84\NederlandPostcode\NederlandPostcodeClient;

$client = new NederlandPostcodeClient(
    key: 'npa_live_XXX'
);

$quota = $client->usage();
```

This will return an `Quota` object like this:

```php
Quota {
    used: 1500,
    limit: 10000,
}
```

## Error Handling

The package throws a `NederlandPostcodeException` for any errors encountered during the API request. You can catch this exception to handle errors gracefully:

```php
use Label84\NederlandPostcode\Exceptions\NederlandPostcodeException;

$client = new NederlandPostcodeClient(
    key: 'npa_live_XXX'
);

try {
    $addresses = $client->find(
        postcode: 'INVALID',
        number: 123,
        addition: null,
    );
} catch (NederlandPostcodeException $exception) {
    // handle error
}
```

When calling the `find` method, if no address is found, an `AddressNotFoundException` is thrown. If multiple addresses are found, a `MultipleAddressesFoundException` is thrown.

When a network or HTTP error occurs during the API request, a `NederlandPostcodeRequestException` is thrown, which wraps the original `RequestException`.

## Contributing

```bash
./vendor/bin/phpstan analyse
```

```bash
./vendor/bin/phpunit
```

## License

[MIT](https://opensource.org/licenses/MIT)
