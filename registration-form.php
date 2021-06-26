<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>PHP IO</title>
</head>

<body>
    <h1> Registration Form </h1>

    <?php
    define("filepath", "data.json");

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

            $fileData = read();
            if (empty($fileData)) {
                $data[] = array("firstname" => $firstName, "lastname" => $lastName, "gender" => $gender, "dob" => $dob, "email" => $email, "username" => $username, "password" => $password, "favourites" => null);
            } else {
                $data = json_decode($fileData);
                array_push($data, array("firstname" => $firstName, "lastname" => $lastName, "gender" => $gender, "dob" => $dob, "email" => $email, "username" => $username, "password" => $password, "favourites" => null));
            }
            $data_encode = json_encode($data, JSON_PRETTY_PRINT);
            write("");
            $result1 = write($data_encode);
            if ($result1) {
                $successfulMessage = "Successfully saved.";
            } else {
                $errorMessage = "Error while saving.";
            }
        }
    }

    function write($content)
    {
        $resource = fopen(filepath, "w");
        $fw = fwrite($resource, $content . "\n");
        fclose($resource);
        return $fw;
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <fieldset>
            <legend>Create an Account:</legend>
            <label for="firstname">First name:</label>
            <input type="text" id="firstname" name="firstname">
            <span style="color: red;"><?php echo $firstNameErr; ?></span><br><br>

            <label for="lastname">Last name:</label>
            <input type="text" id="lastname" name="lastname">
            <span style="color: red;"><?php echo $lastNameErr; ?></span><br><br>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
            <span style="color: red;"><?php echo $emailErr; ?></span><br><br>

            <label>Gender</label>
            <input type="radio" id="male" name="gender" value="male">
            <label for="Male">Male</label>
            <input type="radio" name="gender" id="female" value="female">
            <label for="Female">Female</label>
            <input type="radio" name="gender" id="other" value="other">
            <label for="Other">Other</label>
            <span style="color: red;"><?php echo $genderErr; ?></span><br><br>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob">
            <span style="color: red;"><?php echo $dobErr; ?></span><br><br>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username">
            <span style="color: red;"><?php echo $usernameErr; ?></span><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <span style="color: red;"><?php echo $passwordErr; ?></span><br><br>
        </fieldset>
        <input type="submit" value="Create Account">
    </form>

    <span style="color: green;"><?php echo $successfulMessage; ?></span>
    <span style="color: red;"><?php echo $errorMessage; ?></span>
    <a href="/webtech/login.php">Login</a>

    <?php

    function read()
    {
        $resource = fopen(filepath, "r");
        $fz = filesize(filepath);
        $fr = "";
        if ($fz > 0) {
            $fr = fread($resource, $fz);
        }
        fclose($resource);
        return $fr;
    }
    ?>

</body>

</html>