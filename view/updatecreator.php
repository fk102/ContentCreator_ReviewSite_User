<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add creators</title>

    <?php
    require '../model/dbCreatorInsert.php';
    if (isset($_COOKIE['uid'])) {
        include 'nav.html';
    } else {
        include 'newNav.html';
    } ?>
</head>

<body>
    <link rel="stylesheet" href="./view/css/style.css">
    <h1> Update Creator </h1>

    <?php
    define("filepath", "creators.json");

    $Name = $channelLink = $dob = $imgLink = $creator = "";
    $NameErr = $channelErr = $dobErr = "";
    $successfulMessage = $errorMessage = "";
    $flag = false;

    if ($_SERVER['REQUEST_METHOD'] === "POST") {

        $creator = $_COOKIE['creator'];
        $Name = $_POST['name'];
        $channelLink = $_POST['channelLink'];
        $dob = $_POST['dob'];
        $imgLink = $_POST['imgLink'];

        if (empty($channelLink)) {
            $channelErr = "enter a channelLink";
            $flag = true;
        }
        if (empty($dob)) {
            $dobErr = "Enter Valid date";
            $flag = true;
        }

        if (!$flag) {
            $Name = test_input($Name);
            $dob = test_input($dob);
            $channelLink = test_input($channelLink);
            $imgLink = test_input($imgLink);
        }

        $result2 = update($Name, $dob, $channelLink, $imgLink, $creator);
        if ($result2) {
            $successfulMessage = "Successfully saved.";
            header("Location:./creators2.php");
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

    <form action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <fieldset>
            <legend>New Info</legend>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name">
            <span style=" color: red;"><?php echo $NameErr; ?></span><br><br>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob">
            <span style="color: red;"><?php echo $dobErr; ?></span><br><br>

            <label for="channelLink">Channel Link:</label>
            <input type="url" id="channelLink" name="channelLink">
            <span style="color: red;"><?php echo $channelErr; ?></span><br><br>

            <label for="imgLink">Image URL:</label>
            <input type="url" id="imgLink" name="imgLink">
            <span style="color: red;"><?php echo $channelErr; ?></span><br><br>

        </fieldset>
        <input type="submit" value="Update Info">
    </form>

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