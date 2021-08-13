<!DOCTYPE html>

<head>
    <title>YTTV</title>
    <meta name="description" content="Place to discover new creators" />
    <meta charset="utf-8" />
    <meta name="robots" content="index,follow" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="../view/css/creatorProfile.css">
</head>
<header>
    <?php require 'nav.html';
    require '../model/dbCreatorRead.php'; ?>
</header>


<body>
    <?php


    $Name = $password = $favourite = $channelLink = $favourites = $review = "";
    $NameErr = $passwordErr = "";
    $successfulMessage = $errorMessage = "";
    $flag = $found = false;
    $uid = "";

    if (isset($_COOKIE['creator'])) {
        $uid = $_COOKIE['creator'];
        $Name = $uid;
    ?>
        <h1 id="creator"><?php echo $Name ?></h1>

    <?php


        getCreator($Name);
    }
    ?>
    <div class="buttons">
        <input type=button onClick=location.href="./addreview.php" value="Add Review"></input>
        <input type=button onClick=location.href="./updatecreator.php" value="Update Info"></input><br><br>
    </div>
    <?php

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $Name = $_POST["name"];

        if (empty($Name)) {
            $NameErr = "Enter a Name";
            $flag = true;
        }


        if (!$flag) {
            $Name = test_input($Name);
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <?php

    ?>
</body>

</html>