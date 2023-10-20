<?php


// system imports

include 'frameworkFiles/HTTPRequest.php';
include 'frameworkFiles/HeaderHTTPRequest.php';
include 'frameworkFiles/HTTPResponse.php';
include 'frameworkFiles/WebEntityCustom.php';
include 'frameworkFiles/HeaderHTTPResponse.php';
include 'frameworkFiles/HTTPReceivedData.php';
include 'frameworkFiles/Templater.php';
include 'frameworkFiles/Router.php';
include 'frameworkFiles/Logging.php';
include 'frameworkFiles/HTTPForm.php';
include 'frameworkFiles/User.php';
include 'frameworkFiles/Database.php';
include 'frameworkFiles/DatabaseObject.php';
include 'frameworkFiles/JSONDatabase.php';
include 'frameworkFiles/User/authToken.php';
$database = new JSONDatabase("database.json");
$host = 'localhost';
$port = 80;

// user imports

include 'appModules/Module.php';
include 'appModules/Modules.php';
include 'appModules/TemperatureModule.php';
include 'appModules/RoomTemperatureModule.php';
include 'appModules/ModuleInteractive.php';
include 'appModules/ModuleInteractiveRadiator.php';
include 'appModules/CityModule.php';
include 'musicPlayer/Song.php';



// user settings

use appModules\CityModule;
use appModules\ModuleInteractiveRadiator;
use appModules\Modules;
use appModules\RoomTemperatureModule;


$KitchenModule = new RoomTemperatureModule();
$KitchenModule->name = "Kitchen";
$KitchenModule->description = "This is the kitchen";
$KitchenModule->icon = "icon";
$KitchenModule->value = "24";

$BedroomModule = new RoomTemperatureModule();
$BedroomModule->name = "Bedroom";
$BedroomModule->description = "This is the bedroom";
$BedroomModule->icon = "icon";
$BedroomModule->value = "22";

$BathroomModule = new RoomTemperatureModule();
$BathroomModule->name = "Bathroom";
$BathroomModule->description = "This is the bathroom";
$BathroomModule->icon = "icon";
$BathroomModule->value = "20";

$BedroomRadiatorModule = new ModuleInteractiveRadiator();
$BedroomRadiatorModule->name = "Bedroom Radiator";
$BedroomRadiatorModule->inputType = "range";
$BedroomRadiatorModule->description = "This is the bedroom radiator";
$BedroomRadiatorModule->icon = "/files/radiator.png";
$BedroomRadiatorModule->value = 3;
$BedroomRadiatorModule->min = 1;
$BedroomRadiatorModule->max = 5;

$AllModules = new Modules();
$AllModules->addModule($KitchenModule);
$AllModules->addModule($BedroomModule);
$AllModules->addModule($BathroomModule);
$AllModules->addModule($BedroomRadiatorModule);

$PrahaCity = new CityModule();
$PrahaCity->name = "Praha";
$PrahaCity->description = "This is the city of Prague";
$PrahaCity->icon = "icon";
$PrahaCity->updateUsingAPI();
