<?php

namespace SolarSystem;

interface SolarSystems
{
    public function add(Planet $planet): SolarSystem;
    public function find(string $planetName);
}
