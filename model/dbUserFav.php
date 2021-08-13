<?php
require 'dbConnect.php';

function addFav($Name, $favourites)
{
    $conn = connect();
    $sql = $conn->prepare("SELECT * FROM USER WHERE username=?");
    $sql->bind_param("s", $Name);
    $sql->execute();
    $res = $sql->get_result();
    $res->num_rows === 1;

    while ($row = $res->fetch_assoc()) {
        if (empty($row['favourites'])) {
            $favourites = $favourites;
        } else {
            $favourites = ", " . $favourites;
        }
    }
    $sql = $conn->prepare("UPDATE USER SET favourites=concat(favourites,?) WHERE username =?");
    $sql->bind_param("ss", $favourites, $Name);
    return $sql->execute();
}
