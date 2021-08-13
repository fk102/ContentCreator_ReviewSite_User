<?php
require 'dbConnect.php';

function register($Name, $dob, $channelLink, $rating, $review, $imgLink)
{
    $conn = connect();
    $sql = $conn->prepare("INSERT INTO CREATORS (name, dob, channelLink, rating, review,img)
        VALUES (?,?,?,?,?,?)");
    $sql->bind_param("ssssss", $Name, $dob, $channelLink, $rating, $review, $imgLink);
    return $sql->execute();
}

function update($Name, $dob, $channelLink, $imgLink, $creator)
{
    $conn = connect();
    if ($dob !== "") {

        $sql = $conn->prepare("UPDATE CREATORS SET dob=? WHERE name =?");
        $sql->bind_param("ss", $dob, $creator);
        return $sql->execute();
    }
    if ($channelLink !== "") {

        $sql = $conn->prepare("UPDATE CREATORS SET channelLink=? WHERE name =?");
        $sql->bind_param("ss", $channel, $creator);
        return $sql->execute();
    }
    if ($imgLink !== "") {

        $sql = $conn->prepare("UPDATE CREATORS SET img=? WHERE name =?");
        $sql->bind_param("ss", $imgLink, $creator);
        return $sql->execute();
    }
    if ($Name !== "") {

        $sql = $conn->prepare("UPDATE CREATORS SET name=? WHERE name =?");
        $sql->bind_param("ss", $Name, $creator);
        return $sql->execute();
    } else {
        header("Location:../view/creators2.php");
    }
}
