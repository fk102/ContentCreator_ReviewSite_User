<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add creators</title>
</head>

<body>
    <?php require 'nav.html';
    $Name = $rating = $channelLink = $rating = $review = "";
    $NameErr = $ratingErr = $channelErr = $ratingErr = $cname = "";
    $successfulMessage = $errorMessage = "";
    if (isset($_COOKIE['creator'])) {
        $cname = $_COOKIE['creator'];
    }
    ?>
    <h1> Add Creator </h1>



    <form action="../controller/addReviewAction.php" method="POST" name="reviewForm" onsubmit="return isValid()">
        <fieldset>
            <legend></legend>
            <?php echo "<input type=hidden id=cname name=cname value=$cname>"; ?>
            <span style="color: red;"><?php echo $NameErr; ?></span>

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
            <span style="color: red;"><?php echo $ratingErr; ?></span><br><br><br>

            <label for="review">Review:</label>
            <textarea id="review" name="review" cols="20" rows="4"></textarea>
            <br><br>
        </fieldset>
        <input type="submit" value="Add Review">
    </form>
    <script>
        function isValid() {

            var flag = true;

            var ratingErr = document.getElementById("ratingErr");

            var rating = document.forms["creatorForm"]["rating"].value;



            ratingErr.innerHTML = "";

            if (rating == "") {
                ratingErr.innerHTML = "Enter a rating";
                flag = false;
            }
            if (review == "") {
                reviewErr.innerHTML = "Enter a review";
                flag = false;
            }
            return flag;
        }
    </script>
    <span style="color: green;"><?php echo $successfulMessage; ?></span>
    <span style="color: red;"><?php echo $errorMessage; ?></span>

</body>

</html>