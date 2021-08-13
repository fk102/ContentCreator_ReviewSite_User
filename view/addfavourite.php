<?php require '../model/dbUserFav.php';


$Name =  $favourites =  "";
$NameErr = "";
$successfulMessage = $errorMessage = "";
$flag = false;
if (isset($_COOKIE['uid'])) {
    $Name = $_COOKIE['uid'];


    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $creator = $_POST['favourite'];
        if (empty($Name)) {
            $NameErr = "Enter a Name";
            $flag = true;
        }

        if (isset($_COOKIE['creator'])) {
            $favourites = $_COOKIE['creator'];


            $result1 = addFav($Name, $favourites);
            if ($result1) {
                $successfulMessage = "Successfully saved.";
                header("location:../view/creatorprofile.php");
            } else {
                $errorMessage = "Error while saving.";
            }
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
