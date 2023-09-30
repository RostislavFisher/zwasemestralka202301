<?php

use appModules\appRoomCityModuleStatus;
use appModules\appRoomModuleStatus;

include 'frameworkFiles/Path.php';
include 'appMainPage/appMainPage.php';
include 'appTemperature/Temperature.php';
include 'frameworkFiles/WebEntityStatic.php';
include 'frameworkFiles/WebEntityFile.php';
include 'musicPlayer/appListOfAllSongs.php';
include 'appMusicPlayer/appMusicPlayer.php';
include 'appModules/appRoomModuleStatus.php';
include 'appModules/appRoomCityModuleStatus.php';
include 'appMusicPlayer/appUploadSong.php';

$urlpatterns = [
    new Path('/', new WebEntityFile('smarthouse/main.html')),
    new Path('/files/{file}', new WebEntityStatic()),
    new Path('/smarthouse/{file}', new WebEntityStatic()),
    new Path('/songs/{file}', new WebEntityStatic()),
    new Path('/temperature', new Temperature()),
    new Path('/music/appListOfAllSongs', new appListOfAllSongs()),
    new Path('/music/player/{name}', new appMusicPlayer()),
    new Path('/appRoomModuleStatus', new appRoomModuleStatus()),
    new Path('/appRoomCityModuleStatus', new appRoomCityModuleStatus()),
    new Path('/appUploadSong', new appUploadSong()),
];

