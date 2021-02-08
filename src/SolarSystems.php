<?php

namespace SolarSystem;

interface SolarSystems
{
    public function add(Planet $planet);

    public function find(string $planetName);
}
