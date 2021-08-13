<?php
require 'dbConnect.php';

function login($username, $password)
{
    $conn = connect();
    $sql = $conn->prepare("SELECT * FROM USER WHERE username=? and password=?");
    $sql->bind_param("ss", $username, $password);
    $sql->execute();
    $res = $sql->get_result();
    return $res->num_rows === 1;
}

function view($Name)
{
    $conn = connect();
    $sql = $conn->prepare("SELECT * FROM USER WHERE username=?");
    $sql->bind_param("s", $Name);
    $sql->execute();
    $res = $sql->get_result();
    $res->num_rows === 1;
    echo "<div class=top-content><p>";
    while ($row = $res->fetch_assoc()) {
        echo "First Name: " . $row["firstname"] . "<br><br>";
        echo "Last Name: " . $row["lastname"] . "<br><br>";
        echo "Username: " . $row["username"] . "<br><br>";
        echo "Email: " . $row["email"] . "<br><br>";
        echo "Gender: " . $row["gender"] . "<br><br>";
        echo "Date of Birth: " . $row["dob"] . "<br><br>";
    }
    echo "</p></div>";
}

function getUser()
{
    $conn = connect();
    $sql = $conn->prepare("SELECT * FROM USER WHERE username=?");
    $sql->bind_param("s", $username);
    $sql->execute();
    $res = $sql->get_result();
    return $res->num_rows === 1;
}
