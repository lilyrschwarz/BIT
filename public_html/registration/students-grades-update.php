<!DOCTYPE html>
<html>
  <head>
    <title> Students </title>
    <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />
    <link rel = "stylesheet" type="text/css" href="style.css"/>
  <style>
         ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #333;
        }

        li {
        float: left;
        }

        li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        }

        li a:hover:not(.active) {
        background-color: #111;
        }

        .active {
          background-color: #990000;
        }

    </style>
  </head>
  <body>
    <ul>
             <li><a class="active" href="menu.php">Menu</a></li>
             <li style="float:right"><a href="logout.php">Log Out</a></li>
        </ul>
    <h3> Update Grade </h3>
    <hr>
    <!--
    <form action="edit-grades-admin.php" method="post">
      Select course: <input type="text" name="uid">
      <input type="submit" name="search" value="Search"> <br>
    </form>
  -->
      <?php

        // Connect to database
        $servername = "localhost";
       $username = "SJL";
        $password = "SJLoss1!";
        $dbname = "SJL";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if(!$conn){
          die("Connection failed: " . mysqli_connect_error());
        }

        if($_POST["grade"]=='A' || $_POST["grade"]=='A-' || $_POST["grade"]=='B+' || $_POST["grade"]=='B' || $_POST["grade"]=='B-' || $_POST["grade"]=='C+' || $_POST["grade"]=='C' || $_POST["grade"]=='F') {
          // update grade
          $gradeQuery = "update transcript SET grade='".$_POST[grade]."' where uid='".$_POST[uid]."' AND crn='".$_POST[crn]."'";
          $gradeResult = mysqli_query($conn, $gradeQuery);

          header("Location: edit-grades-inst.php");
          die();
        } else {
          echo "Please enter a valid grade!";
          echo '<br><br>';
          echo '<form action="edit-grades-inst.php"><input type="submit" value="View Profile">';
          echo "</form>";
        }


      ?>

  </body>
</html>
