<?php
require 'dbConnect.php';

function login($userName, $passWord)
{
    $conn = connect();
    $sql = $conn->prepare("SELECT * FROM USER WHERE username=? and password=?");
    $sql->bind_param("ss", $userName, $passWord);
    $sql->execute();
    $res = $sql->get_result();
    return $res->num_rows === 1;
}
