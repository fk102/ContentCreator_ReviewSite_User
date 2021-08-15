<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creators</title>
    <link rel="stylesheet" href="./css/creators.css">

</head>
<?php
require '../model/dbCreatorRead.php';

if (isset($_COOKIE['uid'])) {
    include 'nav.html';
} else {
    include 'newNav.html';
} ?>
<div class="top-content">
    <h1>Creators</h1>
</div>


<?php
define("filepath", "creators.json");

$password = "";
$NameErr = $passwordErr = "";
$successfulMessage = $favMessage = $errorMessage = "";
$flag = $flag2 = $found = false;
$uid = "";
$Name = '';

if (isset($_COOKIE['creator'])) {
    $uid = $_COOKIE['creator'];
}



if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $Name = $_POST['Name'];

    if (empty($Name)) {
        $NameErr = "Enter a Name";
        $flag = true;
    }


    if (!$flag) {
        $Name = test_input($Name);
        $found = true;
    }

    if ($found) {
        $successfulMessage = "Success";
        if (isset($_POST['Name'])) {
            setcookie("creator", $Name, time() + 60 * 60 * 24 * 30);
        }
        session_start();
        $_SESSION['creator'] = $Name;
        header("location:creatorprofile.php");
    } else {
        $errorMessage = "Invalid Credentials";
    }
}
?>

<body>

    <?php

    getCreatorInfo();
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>


    <br><br>
    <input type=button onClick=location.href="./creatorform.php" value="Add Creator"></input><br><br>
    <span style="color: green;"><?php echo $successfulMessage; ?></span>
    <span style="color: red;"><?php echo $errorMessage; ?></span>
    <style>
        input[type="button"] {
            background-color: #7f2fff;
            position: relative;
            width: 120px;
            height: 50px;
            left: 8.5rem;
            margin: 1rem;
        }
    </style>
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