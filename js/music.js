var listOfSongs = []
// get current page from GET parameter
let params = new URLSearchParams(document.location.search);
let page = params.get("page");
var maxPage = 1;
if(page == null)
{
    page = 1;
}
getNumberOfPages();
updatePageNumber();

function htmlEscape(str){
    return str.replace(/[&<>'"]/g,x=>'&#'+x.charCodeAt(0)+';')
}

function deleteSong(songName)
{
    let response = fetch('/music/deleteSong/' + songName);
    // get data from promise
    response.then(response => response.json())
        .then(data => updateSongsList(data));
    getSongsByPage();


}

function getNumberOfPages(){
    let response = fetch('/music/appListOfAllSongsPages');
    response.then(response => response.json())
        .then(data => updateGlobalInformation(data));
}

function updateGlobalInformation(data)
{
    maxPage = data["totalPages"];
    updatePageNumber();
}

function getSongsByPage()
{
    let response = fetch('/music/appListOfSongsByPage/' + page);
    response.then(response => response.json())
        .then(data => updateSongsList(data["songs"]));
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
                <div class="button songButton" id="${htmlEscape(song.songName)}">
                    <a href="musicPlayer.html?songName=${htmlEscape(song.songName)}" id="songButton" class="whiteFont noTextDecoration">
                        ${htmlEscape(song.songName)}
                    </a>
                    <div class="button" onclick="deleteSong('${htmlEscape(song.songName)}')">X</div>
                </div>
                    `;
        songsListDiv.appendChild(songDiv);
    }
}



function prevPage() {
    if (page > 1) {
        page--;
        updatePageNumber();
    }
}

function nextPage() {
    if (page < maxPage) {
        page++;
        updatePageNumber();
    }
}

function updatePageNumber() {
    getSongsByPage();
    let pageNumber = document.getElementById("page-number");
    pageNumber.innerHTML = "Page " + page + " of " + maxPage + "";
}
