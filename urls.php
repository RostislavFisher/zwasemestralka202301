<?php

use appModules\appRoomCityModuleStatus;
use appModules\appRoomModuleStatus;

include 'frameworkFiles/Path.php';
include 'appMainPage/appMainPage.php';
include 'appTemperature/Temperature.php';
include 'frameworkFiles/WebEntityStatic.php';
include 'frameworkFiles/WebEntityStaticPage.php';
include 'frameworkFiles/WebEntityFile.php';
include 'frameworkFiles/User/UserRegistration.php';
include 'frameworkFiles/User/UserLogin.php';
include 'frameworkFiles/User/getMyUser.php';
include 'musicPlayer/appListOfAllSongs.php';
include 'appMusicPlayer/appMusicPlayer.php';
include 'appModules/appRoomModuleStatus.php';
include 'appModules/appRoomModuleInteractiveSetValue.php';
include 'appModules/appRoomCityModuleStatus.php';
include 'appModules/appRoomCityModulesStatusByPages.php';
include 'appMusicPlayer/appUploadSong.php';
include 'appMusicPlayer/appDeleteSong.php';
include 'appUser/appUserEmailChange.php';
include 'musicPlayer/appListOfAllSongsPages.php';
include 'musicPlayer/appListOfSongsByPage.php';

$urlpatterns = [
    new Path('/', new WebEntityFile('smarthouse/main.html')),
    new Path('/files/{file}', new WebEntityStatic("/files/")),
    new Path('/css/{file}', new WebEntityStatic("/css/")),
    new Path('/js/{file}', new WebEntityStatic("/js/")),
    new Path('/PHPCompile/{file}', new WebEntityStaticPage("/PHPCompile/")),
    new Path('/smarthouse/{file}', new WebEntityStaticPage("/smarthouse/")),
    new Path('/songs/{file}', new WebEntityStatic("/songs/")),
    new Path('/temperature', new Temperature()),
    new Path('/music/appListOfAllSongs', new appListOfAllSongs()),
    new Path('/music/player/{name}', new appMusicPlayer()),
    new Path('/music/deleteSong/{name}', new appDeleteSong()),
    new Path('/music/appListOfAllSongsPages', new appListOfAllSongsPages()),
    new Path('/music/appListOfSongsByPage/{page}', new appListOfSongsByPage()),
    new Path('/appRoomModuleStatus', new appRoomModuleStatus()),
    new Path('/appRoomModuleInteractiveSetValue', new appRoomModuleInteractiveSetValue()),
    new Path('/appRoomCityModuleStatus', new appRoomCityModuleStatus()),
    new Path('/appUploadSong', new appUploadSong()),
    new Path('/userRegistration', new UserRegistration()),
    new Path('/userLogin', new UserLogin()),
    new Path('/getMyUser', new getMyUser()),
    new Path('/appUserEmailChange', new appUserEmailChange()),
    new Path('/appRoomCityModulesStatusByPages/{page}', new appRoomCityModulesStatusByPages()),
];

