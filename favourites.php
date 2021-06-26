<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favourites</title>
</head>
<?php
define("filepath", "data.json");
$Name = '';
?>

<body>
    <header>
        <nav>
            <h1 id="logo">YTTV</h1>
            <ul>
                <li><a href="/webtech/userhomepage.html">Home</a></li>
                <li><a href="/webtech/creators2.php">Creators</a></li>
                <li><a href="/webtech/favourites.php/">My Favorites</a></li>
                <li> <a href="/webtech/logout.php">Logout</a></li>
                <li> <a href="#">View Profile</a></li>

            </ul>
        </nav>
    </header>
    <?php
    if (isset($_COOKIE['uid'])) {
        $Name = $_COOKIE['uid'];

        $fileData = read();

        $data = json_decode($fileData, true);

        foreach ($data as  $id => $userdata) {

            if ($Name == $data[$id]['username']) {

                $rev = explode(", ", $data[$id]["favourites"]);
                echo "Favourites: ";
                echo "<ol>";
                foreach ($rev as $id) {
                    echo " <li>";
                    echo $id;
                    echo "</li>";
                }
                echo "</ol>";
            }
        }
    }
    ?>
</body>
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
} ?>

</html>