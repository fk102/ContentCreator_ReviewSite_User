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

    $Name = $rating = $channelLink = $rating = $review = "";
    $NameErr = $ratingErr = $channelErr = $ratingErr = $dobErr = "";
    $successfulMessage = $errorMessage = "";
    $flag = false;

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $Name = $_POST['name'];
        $rating = $_POST['rating'];
        $review = $_POST['review'];


        if (empty($rating)) {
            $ratingErr = "select a rating";
            $flag = true;
        }
        if (empty($review)) {
            $review = "";
        }

        if (!$flag) {
            $Name = test_input($Name);
            $review = test_input($review);
            $rating = test_input($rating);

            $fileData = read();

            $data = json_decode($fileData, true);

            foreach ($data as  $id => $userdata) {
                if ($Name == $data[$id]["name"]) {

                    $data[$id]['rating'] = $data[$id]['rating'] . ", " . $rating;
                    $data[$id]['review'] = $data[$id]['review'] . ", " . $review;
                }
            }
        }

        $data_encode = json_encode($data, JSON_PRETTY_PRINT);
        write("");
        $result1 = write($data_encode);
        if ($result1) {
            $successfulMessage = "Successfully saved.";
            header("Location:/webtech/creators2.php");
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
            <legend>Add a creator:</legend>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name">
            <span style="color: red;"><?php echo $NameErr; ?></span><br><br>

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
        <input type="submit" value="Add Review">
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