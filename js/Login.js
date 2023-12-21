function Login(){
    let name = document.getElementById("name").value;
    let password = document.getElementById("password").value;
    let req = new XMLHttpRequest();
    let formData = new FormData();
    formData.append("name", name);
    formData.append("password", password);
    req.open("POST", '/userLogin');
    req.send(formData);
    req.onreadystatechange = function () {
        if (req.readyState === 4 && req.status === 200) {
            let response = JSON.parse(req.responseText);
            if (response.result === "OK"){
                document.getElementById("successfullyLogged").style.display="unset";
                window.location.href = "/smarthouse/index.html";
            }
            else{
                alert("Wrong name or password");
            }
        }
    }

}

let LoginForm = document.getElementById("LoginForm");
LoginForm.addEventListener("submit", (e) => {
    e.preventDefault();
    Login();

})