<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add creators</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/register.css">
    <script type="text/Javsscript" src="./js/addCreator.js"></script>
</head>

<body>
    <?php require 'nav.html' ?>
    <h1> Add Creator </h1>

    <?php

    $Name = $rating = $channelLink  = $review = $imgLink = "";
    $rating = "one";
    $NameErr = $ratingErr = $channelErr = $reviewErr = $dobErr = $imgErr = "";
    $successfulMessage = $errorMessage = "";
    $flag = false;

    ?>
    <form action="../controller/creatorAction.php" method="POST" name="creatorForm" onsubmit="submitForm(this); return false;">
        <fieldset>
            <legend>Add a creator:</legend>
            <label for="cname">Name:</label>
            <input type="text" id="cname" name="cname" required>
            <span style="color: red;" id="NameErr"><?php echo $NameErr; ?></span><br><br>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>
            <span style="color: red;" id="dobErr"><?php echo $dobErr; ?></span><br><br>

            <label for="channelLink">Channel Link:</label>
            <input type="url" id="channelLink" name="channelLink" required>
            <span style="color: red;" id="channelErr"><?php echo $channelErr; ?></span><br><br>

            <label for="imgLink">Image URL:</label>
            <input type="url" id="imgLink" name="imgLink" required>
            <span style="color: red;" id="imgErr"><?php echo $imgErr; ?></span><br><br>

            <label>Rating</label>
            <input type="radio" id="one" name="rating" value="one" required>
            <label for="one">1</label>
            <input type="radio" name="rating" id="two" value="two">
            <label for="two">2</label>
            <input type="radio" name="rating" id="five" value="five">
            <label for="five">3</label>
            <input type="radio" name="rating" id="four" value="four">
            <label for="four">4</label>
            <input type="radio" name="rating" id="five" value="five">
            <label for="five">5</label>
            <span style="color: red;" id="ratingErr"><?php echo $ratingErr; ?></span><br><br>

            <label for="review">Review:</label>
            <textarea id="review" name="review" cols="20" rows="4"></textarea>
            <br><br>
        </fieldset>
        <input type="submit" value="Add Creator">
    </form>
    <span style="color: green;"><?php echo $successfulMessage; ?></span>
    <span style="color: red;"><?php echo $errorMessage; ?></span>

</body>

</html>