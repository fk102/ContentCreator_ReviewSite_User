function isValid() {
    var flag = true;
    var firstNameErr = document.getElementById("firstNameErr");
    var lastNameErr = document.getElementById("lastNameErr");
    var genderErr = document.getElementById("genderErr");
    var dobErr = document.getElementById("dobErr");
    var emailErr = document.getElementById("emailErr");
    var usernameErr = document.getElementById("usernameErr");
    var passwordErr = document.getElementById("passwordErr");

    var firstName = document.forms["editForm"]["firstname"].value;
    var lastName = document.forms["editForm"]["lastname"].value;
    var gender = document.forms["editForm"]["gender"].value;
    var dob = document.forms["editForm"]["dob"].value;
    var email = document.forms["editForm"]["email"].value;
    var username = document.forms["editForm"]["username"].value;
    var uid = document.forms["editForm"]["uid"].value;
    var password = document.forms["editForm"]["password"].value;

    firstNameErr.innerHTML = "";
    lastNameErr.innerHTML = "";
    genderErr.innerHTML = "";
    dobErr.innerHTML = "";
    emailErr.innerHTML = "";
    usernameErr.innerHTML = "";
    passwordErr.innerHTML = "";

    if (firstName === "") {
        firstNameErr.innerHtml = "Unchanged";
        flag =true;
    }
    if (lastName === "") {
        lastNameErr.innerHtml = "Unchanged";
        flag =true;
    }
    if (gender === "") {
        genderErr.innerHTML = "Unchanged";
        flag =true;
    }
    if (dob === "") {
        dobErr.innerHTML = "Unchanged";
        flag =true;
    }

    if (email === "") {
        emailErr.innerHTML = "Unchanged";
        flag =true;
    }
    if (password === "") {
        passwordErr.innerHTML = "Unchanged";
        flag =true;
    }
   
    return flag;
}

function submitForm(uForm){
    var valid=isValid(uForm);
    if(valid){
        var xhttp=new XMLHttpRequest();
        xhttp.onload=function(){
        xhttp.open("POST",uForm.action);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("firstname="+uForm.firstname.value,"lastname="+uForm.lastname.value,"gender="+uForm.gender.value,"dob="+uForm.dob.value,"email="+uForm.email.value,"username="+uForm.username.value,"password="+uForm.password.value,"uid="+uForm.uid.value);
        }
    }
}