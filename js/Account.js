var user = getMyUser();
console.log(user);
function htmlEscape(str){
    return str.replace(/[&<>'"]/g,x=>'&#'+x.charCodeAt(0)+';')
}

getMyUser().then(function (user) {
    if (user.result === "Error"){
        navigateTo('smarthouse/Login.html')
    }
    else{
        document.getElementById('name').innerHTML = htmlEscape(user.user.name);
        document.getElementById('email').innerHTML = htmlEscape(user.user.email);

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

document.getElementById('editButton').addEventListener('click', function () {
    // check if emailInput is already there
    if (document.getElementById("emailInputText") !== null){
        return;
    }
    console.log("change email");
    var email = document.createElement("input");
    email.setAttribute("type", "email");
    email.setAttribute("id", "email");
    email.setAttribute("id", "emailInputText");
    email.setAttribute("pattern", "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$");

    document.getElementById("emailInput").appendChild(email);

    email.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            var newEmail = document.getElementById("emailInputText").value;
            var username = document.getElementById("name").innerHTML;
            console.log(newEmail)
            console.log(username)
            // check if email is valid
            if(!newEmail.match("[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$")){
                alert("Invalid email address");
                return;
            }
            let req = new XMLHttpRequest();
            let formData = new FormData();
            formData.append("username", username);
            formData.append("newEmail", newEmail);
            req.open("POST", '/appUserEmailChange');
            req.send(formData);
            document.getElementById("emailInput").removeChild(document.getElementById("emailInputText"));
            document.getElementById("email").innerHTML = htmlEscape(newEmail);



        }
    });
});