<?php
#!/usr/bin/php
define('CONFIRMED_NO', 1);

require_once "SolarSystems.php";
require_once "SolarSystem.php";
require_once "Planet.php";

use SolarSystem\SolarSystem;
use SolarSystem\Planet;

function validateInput($error_message )
{
    $value =  strtolower(trim(fgets(STDIN)));
    if ($value < 0 || !is_numeric($value)) {
        echo  $error_message ." \n";
        $value = validateInput($error_message);
    }
    return $value;
}

function initializeSolarSystem(SolarSystem $solarSystem): SolarSystem
{
    $mercury = new Planet('Mercury', 0.055, 0.4);
    $venus = new Planet('Venus', 0.815, 0.7);
    $earth = new Planet('Earth', 1, 1);
    $mars = new Planet('Mars', 0.107, 1.5);
    $jupiter = new Planet('Jupiter', 318, 5.2);
    $saturn = new Planet('Saturn', 95, 9.5);
    $uranus = new Planet('Uranus', 14, 19.2);
    $neptune = new Planet('Neptune', 17, 30.1);

    $solarSystem->add($mercury);
    $solarSystem->add($venus);
    $solarSystem->add($earth);
    $solarSystem->add($mars);
    $solarSystem->add($jupiter);
    $solarSystem->add($saturn);
    $solarSystem->add($uranus);
    $solarSystem->add($neptune);
    return $solarSystem;
}

$error_message = "\033[33m Only positive number allowed please try again \033[39m";
$solarSystem = new SolarSystem('Solar');
initializeSolarSystem($solarSystem);


echo "\n Welcome to the planet discover channel\n";
while (1) {
    fputs(STDOUT, "\n" . "enter 1 for menu and 0 to exit the program, have fun: ");

    $response = strtolower(trim(fgets(STDIN)));
    switch ($response) {
        case 0:
            echo "\n", "\033[33m Hope you had fun, Goodbye \033[39m", "\n";
            exit();
        case 1:
            echo "\n", 'Hey what action would you like to perform
                ===================================================================
                =   0 : To exit the program                                      =
                =   1 : To view the menu                                          =  
                =   2 : View the solar system and its details                     =
                =   3 : Find a Planet                                             =
                =   4 : Add a planet                                              =
                =   5 : Get the mass of the solar system                          =
                =   6 : Get the diameter of the solar system                      =
                = =================================================================
            ', "\n";
            break;
        case 2:
            print_r($solarSystem);
            break;
        case 3:
            echo "\n" . "What planet would you like to find: " . "\n";
            $planetName = strtolower(trim(fgets(STDIN)));
            print_r($solarSystem->find($planetName));
            break;
        case 4:
            echo "\n" . "What planet would you like to add: " . "\n";
            $planetName = strtolower(trim(fgets(STDIN)));

            if ($solarSystem->find($planetName) instanceof Planet) {
                echo "\033[33m This Planet already exists \033[39m";
                break;
            }

            echo "\n" . "What is the planets mass in earth mass: " . "\n";
            $planetMass = validateInput($error_message);

            echo "\n" . "How far is the planet in AU from the sun: " . "\n";
            $planetDistance = validateInput($error_message);

            echo "\n current number of planets, mass and diameter of the solar system \n"
                . $solarSystem->getNoPlanets() . "planets  \n " .
                "\n" . $solarSystem->getMass() . " earth mass \n" .
                $solarSystem->getDistance() . " AU. \n";
            $newPlanet = new Planet($planetName, $planetMass, $planetDistance);
            $solarSystem->add($newPlanet);
            echo "\n number of planets, mass and diameter of the solar system after addition \n"
                . $solarSystem->getNoPlanets() . "planets  \n " .
                "\n" . $solarSystem->getMass() . " earth mass \n" .
                $solarSystem->getDistance() . " AU. \n";
            break;
        case 5:
            echo "The mass of the solar system is \033[32m {$solarSystem->getMass()} \033[39m earth masses";
            break;
        case 6:
            echo "The diameter of our solar system is \033[32m {$solarSystem->getDistance()} \033[39m AU";
            break;
        default:
            echo "\n", " \033[33m That option does not exit, please try again \033[39m", " \n";
    }
}

