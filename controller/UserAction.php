<?php

require '../model/dbInsert.php';

$firstName = $lastName = $gender = $dob = $email = $username = $password = "";
$firstNameErr = $lastNameErr = $genderErr = $dobErr = $emailErr = $usernameErr = $passwordErr = "";
$successfulMessage = $errorMessage = "";
$flag = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($firstName)) {
        $firstNameErr = "First name can not be empty!";
        $flag = true;
    }
    if (empty($lastName)) {
        $lastNameErr = "Last name can not be empty!";
        $flag = true;
    }
    if (empty($gender)) {
        $genderErr = "Select gender";
        $flag = true;
    }
    if (empty($dob)) {
        $dobErr = "Select Date of Birth";
        $flag = true;
    }
    if (empty($email)) {
        $emailErr = "Enter a valid email address!";
        $flag = true;
    }
    if (empty($username)) {
        $usernameErr = "Enter a username";
        $flag = true;
    }
    if (empty($password)) {
        $passwordErr = "Enter a password";
        $flag = true;
    }

    if (!$flag) {
        $firstName = test_input($firstName);
        $lastName = test_input($lastName);
        $gender = test_input($gender);
        $dob = test_input($dob);
        $email = test_input($email);
        $username = test_input($username);
        $password = test_input($password);


        $result1 = register($firstName, $lastName, $gender, $dob, $email, $username, $password);
        if ($result1) {
            $successfulMessage = "Successfully saved.";
            //header('Location:../view/login.php');
            echo $successfulMessage;
        } else {
            $errorMessage = "Error while saving.";
            echo $errorMessage;
        }
    } else {
        echo "ERROR";
    }
}



function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
