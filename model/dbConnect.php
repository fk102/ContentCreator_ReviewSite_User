<?php
function connect()
{
    $conn = new mysqli("localhost", "root", "", "wtk");
    if ($conn->connect_errno) {
        die("Connection Failed" . $conn->connect_error);
    }
    return $conn;
}
