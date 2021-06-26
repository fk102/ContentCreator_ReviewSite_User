<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add creators</title>
</head>

<body>
    <h1> Add Creator </h1>

    <?php
    define("filepath", "creators.json");

    $Name = $channelLink = $dob = "";
    $NameErr = $channelErr = $dobErr = "";
    $successfulMessage = $errorMessage = "";
    $flag = false;

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $Name = $_POST['name'];
        $channelLink = $_POST['channelLink'];
        $dob = $_POST['dob'];


        if (empty($channelLink)) {
            $channelErr = "enter a channelLink";
            $flag = true;
        }
        if (empty($dob)) {
            $dob = "Enter Valid date";
            $flag = true;
        }

        if (!$flag) {
            $Name = test_input($Name);
            $dob = test_input($dob);
            $channelLink = test_input($channelLink);

            $fileData = read();

            $data = json_decode($fileData, true);

            foreach ($data as  $id => $userdata) {
                if ($Name == $data[$id]["name"]) {

                    $data[$id]['dob'] = $dob;
                    $data[$id]['channelLink'] = $channelLink;
                }
            }
        }

        $data_encode = json_encode($data, JSON_PRETTY_PRINT);
        write("");
        $result1 = write($data_encode);
        if ($result1) {
            $successfulMessage = "Successfully saved.";
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

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <fieldset>
            <legend>Update Info:</legend>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name">
            <span style="color: red;"><?php echo $NameErr; ?></span><br><br>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob">
            <span style="color: red;"><?php echo $dobErr; ?></span><br><br>

            <label for="channelLink">Channel Link:</label>
            <input type="url" id="channelLink" name="channelLink">
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