<?php
require 'dbConnect.php';

/*function getCreator($Name)
{
    $conn = connect();
    $sql = $conn->prepare("SELECT * FROM CREATORS WHERE name=?");
    $sql->bind_param("s", $Name);
    $sql->execute();
    $res = $sql->get_result();
    $res->num_rows === 1;

    while ($row = $res->fetch_assoc()) {
        if (empty($row['rating'])) {
            $rating = $rating;
        } else {
            $rating = ", " . $rating;
        }
        if (empty($row['review'])) {
            $review = $review;
        } else {
            $review = ", " . $review;
        }
    }
}*/

function addReview($cname, $rating, $review)
{
    $conn = connect();
    $sql = $conn->prepare("SELECT * FROM CREATORS WHERE name=?");
    $sql->bind_param("s", $cname);
    $sql->execute();
    $res = $sql->get_result();
    $res->num_rows === 1;

    while ($row = $res->fetch_assoc()) {
        if (empty($row['rating'])) {
            $rating = $rating;
        } else {
            $rating = ", " . $rating;
        }
        if (empty($row['review'])) {
            $review = $review;
        }
    }
    if (empty($review)) {
        $review = $review;
        $sql = $conn->prepare("UPDATE CREATORS SET rating=concat(rating,?) WHERE name =?");
        $sql->bind_param("ss", $rating, $cname);
        return $sql->execute();
    } else {

        $review = ", " . $review;
        $sql = $conn->prepare("UPDATE CREATORS SET rating=concat(rating,?),review=concat(review,?) WHERE name =?");
        $sql->bind_param("sss", $rating, $review, $cname);
        return $sql->execute();
    }
}
