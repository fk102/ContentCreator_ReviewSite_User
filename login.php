<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>
<h1>LOG IN</h1>

<?php
define("filepath", "data.json");

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


        $fileData = read();

        $data = json_decode($fileData, true);

        foreach ($data as  $id => $userdata) {

            if ($userName == $data[$id]["username"] && $passWord == $data[$id]["password"]) {
                $found = true;
                break;
            }
        }
        if ($found) {
            $successfulMessage = "Login Success";
            if (isset($_POST['rememberme'])) {
                setcookie("uid", $userName, time() + 60 * 60 * 24 * 30);
            }
            session_start();
            $_SESSION['uid'] = $userName;
            header("location:userhomepage.html");
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
}
?>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <fieldset>
            <legend>LOG IN</legend>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">
            <span style="color: red;"><?php echo $usernameErr; ?></span><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <span style="color: red;"><?php echo $passwordErr; ?></span><br><br>


            <input type="checkbox" name="rememberme" id="rememberme">
            <label for="rememberme">Remember Me:</label>

            <br><br>
        </fieldset>
        <input type="submit" value="LOGIN">
    </form>
    <span style="color: green;"><?php echo $successfulMessage; ?></span>
    <span style="color: red;"><?php echo $errorMessage; ?></span>
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