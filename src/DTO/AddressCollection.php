<?php

namespace Label84\NederlandPostcode\DTO;

use ArrayIterator;
use Countable;
use IteratorAggregate;

/** @implements IteratorAggregate<Address> */
class AddressCollection implements IteratorAggregate, Countable
{
    /** @var Address[] */
    protected array $items = [];

    /** @param Address[] $items */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /** @return Address[] */
    public function all(): array
    {
        return $this->items;
    }

    public function count(): int
    {
        return count($this->items);
    }

    /** @return ArrayIterator<int, Address> */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }
}
