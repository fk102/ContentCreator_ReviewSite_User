function isValid() {
    var flag = true;
    var firstNameErr = document.getElementById("firstNameErr");
    var lastNameErr = document.getElementById("lastNameErr");
    var genderErr = document.getElementById("genderErr");
    var dobErr = document.getElementById("dobErr");
    var emailErr = document.getElementById("emailErr");
    var usernameErr = document.getElementById("usernameErr");
    var passwordErr = document.getElementById("passwordErr");

    var firstName = document.forms["registrationForm"]["firstname"].value;
    var lastName = document.forms["registrationForm"]["lastname"].value;
    var gender = document.forms["registrationForm"]["gender"].value;
    var dob = document.forms["registrationForm"]["dob"].value;
    var email = document.forms["registrationForm"]["email"].value;
    var username = document.forms["registrationForm"]["username"].value;
    var password = document.forms["registrationForm"]["password"].value;

    firstNameErr.innerHTML = "";
    lastNameErr.innerHTML = "";
    genderErr.innerHTML = "";
    dobErr.innerHTML = "";
    emailErr.innerHTML = "";
    usernameErr.innerHTML = "";
    passwordErr.innerHTML = "";

    if (firstName === "") {
        firstNameErr.innerHtml = "First name can not be empty!";
        flag = false;
    }
    if ($lastName === "") {
        lastNameErr.innerHtml = "Last name can not be empty!";
        flag = false;
    }
    if (gender === "") {
        genderErr.innerHTML = "Select gender";
        flag = false;
    }
    if (dob === "") {
        dobErr.innerHTML = "Select Date of Birth";
        flag = false;
    }

    if (email === "") {
        emailErr.innerHTML = "Enter a valid email address!";
        flag = false;
    }
    if (username === "") {
        usernameErr.innerHTML = "Enter a username";
        flag = false;
    }
    if (password === "") {
        passwordErr.innerHTML = "Enter a password";
        flag = false;
    }
    return flag;
}

function submitForm(uForm){
    var valid=isValid(uForm);
    if(valid){
        var xhttp=new XMLHttpRequest();
        xhttp.onload=function(){
        xhttp.open("POST","UserAction.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("firstname="+uForm.firstname.value,"lastname="+uForm.lastname.value,"gender="+uForm.gender.value,"dob="+uForm.dob.value,"email="+uForm.email.value,"username="+uForm.username.value,"password="+uForm.password.value);
        }
    }
}