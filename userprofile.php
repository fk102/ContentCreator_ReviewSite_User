<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Info</title>
</head>

<body>
    <nav>
        <h1 id="logo">YTTV</h1>
        <ul>
            <li><a href="/webtech/userhomepage.html">Home</a></li>
            <li><a href="/webtech/creators2.php">Creators</a></li>
            <li><a href="/webtech/favourites.php">My Favorites</a></li>
            <li> <a href="/webtech/logout.php">Logout</a></li>

        </ul>
    </nav>
    <h2>Account Info</h2>

    <?php



    $successfulMessage = $errorMessage = "";
    $flag = $found = false;
    $uid = "";


    define("filepath", "data.json");
    $fileData = read();
    if (isset($_COOKIE['uid'])) {
        $uid = $_COOKIE['uid'];
        $data = json_decode($fileData, true);
        foreach ($data as  $id => $userdata) {

            if ($uid == $data[$id]["username"]) {

                echo "First Name: " . $data[$id]["firstname"] . "<br><br>";
                echo "Last Name: " . $data[$id]["lastname"] . "<br><br>";
                echo "Username: " . $data[$id]["username"] . "<br><br>";
                echo "Email: " . $data[$id]["email"] . "<br><br>";
                echo "Gender: " . $data[$id]["gender"] . "<br><br>";
                echo "Date of Birth: " . $data[$id]["dob"] . "<br><br>";
            }
        }
    } else {
        $errorMessage = "User not Found";
    }
    ?>
    <a href="/webtech/edituser.php">Edit Info</a>
</body>

</html>




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