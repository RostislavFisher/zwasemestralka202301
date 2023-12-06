function deleteCookies() {
    var Cookies = document.cookie.split(';');
    console.log(Cookies)
    for (var i = 0; i < Cookies.length; i++)
        document.cookie = Cookies[i] + "=;expires=" + new Date(0).toUTCString();
    navigateTo('smarthouse/index.html')
}

async function getMyUser()
{
    let response = await fetch('/getMyUser');
    let data = response.json();
    return data;
}

function navigateTo(page) {
    getMyUser().then(function (user) {
        if (user.result === "Error"){
            document.getElementById('pages').src = "/smarthouse/Login.html";
        }
        else{
            document.getElementById('pages').src = page;

        }

    });
}

var user = getMyUser();
console.log(user);
getMyUser().then(function (user) {
    if (user.result === "Error"){
        navigateTo('smarthouse/Login.html')
    }

});