<?php

namespace SolarSystem;

final class SolarSystem implements SolarSystems
{
    public $id;

    public function getId(): Identity
    {
        return $this->id;
    }

    /**
     * @param SolarSystem $solarSystem
     * @return mixed
     */
    public function add(SolarSystem $solarSystem)
    {
        // TODO: Implement add() method.
    }

    /**
     * @param Identity $solarSystemId
     * @return SolarSystem
     */
    public function find(Identity $solarSystemId): SolarSystem
    {
        // TODO: Implement find() method.
    }
}
