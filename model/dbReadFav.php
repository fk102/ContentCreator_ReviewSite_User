<?php
require 'dbConnect.php';
function getFav($Name)
{
    $conn = connect();
    $sql = $conn->prepare("SELECT * FROM USER WHERE username=?");
    $sql->bind_param("s", $Name);
    $sql->execute();
    $res = $sql->get_result();
    $res->num_rows === 1;

    while ($row = $res->fetch_assoc()) {
        if ($row['favourites'] != "") {
            $rev = explode(",", $row["favourites"]);
            echo "<ol>";
            foreach ($rev as $id) {
                echo "<li>";
                echo $id;
                echo "</li>";
            }
            echo "</ol>";
        } else {
            echo "No Favourites";
        }
    }
}
?>

<body>
    <link rel=stylesheet href=./css/style.css">
    <style>
        li {
            font-size: 20px;
            margin: 2rem;
            padding: auto;
            position: relative;
            color: white;
        }
    </style>
</body>