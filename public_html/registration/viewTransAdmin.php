<!DOCTYPE html>
<html>
  <head>
    <title> Transcript </title>
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
        <br>
    <h3> Search for Student Transcripts </h3>
    <hr>
    <form action="viewTransAdmin.php" method="post">
      Enter student ID: <input type="text" name="uid">
      <input type="submit" name="search" value="Search"> <br>
    </form>
      <?php
            session_start();

            //Ensure user is logged in
            $loggedin = $_SESSION['loggedin'];
            if(!$loggedin) {
                header("Location: login.php");
                die();
            }

            //send to menu page if they don't have sufficient permissions
            if($_SESSION['type']=="MS" || $_SESSION['type']=="PHD") {
                header("Location: menu.php");
                die();
            }

            //Connect to database
            $servername = "localhost";
            $username = "SJL";
            $password = "SJLoss1!";
            $dbname = "SJL";
            $connection = mysqli_connect($servername, $username, $password, $dbname);
            if (!$connection) {
                die("Couldn't connect: ".mysqli_error());
            }
           // echo $_SESSION['type']
            if($_SESSION['type'] == "inst"){  
              //  echo $_SESSION['type'];
                 if(empty($_POST["uid"])) {
                    $query = "select   u.fname,   u.lname,   u.uid,   u.email,   u.type FROM   user u,   student s,   advisor a WHERE   u.uid = s.university_id and a.university_id = ".$_SESSION["uid"]."  and s.advisor = ".$_SESSION["uid"];
                    $result = mysqli_query($connection, $query);
                    if (mysqli_num_rows($result) > 0) {
                        echo "<table>";
                        //Display a table of all the students
                        echo "<thead><tr><th>First Name</th><th>Last Name</th><th>UID</th><th>Email</th><th>Student Type</th></tr></thead>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["fname"] . "</td>";
                            echo "<td>" . $row["lname"] . "</td>";
                            echo "<td>" . $row["uid"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["type"] . "</td>";
                            echo "<td>";
                            echo "<form action=\"setUIDTranscript.php\" method=\"post\">";
                            echo "<input type=\"hidden\" name=\"studuid\" value=\"" . $row["uid"] . "\">";
                            echo "<input type=\"submit\" value=\"View Student Transcript\"/>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";

                    } else {
                        //If nothing came back from the query, there was a problem
                        die("You don't have any advisees. ".mysqli_error());
                    }

                //A specific UID was searched
                } else {
                    $query = "select   u.fname, u.lname, u.uid,   u.email, u.type FROM user u, student s,   advisor a WHERE   u.uid = s.university_id and u.uid ".$_POST["uid"]." and s.advisor = ".$_SESSION["uid"];
                    $result = mysqli_query($connection, $query);
                    if (mysqli_num_rows($result) > 0) {
                        echo "<table>";
                        //Display a table of all the students
                        echo "<thead><tr><th>First Name</th><th>Last Name</th><th>UID</th><th>Email</th><th>Student Type</th></tr></thead>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["fname"] . "</td>";
                            echo "<td>" . $row["lname"] . "</td>";
                            echo "<td>" . $row["uid"] . "</td>";
                            //echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["type"] . "</td>";
                            echo "<td>";
                            echo "<form action=\"setUIDTranscript.php.php\" method=\"post\">";
                            echo "<input type=\"hidden\" name=\"studuid\" value=\"" . $row["uid"] . "\">";
                            echo "<input type=\"submit\" value=\"View Student Transcript\"/>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";

                    } else {
                        echo "No students with that UID!";
                    }
                }
                //$row = mysqli_fetch_assoc($result);
            }



            else{
                            //no UID search
                if(empty($_POST["uid"])) {
                    $query = "select fname, lname, uid, email, type from user where type = 'MS' or type = 'PHD'";
                    $result = mysqli_query($connection, $query);
                    if (mysqli_num_rows($result) > 0) {
                        echo "<table>";
                        //Display a table of all the students
                        echo "<thead><tr><th>First Name</th><th>Last Name</th><th>UID</th><th>Email</th><th>Student Type</th></tr></thead>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["fname"] . "</td>";
                            echo "<td>" . $row["lname"] . "</td>";
                            echo "<td>" . $row["uid"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["type"] . "</td>";
                            echo "<td>";
                            echo "<form action=\"setUIDTranscript.php\" method=\"post\">";
                            echo "<input type=\"hidden\" name=\"studuid\" value=\"" . $row["uid"] . "\">";
                            echo "<input type=\"submit\" value=\"View Student Transcript\"/>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";

                    } else {
                        //If nothing came back from the query, there was a problem
                        die("Bad query: ".mysqli_error());
                    }

                //A specific UID was searched
                } else {
                    $query = "select fname, lname, uid, email, type from user where (type = 'MS' or type = 'PHD') and uid=".$_POST["uid"];
                    $result = mysqli_query($connection, $query);
                    if (mysqli_num_rows($result) > 0) {
                        echo "<table>";
                        //Display a table of all the students
                        echo "<thead><tr><th>First Name</th><th>Last Name</th><th>UID</th><th>Email</th><th>Student Type</th></tr></thead>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["fname"] . "</td>";
                            echo "<td>" . $row["lname"] . "</td>";
                            echo "<td>" . $row["uid"] . "</td>";
                            //echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["type"] . "</td>";
                            echo "<td>";
                            echo "<form action=\"setUIDTranscript.php.php\" method=\"post\">";
                            echo "<input type=\"hidden\" name=\"studuid\" value=\"" . $row["uid"] . "\">";
                            echo "<input type=\"submit\" value=\"View Student Transcript\"/>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";

                    } else {
                        echo "No students with that UID!";
                    }
                }
            }
    

            //close sql connection
            mysqli_close($connection);
        ?>

  </body>
</html>