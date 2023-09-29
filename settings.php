<?php


// system imports

include 'frameworkFiles/HTTPRequest.php';
include 'frameworkFiles/HeaderHTTPRequest.php';
include 'frameworkFiles/HTTPResponse.php';
include 'frameworkFiles/WebEntityCustom.php';
include 'frameworkFiles/HeaderHTTPResponse.php';
include 'frameworkFiles/Templater.php';
include 'frameworkFiles/Router.php';
include 'frameworkFiles/Logging.php';


// user imports

include 'appModules/Module.php';
include 'appModules/Modules.php';
include 'appModules/TemperatureModule.php';
include 'appModules/RoomTemperatureModule.php';
include 'musicPlayer/Song.php';



// user settings

use appModules\Modules;
use appModules\RoomTemperatureModule;


$KitchenModule = new RoomTemperatureModule();
$KitchenModule->name = "Kitchen";
$KitchenModule->description = "This is the kitchen";
$KitchenModule->icon = "icon";
$KitchenModule->value = "value";

$BedroomModule = new RoomTemperatureModule();
$BedroomModule->name = "Bedroom";
$BedroomModule->description = "This is the bedroom";
$BedroomModule->icon = "icon";
$BedroomModule->value = "value";

$BathroomModule = new RoomTemperatureModule();
$BathroomModule->name = "Bathroom";
$BathroomModule->description = "This is the bathroom";
$BathroomModule->icon = "icon";
$BathroomModule->value = "value";

$AllModules = new Modules();
$AllModules->addModule($KitchenModule);
$AllModules->addModule($BedroomModule);
$AllModules->addModule($BathroomModule);
