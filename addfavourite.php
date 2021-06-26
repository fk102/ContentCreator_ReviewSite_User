<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add Favourites</title>
</head>

<body>
    <h1> Add Favourite </h1>

    <?php
    define("filepath", "data.json");

    $Name = $favourite = $channelLink = $favourites = $review = "";
    $NameErr = $favouritesErr = $channelErr = $favouritesErr = $dobErr = "";
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

                $fileData = read();

                $data = json_decode($fileData, true);

                foreach ($data as  $id => $userdata) {
                    if ($Name == $data[$id]["username"]) {
                        $data[$id]['favourites'] = $data[$id]['favourites'] . ", " . $favourites;
                    }
                }
            }
        }
        $data_encode = json_encode($data, JSON_PRETTY_PRINT);
        write("");
        $result1 = write($data_encode);
        if ($result1) {
            $successfulMessage = "Successfully saved.";
            header("location:/webtech/creatorprofile.php");
        } else {
            $errorMessage = "Error while saving.";
        }
    }






    function write($content)
    {
        $resource = fopen(filepath, "w");
        $fw = fwrite($resource, $content . "\n");
        fclose($resource);
        return $fw;
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>


    <span style="color: green;"><?php echo $successfulMessage; ?></span>
    <span style="color: red;"><?php echo $errorMessage; ?></span>

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