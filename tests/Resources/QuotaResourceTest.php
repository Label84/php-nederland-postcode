<?php

namespace Label84\NederlandPostcode\Tests\Resources;

use Label84\NederlandPostcode\DTO\Quota;
use Label84\NederlandPostcode\Tests\TestCase;

class QuotaResourceTest extends TestCase
{
    public function test_get(): void
    {
        $result = $this->client
            ->quota()
            ->get();

        $this->assertInstanceOf(Quota::class, $result);

        $this->assertEquals(1500, $result->used);
        $this->assertEquals(10000, $result->limit);
    }
}
