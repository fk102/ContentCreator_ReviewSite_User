<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Account Info</title>
</head>

<body>
    <?php require 'nav.html';
    require '../model/dbRead.php';
    ?>
    <div class="top-content">
        <h2>Account Info</h2>

        <?php



        $successfulMessage = $errorMessage = "";
        $flag = $found = false;
        $uid = "";


        if (isset($_COOKIE['uid'])) {
            $uid = $_COOKIE['uid'];
            $result = view($uid);
        }

        ?>
        <input type="button" onClick=location.href="./edituser.php" value="Edit Info"></input>

    </div>
</body>

</html>




<?php

?>