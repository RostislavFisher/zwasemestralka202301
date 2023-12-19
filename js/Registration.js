function Registration(){
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let req = new XMLHttpRequest();
    let formData = new FormData();
    formData.append("name", name);
    formData.append("email", email);
    formData.append("password", password);
    req.open("POST", '/userRegistration');
    req.send(formData);
    req.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(req.responseText);
            if(response["result"] === "OK"){
                window.location.href = "/smarthouse/index.html";
            }
            else{
                alert("Registration failed");
            }
        }
    };

}
let RegistrationForm = document.getElementById("RegistrationForm");
RegistrationForm.addEventListener("submit", (e) => {
    e.preventDefault();
    Registration();

})
