function changeInteractiveModuleValue(value){
    let moduleName = this.name;
    console.log(moduleName);
    let formData = new FormData();
    let req = new XMLHttpRequest();
    formData.append("name", moduleName);
    formData.append("value", value.target.value);
    req.open("POST", '/appRoomModuleInteractiveSetValue');
    req.send(formData)
}
function getCityModule()
{
    let response = fetch('/appRoomCityModuleStatus');
    response.then(response => response.json())
        .then(data => updateCityInformation(data));
}


function updateCityInformation(cityInformation){
    var cityModule = `
                                <div style="font-size: 200%">${cityInformation.name}</div>
                                <div style="font-size: 120%">🌡${cityInformation.value}°C</div>`
    document.getElementById("cityModule").innerHTML = cityModule;

}


function getAllModuleInteractive()
{
    let response = fetch('/appRoomModuleStatus');
    response.then(response => response.json())
        .then(data => updateAllInteractive(
            data.filter(object => object["type"] === "appModules\\ModuleInteractiveRadiator"
            )));
}


function getAllRooms()
{
    let response = fetch('/appRoomModuleStatus');
    response.then(response => response.json())
        .then(data => updateAllRooms(
            data.filter(object => object["type"] === "appModules\\RoomTemperatureModule"
            )));
}
function updateAllRooms(listOfRooms){
    var slideshow = document.getElementById("slideshow");
    for (var key in listOfRooms) {
        var room = listOfRooms[key];
        var roomStatus = document.createElement("div");
        roomStatus.className = "roomStatus";
        var title = document.createElement("div");
        title.style.fontSize = "150%";
        title.innerHTML = room.name;
        var temperature = document.createElement("div");
        temperature.style.fontSize = "120%";
        temperature.innerHTML = "🌡" + room.value + "°C";

        if(slideshow.getElementsByClassName("roomStatus").length == 0){
            roomStatus.style.display = "block";
        }
        roomStatus.appendChild(title);
        roomStatus.appendChild(temperature);
        slideshow.appendChild(roomStatus);


    }
}
function updateAllInteractive(listOfModules){
    for (var key in listOfModules) {
        var module = listOfModules[key];
        var moduleObject = document.createElement("div");
        moduleObject.className = "moduleObject";
        var moduleTitle = document.createElement("div");
        moduleTitle.className = "moduleTitle";
        moduleTitle.innerHTML = module.name;
        var moduleIcon = document.createElement("img");
        moduleIcon.className = "moduleIcon";
        moduleIcon.src = module.icon;
        var moduleValue = document.createElement("input");
        moduleValue.className = "moduleValue center";
        moduleValue.type = module.inputType;
        moduleValue.min = module.min;
        moduleValue.max = module.max;
        moduleValue.value = module.value;
        moduleValue.addEventListener("change", changeInteractiveModuleValue);
        moduleValue.name = module.name;
        moduleObject.appendChild(moduleTitle);
        moduleObject.appendChild(moduleIcon);
        moduleObject.appendChild(moduleValue);
        document.getElementById("moduleList").appendChild(moduleObject);
    }

    console.log(listOfModules);
}
function startTime() {
    const today = new Date();
    let h = today.getHours();
    let m = today.getMinutes();
    let s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =  h + ":" + m + ":" + s;
    setTimeout(startTime, 1000);
}

function checkTime(i) {
    if (i < 10) {i = "0" + i}
    return i;
}

getAllRooms();
getAllModuleInteractive();
getCityModule();
var slideshow = document.getElementById("slideshow");
var rooms = slideshow.getElementsByClassName("roomStatus");
var i = 0;
setInterval(function() {
    rooms[i].style.display = "none";
    i = (i + 1) % rooms.length;
    rooms[i].style.display = "block";
}, 3000);
startTime()