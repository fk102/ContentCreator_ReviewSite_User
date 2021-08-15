<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <?php


    require '../model/dbLogin.php';

    $username = $password = "";
    $usernameErr = $passwordErr = "";
    $successfulMessage = $errorMessage = "";
    $flag = $found = false;
    $uid = "";

    if (isset($_COOKIE['uid'])) {
        $uid = $_COOKIE['uid'];
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $userName = $_POST['username'];
        $passWord = $_POST['password'];

        if (empty($userName)) {
            $usernameErr = "Enter a username";
            $flag = true;
        }
        if (empty($passWord)) {
            $passwordErr = "Enter a password";
            $flag = true;
        }

        if (!$flag) {
            $userName = test_input($userName);
            $passWord = test_input($passWord);

            $result1 = login($userName, $passWord);
            if ($result1) {
                $found = true;
            }
            if ($found) {
                $successfulMessage = "Login Success";
                if (isset($_POST['rememberme'])) {
                    setcookie("uid", $userName, time() + 60 * 60 * 24 * 30);
                }
                session_start();
                $_SESSION['uid'] = $userName;
                header("location:../view/userhomepage.php");
            } else {
                $errorMessage = "Invalid Credentials";
            }
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    } ?>

    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <nav>
        <h1 id="logo">Y/TTV</h1>
        <ul>
            <li><a href="./userhomepage.php">Home</a></li>
        </ul>
    </nav>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" name="loginForm" method="POST" onsubmit="return isValid(this); return false;">
        <fieldset>
            <legend>LOG IN</legend>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <span style="color: red;"><?php echo $usernameErr; ?></span><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <span style="color: red;"><?php echo $passwordErr; ?></span><br><br>


            <input type="checkbox" name="rememberme" id="rememberme">
            <label for="rememberme">Remember Me</label>

            <br><br>
        </fieldset>
        <input type="submit" value="LOGIN">
    </form>
    <script>
        function isValid(uForm) {

            var flag = true;

            var usernameErr = document.getElementById("usernameErr");
            var passwordErr = document.getElementById("passwordErr");


            var username = uForm.username.value;
            var password = uForm.password.value;


            if (username === "") {
                usernameErr.innerHtml = "First name can not be empty!";
                window.alert("HELLO");
                flag = false;
            }
            if (password === "") {
                passwordErr.innerHtml = "Last name can not be empty!";
                flag = false;
            }
            return flag;
        }
    </script>
    <span style="color: green;"><?php echo $successfulMessage; ?></span>
    <span style="color: red;"><?php echo $errorMessage; ?></span>

</body>

</html>