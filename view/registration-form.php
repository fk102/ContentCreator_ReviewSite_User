<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <?php

    $firstName = $lastName = $gender = $dob = $email = $username = $password = "";
    $firstNameErr = $lastNameErr = $genderErr = $dobErr = $emailErr = $usernameErr = $passwordErr = "";
    $successfulMessage = $errorMessage = "";
    $flag = false; ?>
    <title>Create an Account</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/register.css">
    <script src="./js/user.js"></script>
</head>

<body>
    <nav>
        <h1 id="logo">Y/TTV</h1>
        <ul>
            <li><a href="../index.html">Home</a></li>
        </ul>
    </nav>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="registrationForm" onsubmit="submitForm(this); return false;">
        <fieldset>
            <legend>Create an Account</legend>
            <label for="firstname">First name:</label>
            <input type="text" id="firstname" name="firstname" required>
            <span style="color: red;" id="firstNameErr"><?php echo $firstNameErr; ?></span><br><br>

            <label for="lastname">Last name:</label>
            <input type="text" id="lastname" name="lastname" required>
            <span style="color: red;" id=" lastNameErr"><?php echo $lastNameErr; ?></span><br><br>

            <label>Gender</label>
            <input type="radio" id="male" name="gender" value="male" required>
            <label for="Male">Male</label>
            <input type="radio" name="gender" id="female" value="female">
            <label for="Female">Female</label>
            <input type="radio" name="gender" id="other" value="other">
            <label for="Other">Other</label>
            <span style="color: red;" id="genderErr"><?php echo $genderErr; ?></span><br><br>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>
            <span style="color: red;" id="dobErr"><?php echo $dobErr; ?></span><br><br>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <span style="color: red;" id="emailErr"><?php echo $emailErr; ?></span><br><br>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <span style="color: red;" id="usernameErr"><?php echo $usernameErr; ?></span><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <span style="color: red;" id="passwordErr"><?php echo $passwordErr; ?></span><br><br>
        </fieldset>
        <input type="submit" value="Create Account">
    </form>
    <div id="message">
        <span style="color: green;" id=""><?php echo $successfulMessage; ?></span>
        <span style="color: red;"><?php echo $errorMessage; ?></span>
    </div>
    <a href="./login.php">Login?</a>

</body>

</html>