<?php

namespace SolarSystem;

use InvalidArgumentException;

class Planet
{
    private $name;
    private $mass;
    private $distanceFromSun;

    /**
     * Planet constructor.
     * @param string $name
     * @param float $mass
     * @param float $distanceFromSun
     */
    public function __construct(string $name, float $mass, float $distanceFromSun)
    {
        $this->name = strtolower($name);
        $this->setMass($mass);
        $this->setDistance($distanceFromSun);
    }

    /**
     * @param float $distance distance in AU
     * @return void
     * @throws InvalidArgumentException when distance is less than 0 AU
     */
    public function setDistance(float $distance): void
    {
        if ($distance < 0) {
            throw new InvalidArgumentException(
                'Distance not be a negative number'
            );
        }
        $this->distanceFromSun = $distance;
    }

    /**
     * @return float
     */
    public function getMass(): float
    {
        return $this->mass;
    }

    /**
     * @param float $mass Mass in Earth Mass
     * @return void
     * @throws InvalidArgumentException when mass is less than 0 Earth Mass
     */
    public function setMass(float $mass): void
    {
        if ($mass < 0) {
            throw new InvalidArgumentException(
                'Mass can be a negative number'
            );
        }
        $this->mass = $mass;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }

    public function getDistanceFromSun()
    {
        return $this->distanceFromSun;
    }

}
