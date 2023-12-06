var listOfSongs = []
getAllSongs();

function deleteSong(songName)
{
    let response = fetch('/music/deleteSong?songName=' + songName);
    // get data from promise
    response.then(response => response.json())
        .then(data => updateSongsList(data));
}

function getAllSongs()
{
    let response = fetch('/music/appListOfAllSongs');
    response.then(response => response.json())
        .then(data => updateSongsList(data));
}

function updateSongsList(songsList)
{
    let songsListDiv = document.getElementById("songsList");
    songsListDiv.innerHTML = "";
    for(let i = 0; i < songsList.length; i++)
    {
        let song = songsList[i];
        console.log(song)
        let songDiv = document.createElement("div");
        songDiv.className = "center";
        songDiv.innerHTML = `
                <div class="button songButton">
                    <a href="musicPlayer.html?songName=${song.songName}" id="songButton" class="whiteFont noTextDecoration">
                        ${song.songName}
                    </a>
                    <div class="button" onclick="deleteSong('${song.songName}')">X</div>
                </div>
                    `;
        songsListDiv.appendChild(songDiv);
    }
}