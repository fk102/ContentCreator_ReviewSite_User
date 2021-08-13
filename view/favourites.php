<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Favourites</title>
</head>
<?php
require '../model/dbReadFav.php';
$Name = '';
?>

<body>
    <header>
        <?php require 'nav.html' ?>
    </header>
    <h1>My Favourites</h1>
    <?php
    if (isset($_COOKIE['uid'])) {
        $Name = $_COOKIE['uid'];

        $result1 = getFav($Name);
    }
    ?>
</body>

</html>