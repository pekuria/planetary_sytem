<?php

namespace SolarSystem;

final class AstronomicalUnit
{
    /**
     * @var float|float
     */
    private $distance;

    public function __construct(float $distance)
    {
        $this->distance = $distance;
    }
}
