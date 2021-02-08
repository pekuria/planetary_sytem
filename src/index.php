<?php
#!/usr/bin/php
define('CONFIRMED_NO', 1);

require_once "SolarSystems.php";
require_once "SolarSystem.php";
require_once "Planet.php";

use SolarSystem\SolarSystem;
use SolarSystem\Planet;

$error_message = 'Only positive number allowed please try again';
$solarSystem = new SolarSystem('Solar');
$solarSystem->initializeSolarSystem();

function validateInput($error_message )
{
    $value =  strtolower(trim(fgets(STDIN)));
    if ($value < 0 || !is_numeric($value)) {
        echo  $error_message ." \n";
        $value = validateInput($error_message);
    }
    return $value;
}


echo "\n Welcome to the planet discover channel\n";
while (1) {
    fputs(STDOUT, "\n" . "enter 1 for menu and 0 to exit the program, have fun: ");

    $response = strtolower(trim(fgets(STDIN)));
    switch ($response) {
        case 0:
            echo "\n", "Hope you had fun, Goodbye", "\n";
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
                echo 'This Planet already exists';
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
            echo "The mass of the solar system is . {$solarSystem->getMass()} earth masses";
            break;
        case 6:
            echo "The diameter of our solar system is . {$solarSystem->getDistance()} AU";
            break;
        default:
            echo "\n", "That option does not exit, please try again", "\n";
    }
}

