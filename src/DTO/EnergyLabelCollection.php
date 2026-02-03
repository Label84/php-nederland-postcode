<?php

namespace Label84\NederlandPostcode\DTO;

use ArrayIterator;
use Countable;
use IteratorAggregate;

/** @implements IteratorAggregate<EnergyLabel> */
class EnergyLabelCollection implements IteratorAggregate, Countable
{
    /** @var EnergyLabel[] */
    protected array $items = [];

    /** @param EnergyLabel[] $items */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /** @return EnergyLabel[] */
    public function all(): array
    {
        return $this->items;
    }

    public function count(): int
    {
        return count($this->items);
    }

    /** @return ArrayIterator<int, EnergyLabel> */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }
}
