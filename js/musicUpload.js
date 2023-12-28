function uploadMusic() {
    var x = document.getElementById("fileToUpload").value;
    if (x == "") {
        alert("Select music to upload");
        return false;
    }
    let song = document.getElementById("fileToUpload").files[0];
    let songName = document.getElementById("songName");
    let req = new XMLHttpRequest();
    let formData = new FormData();
    formData.append("song", song);
    formData.append("songName", songName.value);
    req.open("POST", '/appUploadSong');
    req.send(formData);
    // window.location.href = "/smarthouse/music.html";
    req.onreadystatechange = function () {
        if (req.readyState === 4) {
            let response = JSON.parse(req.responseText);
            if (response.result === "OK") {
                window.location.href = "/smarthouse/music.html";
            }
            else if (response.comment === "Invalid song name")
            {
                alert("Invalid song name");
            }
            else {
                alert("Error");
            }
        }
    }

}
function songUploaded(){
    let input = document.getElementById('fileToUpload');
    let songName = document.getElementById("songName");
    songName.value = input.files[0].name.split(".")[0];
}
let musicForm = document.getElementById("musicForm");
console.log(musicForm)

musicForm.addEventListener("submit", (e) => {
    e.preventDefault();
    uploadMusic();

})
document.getElementById("fileToUpload").addEventListener("change", songUploaded);
