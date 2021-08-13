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

function addReview($Name, $rating, $review)
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
    //$rating = ", " . $rating;
    //$review = ", " . $review;
    $sql = $conn->prepare("UPDATE CREATORS SET rating=concat(rating,?),review=concat(review,?) WHERE name =?");
    $sql->bind_param("sss", $rating, $review, $Name);
    return $sql->execute();
}
