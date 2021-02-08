<?php

namespace SolarSystem;

class SolarSystem implements SolarSystems
{
    public const MASS = 333030; //Earth Mass
    private const AU = 149598000;  //kilometres
    private string $name;
    private array $planets;
    private float $totalMass = 0;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getId(): string
    {
        return hash('sha256', $this->name);
    }

    public function remove(string $name): SolarSystem
    {
        if (array_key_exists($name, $this->planets)) {
            unset($this->planets[$name]);
        }
        return $this;
    }

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
     * @return string
     */
    public function getMass(): string
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

    public function initializeSolarSystem(): SolarSystem
    {
        $mercury = new Planet('Mercury', 0.055, 0.4);
        $venus = new Planet('Venus', 0.815, 0.7);
        $earth = new Planet('Earth', 1, 1);
        $mars = new Planet('Mars', 0.107, 1.5);
        $jupiter = new Planet('Jupiter', 318, 5.2);
        $saturn = new Planet('Saturn', 95, 9.5);
        $uranus = new Planet('Uranus', 14, 19.2);
        $neptune = new Planet('Neptune', 17, 30.1);

        $this->add($mercury);
        $this->add($venus);
        $this->add($earth);
        $this->add($mars);
        $this->add($jupiter);
        $this->add($saturn);
        $this->add($uranus);
        $this->add($neptune);
        return $this;
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

    public function addMassOfNewPlanet(Planet $planet)
    {
        $this->totalMass += $planet->getMass();
        return $this->totalMass;
    }
}

