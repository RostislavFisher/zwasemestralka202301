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
                if(response["comment"]=="UserExists"){
                    alert("User already exists");
                }
                else{
                    console.log("Registration failed")
                }
            }
        }
    };

}
let RegistrationForm = document.getElementById("RegistrationForm");
RegistrationForm.addEventListener("submit", (e) => {
    e.preventDefault();
    var password = document.getElementById("password").value;
    document.getElementById("mustContainLowerCase").style = "color:green"
    document.getElementById("mustContainUpperCase").style = "color:green"
    document.getElementById("mustContainNumbers").style = "color:green"

    if(!(new RegExp("[a-z]").test(password))){
        document.getElementById("mustContainLowerCase").style = "color:red"
    }
    if(!(new RegExp("[A-Z]").test(password))){
        document.getElementById("mustContainUpperCase").style = "color:red"
    }
    if(!(new RegExp("[0-9]").test(password))){
        document.getElementById("mustContainNumbers").style = "color:red"
    }
    if(new RegExp("[a-z]").test(password) && new RegExp("[A-Z]").test(password) && new RegExp("[0-9]").test(password)){
        Registration();

    }


})
