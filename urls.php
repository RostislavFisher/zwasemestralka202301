<?php
include 'frameworkFiles/Path.php';
include 'appMainPage/mainPage.php';
include 'appTemperature/Temperature.php';
include 'frameworkFiles/WebEntityStatic.php';
include 'frameworkFiles/WebEntityFile.php';
include 'musicPlayer/listOfAllSongs.php';
include 'appMusicPlayer/appMusicPlayer.php';

$urlpatterns = [
    new Path('/', new WebEntityFile('smarthouse/main.html')),
    new Path('/files/{file}', new WebEntityStatic()),
    new Path('/smarthouse/{file}', new WebEntityStatic()),
    new Path('/songs/{file}', new WebEntityStatic()),
    new Path('/temperature', new Temperature()),
    new Path('/music/listOfAllSongs', new listOfAllSongs()),
    new Path('/music/player/{name}', new appMusicPlayer()),
];

