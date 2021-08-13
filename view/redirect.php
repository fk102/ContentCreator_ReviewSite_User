<?php
define("filepath", "creators.json");

$username = $password = "";
$usernameErr = $passwordErr = "";
$successfulMessage = $errorMessage = "";
$flag = $found = false;
$uid = "";


if ($_SERVER['REQUEST_METHOD'] === "GET") {

    if (empty($Name)) {
        $usernameErr = "Enter a username";
        $flag = true;
    }


    if (!$flag) {
        $Name = test_input($Name);


        $fileData = read();

        $data = json_decode($fileData, true);

        foreach ($data as  $id => $userdata) {

            if ($Name == $data[$id]["name"]) {
                echo $data[$id]['name'] . "<br>";
                echo $data[$id]['dob'] . "<br>";
                echo $data[$id]['rating'] . "<br>";
                $rev = explode(", ", $data[$id]["review"]);
                echo "<ol>";
                foreach ($rev as $id) {
                    echo " <li>";
                    echo $id;
                    echo "</li>";
                }
                echo "</ol>";
                $found = true;
                break;
            }
        }
        if ($found) {
        } else {
            $errorMessage = "Invalid Credentials";
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
