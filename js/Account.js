var user = getMyUser();
console.log(user);
getMyUser().then(function (user) {
    if (user.result === "Error"){
        navigateTo('smarthouse/Login.html')
    }
    else{
        document.getElementById('name').innerHTML = user.user.name;
        document.getElementById('email').innerHTML = user.user.email;

    }

});

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
