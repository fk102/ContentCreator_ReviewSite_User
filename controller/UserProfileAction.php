<?php

require '../model/dbInsert.php';
$firstName = $lastName = $gender = $dob = $email = $username = $password = $uid = "";
$firstNameErr = $lastNameErr = $genderErr = $dobErr = $emailErr = $usernameErr = $passwordErr = "";
$successfulMessage = $errorMessage = "";
$flag = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $uid = $_POST['uid'];



    if (!$flag) {
        $firstName = test_input($firstName);
        $lastName = test_input($lastName);
        $gender = test_input($gender);
        $dob = test_input($dob);
        $email = test_input($email);
        $username = test_input($username);
        $password = test_input($password);
        $uid = test_input($uid);

        $result1 = update($firstName, $lastName, $gender, $dob, $email, $username, $password, $uid);
        if ($result1) {
            $successfulMessage = "Successfully saved.";
            header('Location:../view/logout.php');
        } else {
            $errorMessage = "Error while saving.";
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
