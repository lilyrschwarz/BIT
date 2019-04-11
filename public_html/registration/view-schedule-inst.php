<!DOCTYPE html>
<html>
  <head>
    <title> Schedule </title>
    <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />
    <link rel = "stylesheet" type="text/css" href="style.css"/>
  </head>
  <body>
    <div style="display: inline-block;" class="menu-button">
      <form action="menu.php"><input type="submit" value="Menu"/></form>
    </div>
    <h3> Schedule by Day & Time </h3>
    <hr>
    <form action="view-schedule-reg.php" method="post">
      <!-- <input type="submit" value="View"> <br> -->
    </form>
      <?php /* Note: currently returns empty results from query as a result of empty transcript table */
        session_start();
        // Send to login page if user is not logged in
        if(!$_SESSION['loggedin']) {
            header("Location: login.php");
            die();
        }

        //send to menu page if they don't have sufficient permissions
        if(($_SESSION['type']=="secr")) {
          header("Location: menu.php");
          die();
        }

        $tempErr = "";

        // Connect to database
        $servername = "localhost";
        $username = "SELECT_team_name";
        $password = "Password123!";
        $dbname = "SELECT_team_name";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if(!$conn){
          die("Connection failed: " . mysqli_connect_error());
        }

        // Search database for courses that match with input uid
        $query = "select credits, section, name, courseno, day, tme, crn, location FROM course where '".$_SESSION['uid']."'=instructor AND semester='Spring' AND year='2019';";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
              echo "<table>";
              echo "<thead><tr><th>Credits</th><th>Name</th><th>Course Number</th><th>Day</th><th>Time</th><th>CRN</th><th>Location</th></tr></thead>";

              while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td>" . $row["credits"] . "</td>";
                  //echo "<td>" . $row["section"] . "</td>";
                  echo "<td>" . $row["name"] . "</td>";
                  echo "<td>" . $row["courseno"] . "</td>";
                  echo "<td>" . $row["day"] . "</td>";
                  echo "<td>" . $row["tme"] . "</td>";
                  echo "<td>" . $row["crn"] . "</td>";
                  echo "<td>" . $row["location"] . "</td>";
                  echo "</tr>";
              }
              echo "</table>";
          }
        // Function to validate uid input
        function test_value($input) {
            $input = htmlspecialchars($input);
            $input = stripslashes($input);
            $input = trim($input);
            return $input;
        }

      ?>

  </body>
</html>
