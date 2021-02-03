<?php

namespace SolarSystem;

final class SolarSystem implements SolarSystems
{
    private $name;
    private const MASS = 333030;  //Earth Mass
    private const AU = 149598000; //kilometres
    private $planets = [];
    private $totalMass = 0;
    private $totalDistance;


    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getId(): string
    {
       return hash('sha256',$this->name);
    }

    /**
     * @param Planet $planet
     * @return mixed
     */
    public function add(Planet $planet) : SolarSystem
    {
        $this->planets[(string)$planet] = $planet;
        return $this;
    }

    public function remove (string $name) : SolarSystem
    {
        if (array_key_exists($name, $this->planets)) {
            unset($this->planets[$name]);
        }
        return $this;
    }


    /**
     * @param string $planetName
     * @return mixed|Planet|string
     */
    public function find(string $planetName)
    {
        if (array_key_exists($planetName, $this->planets)) {
            return $this->planets[$planetName];
        } else {
            return 'This planet does not exist';
        }
    }

    /**
     * @return string
     */
    public function getDistance() : string
    {
        foreach($this->planets as $planet) {
            $this->totalDistance += $planet->getDistanceFromSun();
        }

        return $this->totalDistance . ' AU';
    }

    public function getDistanceInKilometres() : string
    {
        return $this->getDistance() * self::AU . ' kilometres';
    }

    /**
     * @return string
     */
    public function getMass() : string
    {
        foreach($this->planets as $planet) {
            $this->totalMass += $planet->getMass();
        }
        return (self::MASS + $this->totalMass) . ' Earth Mass';
    }

    /**
     * @return int
     */
    public function getNoPlanets() : int
    {
        return count($this->planets);
    }

}
