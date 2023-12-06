var url = new URL(window.location.href);
var songName = url.searchParams.get("songName");
console.log(songName);
document.getElementById("songName").innerHTML = songName;
var songPlayer = document.getElementById("songPlayer");
songPlayer.src = "/songs/" + songName + ".mp3";
songPlayer.load();
