<?php

namespace SolarSystem;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PlanetTest extends TestCase
{
    public function createPlanetDataProvider(): array
    {
        return [
            "Valid value" => ['pluto', 10, 20, true],
            "invalid mass" => ['pluto', -10, 20, false],
            "invalid distance" => ['pluto', 10, -20, false]
        ];
    }

    /**
     * @dataProvider createPlanetDataProvider
     * @param string $planetName
     * @param float $mass
     * @param float $distance
     * @param bool $result
     */
    public function testThatObjectIsCreatedWithOnlyValidValues(string $planetName, float $mass, float $distance, bool $result): void
    {
        if (!$result) {
            $this->expectException(InvalidArgumentException::class);
        }
        $pluto = new Planet($planetName, $mass, $distance);

        if ($pluto) {
            self::assertInstanceOf(Planet::class, $pluto);
        }
    }

}
