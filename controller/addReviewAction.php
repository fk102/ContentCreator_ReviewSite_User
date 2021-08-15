<?php


$Name = $rating = $channelLink = $rating = $review = "";
$NameErr = $ratingErr = $channelErr = $ratingErr = $dobErr = "";
$successfulMessage = $errorMessage = "";
$flag = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $rating = $_POST['rating'];
    $review = $_POST['review'];
    $cname = $_POST['cname'];

    if (empty($rating)) {
        $ratingErr = "select a rating";
        $flag = true;
    }
    if (empty($review)) {
        $review = "";
    }

    if (!$flag) {

        $review = test_input($review);
        $rating = test_input($rating);
        $cname = test_input($cname);
    }

    require '../model/dbCreatorReview.php';
    $result1 = addReview($cname, $rating, $review);
    if ($result1) {
        $successfulMessage = "Successfully saved.";
        header("Location:../view/creators2.php");
    } else {
        $errorMessage = "Error while saving.";
    }
}


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
