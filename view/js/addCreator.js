function isValid() {
    
    var flag = true;
    var NameErr = document.getElementById("NameErr");
    var dobErr = document.getElementById("dobErr");
    var channelLinkErr = document.getElementById("channelLinkErr");
    var ratingErr = document.getElementById("ratingErr");
    var imgErr = document.getElementById("imgErr");

    var Name = document.forms["creatorForm"]["cname"].value;
    var dob = document.forms["creatorForm"]["dob"].value;
    var channelLink = document.forms["creatorForm"]["channelLink"].value;
    var imgLink = document.forms["creatorForm"]["img"].value;
    var rating = document.forms["creatorForm"]["rating"].value;
    var review = document.forms["creatorForm"]["review"].value;

    NameErr.innerHTML = "";
    lastNameErr.innerHTML = "";
    imgErr.innerHTML = "";
    dobErr.innerHTML = "";
    ratingErr.innerHTML = "";
    reviewErr.innerHTML = "";

    if (Name == "") {
        NameErr.innerHTML = "First name can not be empty!";
        window.alert("Name cannot be empty");
        flag = false;
        
    }
    if (imgLink == "") {
        imgErr.innerHTML = "Enter an Image Link";
        flag = false;
    }
    if (dob == "") {
        dobErr.innerHTML = "Select Date of Birth";
        flag = false;
    }

    if (channelLink == "") {
        channelLinkErr.innerHTML = "Enter a valid channelLink address!";
        flag = false;
    }
    if (rating == "") {
        ratingErr.innerHTML = "Enter a rating";
        flag = false;
    }
    if (review =="") {
        reviewErr.innerHTML = "Enter a review";
        flag = false;
    }
    return flag;
}

function submitForm(cForm){
    var valid=isValid(cForm);
    if(valid){
        var xhttp=new XMLHttpRequest();
        xhttp.onload=function(){
        xhttp.open("POST","../controller/creatorAction.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("name="+cForm.name.value,"dob="+cForm.dob.value,"channelLink="+cForm.channelLink.value,"img="+cForm.imgLink.value,"rating="+cForm.rating.value,"review="+cForm.review.value);
        }
    }
    else{
        window.alert("Please fill all the fields");
    }
}