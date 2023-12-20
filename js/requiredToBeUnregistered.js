async function getMyUser()
{
    let response = await fetch('/getMyUser');
    let data = response.json();
    return data;
}

var user = getMyUser();
getMyUser().then(function (user) {
    if (user.result === "Error"){
    }
    else{
        window.location.href = '/smarthouse/index.html'
    }

});