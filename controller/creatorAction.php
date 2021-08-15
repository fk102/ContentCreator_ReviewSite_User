<?php
require '../model/dbCreatorInsert.php';

$Name = $rating = $channelLink  = $review = $imgLink = "";
$rating = "one";
$NameErr = $ratingErr = $channelErr = $reviewErr = $dobErr = $imgErr = "";
$successfulMessage = $errorMessage = "";
$flag = false;
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $Name = $_POST['cname'];
    $dob = $_POST['dob'];
    $channelLink = $_POST['channelLink'];
    $imgLink = $_POST['imgLink'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];


    if (empty($Name)) {
        $NameErr = "Name can not be empty!";
        header("Location:../view/creatorform.php");
        $flag = true;
    }
    if (empty($dob)) {
        $dobErr = "Select Date of Birth";
        header("Location:../view/creatorform.php");
        $flag = true;
    }
    if (empty($channelLink)) {
        $channelErr = "Enter a Channel Link";
        header("Location:../view/creatorform.php");
        $flag = true;
    }
    $set = isset($rating);
    if (!$set) {
        $ratingErr = "select a rating";
        $flag = true;
    }
    if (empty($review)) {
        $review = "";
    }

    if (!$flag) {
        $Name = test_input($Name);
        $dob = test_input($dob);
        $channelLink = test_input($channelLink);
        $imgLink = test_input($imgLink);
        $review = test_input($review);
        $rating = test_input($rating);

        $result1 = register($Name, $dob, $channelLink, $rating, $review, $imgLink);
        if ($result1) {
            $successfulMessage = "Successfully saved.";
            header("Location:../view/creators2.php");
        } else {
            $errorMessage = "Error while saving.";
            echo "<script>window.alert(PLEASE FILL ALL FIELDS)</script>";
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
