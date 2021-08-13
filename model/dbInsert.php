<?php
require 'dbConnect.php';

function register($firstName, $lastName, $gender, $dob, $email, $uid, $password)
{
    $conn = connect();
    $sql = $conn->prepare("INSERT INTO USER (firstname, lastname, gender, dob, email, username,password)
        VALUES (?,?,?,?,?,?,?)");
    $sql->bind_param("sssssss", $firstName, $lastName, $gender, $dob, $email, $uid, $password);
    return $sql->execute();
}

function update($firstName, $lastName,  $gender, $dob, $email, $username, $password, $uid)
{
    $conn = connect();
    if ($firstName !== "") {

        $sql = $conn->prepare("UPDATE USER SET firstname=? WHERE username =?");
        $sql->bind_param("ss", $firstName, $uid);
        return $sql->execute();
    }
    if ($lastName !== "") {

        $sql = $conn->prepare("UPDATE USER SET lastname=? WHERE username =?");
        $sql->bind_param("ss", $lasttName, $uid);
        return $sql->execute();
    }
    if ($gender !== "") {

        $sql = $conn->prepare("UPDATE USER SET gender=? WHERE username =?");
        $sql->bind_param("ss", $gender, $uid);
        return $sql->execute();
    }
    if ($dob !== "") {

        $sql = $conn->prepare("UPDATE USER SET dob=? WHERE username =?");
        $sql->bind_param("ss", $dob, $uid);
        return $sql->execute();
    }
    if ($email !== "") {

        $sql = $conn->prepare("UPDATE USER SET email=? WHERE username =?");
        $sql->bind_param("ss", $email, $uid);
        return $sql->execute();
    }
    if ($password !== "") {

        $sql = $conn->prepare("UPDATE USER SET password=? WHERE username =?");
        $sql->bind_param("ss", $password, $uid);
        return $sql->execute();
    }
    if ($username !== "") {
        $sql = $conn->prepare("UPDATE USER SET username=? WHERE username=?");
        $sql->bind_param("ss", $username, $uid);
        return $sql->execute();
    } else {
        header("Location:../view/userprofile.php");
    }
}
