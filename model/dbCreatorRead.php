<?php
require 'dbConnect.php';
echo "<link rel=stylesheet href=../view/css/style.css>
<link rel=stylesheet href=../view/css/creatorProfile.css>
<link rel=stylesheet href=../view/css/creators.css>
";
function getCreator($Name)
{
  $conn = connect();
  $sql = $conn->prepare("SELECT * FROM CREATORS WHERE name=?");
  $sql->bind_param("s", $Name);
  $sql->execute();
  $res = $sql->get_result();
  $res->num_rows === 1;

  while ($row = $res->fetch_assoc()) {
    echo "<div class=content><label>Ratings:</label> " . "<ul>" . $row['rating'] . '</ul><br>';
    //echo '<br>' . "Reviews: " . $row['review'] . '<br><br>';
    $rev = explode(", ", $row["review"]);
    echo "<label>Reviews:</label><br> ";
    echo "<ol>";
    foreach ($rev as $id) {
      echo " <li>";
      echo $id;
      echo "</li>";
    }
    echo "</ol>";
    echo "<br><a href=$row[channelLink]>Go to Channel</a></div>";
  }

  echo "<form action=./addfavourite.php method=POST >";
  echo "<input type=submit name=favourite value=favourite>";
  echo "</form>";
}

function getCreatorInfo()
{
  $conn = connect();
  $sql = $conn->prepare("SELECT * FROM CREATORS");

  $sql->execute();
  $res = $sql->get_result();
  $res->num_rows > 0;
  $count = 0;
  $item = "item-";
  echo "<div class=grid-container>";
  while ($row = $res->fetch_assoc()) {
    $item = $item . $count;
    echo "<div class=items>
                <div class=$item>
                <img src=$row[img] alt=image of creator>";
    echo "
        <form action=creators2.php method=POST>";
    echo "<input type=submit name=Name value=$row[name]>";
    echo "</form>";
    echo "<div class=channel><a href=$row[channelLink] class=links>Go to Channel</a></div>
        </div>
        </div>";
    $count++;
  }
  echo "</div>";
  echo " <style>
    img {
        max-width: 300px;
        max-height: auto;
        position: relative;
        left: 4rem;
        margin: auto;
        border-radius: 8px;
        transition: all 0.4s ease-in-out;
      }
      input{
        position: relative;
        left: 8.5rem;
        margin: auto;
        transition: 0.4s ease-in-out;
      }
      form input:hover{
        font-size:16px;
        transition: 0.3s ease-in-out;
      }
      a.links{
          position:relative;
          left:8.5rem;
          margin:1rem;
        }
        .grid-container {
            display: grid;
            grid-template-columns: auto auto auto;
            
            grid-gap: 5px;
            padding:auto;
            padding-bottom:10px;
          }
          
          .items{
            margin-top:2rem;
            transition: all 0.4s ease-in-out;
          }
          .channel {
            margin-top:3.5rem;
            
        }
          .items:hover {
          margin-top:1.2rem;
          transition: all 0.4s ease-in-out;
        }
        .channel a{
          transition: all 0.4s ease-in-out;
        }
        .channel a:hover{
          font-size:17px;
        }

    </style>";
}
