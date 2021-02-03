<?php

namespace SolarSystem;

use PHPUnit\Framework\TestCase;

class SolarSystemTest extends TestCase
{
    private $solarSystem;

    public function setup(): void
    {
        $this->solarSystem = new SolarSystem('Solar System');
        $mercury = new Planet('Mercury', 0.055, 0.4);
        $venus = new Planet('Venus', 0.815, 0.7);
        $earth = new Planet('Earth', 1, 1);
        $mars = new Planet('Mars', 0.107, 1.5);
        $jupiter = new Planet('Jupiter', 318, 5.2);
        $saturn = new Planet('Saturn', 95, 9.5);
        $uranus = new Planet('Uranus', 14, 19.2);
        $neptune = new Planet('Neptune', 17, 30.1);

        $this->solarSystem->add($mercury);
        $this->solarSystem->add($venus);
        $this->solarSystem->add($earth);
        $this->solarSystem->add($mars);
        $this->solarSystem->add($jupiter);
        $this->solarSystem->add($saturn);
        $this->solarSystem->add($uranus);
        $this->solarSystem->add($neptune);
    }

    public function findPlanetDataProvider(): array
    {
        $earth = new Planet('Earth', 1, 1);
        return [
            ['Earth', $earth],
            ['PlanetX', 'This planet does not exist']
        ];
    }

    /**
     * @dataProvider findPlanetDataProvider
     * @param string $planetName
     * @param mixed Planet|string $expectedOutcome
     */
    public function testThatFindReturnsAnExisting(string $planetName, $expectedOutcome): void
    {
        $this->assertEquals($expectedOutcome, $this->solarSystem->find($planetName));
    }

//    public function testThatAddingPlanetIncreasePlanetCount() : void
//    {
//        $planetX = new Planet('PlanetX', 1, 1);
//        $existingNoPlanets = $this->solarSystem->getNoPlanets();
//        $this->solarSystem->add($planetX);
//        $this->assertEquals($existingNoPlanets +1, $this->solarSystem->getNoPlanets());
//    }

    public function testThatNewPlanetsMassIsAddedToTotalMassOfSolarSystem() : void
    {
        $existingTotalMass = (int)$this->solarSystem->getMass();
        $planetX = new Planet('PlanetX', 10, 10);
        $this->solarSystem->add($planetX);
        $this->assertEquals($existingTotalMass + 10, (int)$this->solarSystem->getMass());
    }

}
