function isValid(uForm) {
    var flag = true;
    var firstNameErr = getElementById("firstNameErr");
    var lastNameErr = getElementById("lastNameErr");
    var genderErr = getElementById("genderErr");
    var dobErr = getElementById("dobErr");
    var emailErr = getElementById("emailErr");
    var usernameErr = getElementById("usernameErr");
    var passwordErr = getElementById("passwordErr");

    var firstname = uForm.firstname.value;
    var lastname = uForm.lastname.value;
    var gender = uForm.gender.value;
    var dob = uForm.dob.value;
    var email = uForm.email.value;
    var username = uForm.username.value;
    var password = uForm.password.value;

    firstNameErr.innerHTML = "";
    lastNameErr.innerHTML = "";
    genderErr.innerHTML = "";
    dobErr.innerHTML = "";
    emailErr.innerHTML = "";
    usernameErr.innerHTML = "";
    passwordErr.innerHTML = "";

    if (firstname === "") {
        firstNameErr.innerHtml = "First name can not be empty!";
        flag = false;
    }
    if (lastname === "") {
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
            if(this.status===200){getElementById("message").innerHTML=this.responseText;}
        }
        xhttp.open("POST","../controller/UserAction.php",true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("firstname="+uForm.firstname.value+"&lastname="+uForm.lastname.value+"&gender="+uForm.gender.value+"&dob="+uForm.dob.value+"&email="+uForm.email.value+"&username="+uForm.username.value+"&password="+uForm.password.value);
    }
}
