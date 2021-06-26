<!DOCTYPE html>

<head>
    <title>YTTV</title>
    <meta name="description" content="Place to discover new creators" />
    <meta charset="utf-8" />
    <meta name="robots" content="index,follow" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<header>
    <h1>YTTV</h1>
    <nav>
        <ul>
            <li><a href="/webtech/homepage.html">Home</a></li>
            <li><a href="/webtech/creators2.php">Creators</a></li>
            <li><a href="/webtech/favourites.php">My Favorites</a></li>
            <li> <a href="/webtech/logout.php">Logout</a></li>
            <li><a href="#">View Profile</a></li>
        </ul>
    </nav>
</header>

<?php
define("filepath", "creators.json");

$Name = $password = $favourite = $channelLink = $favourites = $review = "";
$NameErr = $passwordErr = "";
$successfulMessage = $errorMessage = "";
$flag = $found = false;
$uid = "";

$fileData = read();

$data = json_decode($fileData, true);

if (isset($_COOKIE['creator'])) {
    $uid = $_COOKIE['creator'];
    $Name = $uid;
?>
    <h1 id="logo"><?php echo $Name ?></h1>

<?php
    $fileData = read();

    $data = json_decode($fileData, true);

    foreach ($data as  $id => $userdata) {

        if ($Name == $data[$id]["name"]) {
            $link = $data[$id]["channelLink"];


            echo "Date of Birth: " . $data[$id]["dob"];
            echo <<<HTML
            <br><br>
            HTML;
            echo "Rating: " . $data[$id]["rating"];
            echo <<<HTML
            <br><br>
            HTML;
            $rev = explode(", ", $data[$id]["review"]);
            echo "Reviews: ";
            echo "<ol>";
            foreach ($rev as $id) {
                echo " <li>";
                echo $id;
                echo "</li>";
            }
            echo "</ol>";


            echo <<<HTML
            <br><br>
            HTML;


            echo <<<HTML
            <a href=$link>Go to Channel</a><br><br>
            HTML;
            echo "<br><form action=addfavourite.php method=POST>";
            echo "<input type=submit name=favourite value=favourite>";
            echo "</form><br>";
        }
    }
}
?>
<input type=button onClick=location.href="/webtech/addreview.php" value="Add Review"></input><br><br>

<input type=button onClick=location.href="/webtech/updatecreator.php" value="Update Creator Info"></input><br><br>
<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $Name = $_POST["name"];

    if (empty($Name)) {
        $NameErr = "Enter a Name";
        $flag = true;
    }


    if (!$flag) {
        $Name = test_input($Name);
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