<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add creators</title>
    <?php require '../model/dbCreatorInsert.php' ?>
</head>

<body>
    <?php require 'nav.html' ?>
    <h1> Add Creator </h1>

    <?php
    define("filepath", "creators.json");
    $Name = $rating = $channelLink = $rating = $review = $imgLink = "";
    $NameErr = $ratingErr = $channelErr = $ratingErr = $dobErr = "";
    $successfulMessage = $errorMessage = "";
    $flag = false;

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $Name = $_POST['name'];
        $dob = $_POST['dob'];
        $channelLink = $_POST['channelLink'];
        $imgLink = $_POST['imgLink'];
        $rating = $_POST['rating'];
        $review = $_POST['review'];


        if (empty($Name)) {
            $NameErr = "Name can not be empty!";
            $flag = true;
        }
        if (empty($dob)) {
            $dobErr = "Select Date of Birth";
            $flag = true;
        }
        if (empty($channelLink)) {
            $channelErr = "Enter a Channel Link";
            $flag = true;
        }
        if (empty($rating)) {
            $ratingErr = "select a rating";
            $flag = true;
        }
        if (empty($review)) {
            $review = "";
        }

        if (!$flag) {
            $Name = test_input($Name);
            $dob = test_input($dob);
            $channelLink = test_input($channelLink);
            $imgLink = test_input($imgLink);
            $review = test_input($review);
            $rating = test_input($rating);

            $fileData = read();
            if (empty($fileData)) {
                $data[] = array("name" => $Name, "channelLink" => $channelLink);
            } else {
                $data = json_decode($fileData);
                array_push($data, array("name" => $Name, "channelLink" => $channelLink, "img" => $imgLink));
            }
            $data_encode = json_encode($data, JSON_PRETTY_PRINT);
            write("");
            $result = write($data_encode);
            if ($result) {
                $successfulMessage = "FILE Successfully saved.";
            } else {
                $errorMessage = "Error while saving FILE.";
            }

            $result1 = register($Name, $dob, $channelLink, $rating, $review, $imgLink);
            if ($result1) {
                $successfulMessage = "Successfully saved.";
                header("Location:./creators2.php");
            } else {
                $errorMessage = "Error while saving.";
            }
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
            <legend>Add a creator:</legend>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name">
            <span style="color: red;"><?php echo $NameErr; ?></span><br><br>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob">
            <span style="color: red;"><?php echo $dobErr; ?></span><br><br>

            <label for="channelLink">Channel Link:</label>
            <input type="url" id="channelLink" name="channelLink">
            <span style="color: red;"><?php echo $channelErr; ?></span><br><br>

            <label for="imgLink">Image URL:</label>
            <input type="url" id="imgLink" name="imgLink">
            <span style="color: red;"><?php echo $channelErr; ?></span><br><br>

            <label>Rating</label>
            <input type="radio" id="one" name="rating" value="one">
            <label for="one">1</label>
            <input type="radio" name="rating" id="two" value="two">
            <label for="two">2</label>
            <input type="radio" name="rating" id="five" value="five">
            <label for="five">3</label>
            <input type="radio" name="rating" id="four" value="four">
            <label for="four">4</label>
            <input type="radio" name="rating" id="five" value="five">
            <label for="five">5</label>
            <span style="color: red;"><?php echo $ratingErr; ?></span><br><br>

            <label for="review">Review:</label>
            <textarea id="review" name="review" cols="20" rows="4"></textarea>
            <br><br>
        </fieldset>
        <input type="submit" value="Add Creator">
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