<?php
namespace SolarSystem;

use InvalidArgumentException;

class Planet
{
    private $name;
    private $mass;
    private $distanceFromSun;

    public function __construct(string $name, float $mass, float $distanceFromSun)
    {
        $this->name = $name;
        $this->setMass($mass);
        $this->setDistance($distanceFromSun);
    }

    public function getMass()
    {
        return $this->mass;
    }

    public function getDistanceFromSun()
    {
        return $this->distanceFromSun;
    }

    /**
     * @param float $mass Mass in Earth Mass
     * @return void
     * @throws InvalidArgumentException when mass is less than 0 Earth Mass
     */
    public function setMass(float $mass) : void
    {
        if ($mass < 0) {
            throw new InvalidArgumentException(
                'Mass can only be greater than 0 Earth Mass'
            );
        }
        $this->mass = $mass;
    }

    /**
     * @param float $distance distance in AU
     * @return void
     * @throws InvalidArgumentException when distance is less than 0 AU
     */
    public function setDistance(float $distance) :void
    {
        if ($distance < 0) {
            throw new InvalidArgumentException(
                'Distance can only be greater than 0 AU'
            );
        }
        $this->distanceFromSun = $distance;
    }

    public function __toString() : string
    {
        return $this->name;
    }
}
