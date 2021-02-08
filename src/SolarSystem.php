<?php

namespace SolarSystem;

class SolarSystem implements SolarSystems
{
    private const MASS = 333030; //Earth Mass
    private const AU = 149598000;  //kilometres
    private $name;
    private $planets;
    private $totalMass = 0;

    /**
     * SolarSystem constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return hash('sha256', $this->name);
    }

    /**
     * @param string $name
     * @return $this
     */
    public function remove(string $name): SolarSystem
    {
        if (array_key_exists($name, $this->planets)) {
            unset($this->planets[$name]);
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getDistanceInKilometres(): string
    {
        return $this->getDistance() * self::AU . ' kilometres';
    }

    /**
     * @return string
     */
    public function getDistance(): string
    {
        $distance_array = [];
        foreach ($this->planets as $planet) {
            $distance_array[] = $planet->getDistanceFromSun();
        }
        return max($distance_array) * 2;
    }

    /**
     * @return float
     */
    public function getMass(): float
    {
        return self::MASS + $this->totalMass;
    }

    /**
     * @return int
     */
    public function getNoPlanets(): int
    {
        return count($this->planets);
    }

    /**
     * @param Planet $planet
     * @return mixed
     */
    public function add(Planet $planet)
    {
        if (!$this->find((string)$planet) instanceof Planet) {
            $this->planets[(string)$planet] = $planet;
            $this->addMassOfNewPlanet($planet);
            return $this;
        }
        return "planet already exist";

    }

    /**
     * @param string $planetName
     * @return mixed|Planet|string
     */
    public function find(string $planetName)
    {
        if (is_array($this->planets) && array_key_exists($planetName, $this->planets)) {
            return $this->planets[$planetName];
        }

        return 'This planet does not exist';
    }

    /**
     * @param Planet $planet
     * @return float
     */
    public function addMassOfNewPlanet(Planet $planet): float
    {
        $this->totalMass += $planet->getMass();
        return $this->totalMass;
    }
}

