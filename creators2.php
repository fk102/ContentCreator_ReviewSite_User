<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creators</title>
</head>
<nav>
    <h1 id="logo">YTTV</h1>
    <ul>
        <li><a href="/webtech/userhomepage.html">Home</a></li>
        <li><a href="/webtech/creators2.php">Creators</a></li>
        <li><a href="/webtech/favourites.php/">My Favorites</a></li>
        <li> <a href="/webtech/logout.php">Logout</a></li>
        <li> <a href="/webtech/userprofile.php">View Profile</a></li>

    </ul>
</nav>
<h1>Creators</h1>

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


        $fileData = read();

        $data = json_decode($fileData, true);

        foreach ($data as  $id => $userdata) {

            if ($Name == $data[$id]["name"]) {
                $found = true;
                break;
            }
        }
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

$fileData = read();

$data = json_decode($fileData, true);

foreach ($data as  $id => $userdata) {
    $link = $data[$id]["channelLink"];
    $name =  $data[$id]["name"];
    echo "<br><form action=creators2.php method=POST>";
    echo "Name: <input type=submit name=Name value=$name>";
    echo "</form><br>";
    echo "<a href=$link>Go to Channel</a>";
    echo "<br><br>";
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
    <br><br>
    <input type=button onClick=location.href="/webtech/creatorform.php" value="Add Creator"></input><br><br>
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