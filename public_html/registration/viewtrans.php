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

    <h3> Transcript </h3>
    <?php /* Note: currently returns empty results from query as a result of empty transcript table */
      session_start();
      // Send to login page if user is not logged in
      if (!$_SESSION['loggedin']) {
        header("Location: login.php");
        die();
      }

      $tempErr = "";

      // Connect to database
      $servername = "localhost";
      $username = "SJL";
      $password = "SJLoss1!";
      $dbname = "SJL";
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      // Check connection
      if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
      }
      $query = "select f_name, l_name, program_type, advisor.name as aname FROM student, advisor WHERE advisor = advisor.university_id and student.university_id =".$_SESSION['uid'].")";
      $result = mysqli_query($conn, $query);
        
        echo "Student Name:";
        echo  $row["fname"] . $row["lname"];
        echo "<br>";
        echo "Program Type: ";
        echo $row["program_type"];
        echo "<br>";
        echo "Advisor:" ;
        echo $row["aname"];
        echo "<br>";
      
      

      // Search database for courses that match with input uid
      $query = "select C.credits, C.section, C.name, C.courseno, C.dept, C.day, C.tme, C.instructor, C.crn, C.location, T.grade FROM course C, transcript T where '".$_SESSION['studuid']."'=T.uid AND T.crn=C.crn;";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) > 0) {
              echo "<table>";
              echo "<thead><tr><th>Credits</th><th>Name</th><th>Dept</th><th>Course Number</th><th>CRN</th><th>Grade</th></tr></thead>";

              while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td>" . $row["credits"] . "</td>";
                  //echo "<td>" . $row["section"] . "</td>";
                  echo "<td>" . $row["name"] . "</td>";
                  echo "<td>" . $row["dept"] . "</td>";
                  echo "<td>" . $row["courseno"] . "</td>";
                  echo "<td>" . $row["crn"] . "</td>";
                  echo "<td>" . $row["grade"] . "</td>";
                  echo "</tr>";
              }
              echo "</table>";
          }
        $sum = 0;
        $query2 = "select t.grade, c.credits from course c, transcript t where '".$_SESSION['studuid']."'=t.uid AND t.crn=c.crn;";
        $credit_sum = "select sum(c.credits) from course c, transcript t where '".$_SESSION['studuid']."'=t.uid AND t.crn=c.crn AND t.grade != 'IP';";
        $result2 = mysqli_query($conn, $query2);
        $result_sum = mysqli_query($conn, $credit_sum);
        $final_sum = mysqli_fetch_assoc($result_sum)["sum(c.credits)"];
         if (mysqli_num_rows($result2) > 0) {
         	while($row = mysqli_fetch_assoc($result2)){
              if($row["grade"] == "A"){
              	$sum += (4.0 * $row["credits"]);
              }
              if($row["grade"] == "A-"){
              	$sum += (3.7 * $row["credits"]);
              }
              if($row["grade"] == "B+"){
              	$sum += (3.3 * $row["credits"]);
              }
              if($row["grade"] == "B"){
              	$sum += (3.0 * $row["credits"]);
              }
              if($row["grade"] == "B-"){
              	$sum += (2.7 * $row["credits"]);
              }
              if($row["grade"] == "C+"){
              	$sum += (2.3 * $row["credits"]);
              }
              if($row["grade"] == "C"){
              	$sum += (2.0 * $row["credits"]);
              }
              if($row["grade"] == "F"){
              	$sum += (0 * $row["credits"]);
              }
              // if($row["grade"] == "IP"){
              // 	$sum += 0;
              //   $final_sum -= 1;
              // }
            }
            $gpa = ($sum/$final_sum);
            echo "GPA: " .$gpa;
            $gpa_update = mysqli_query($db,"UPDATE user
                SET gpa = '$gpa'
                WHERE uid =". $_SESSION['uid']);
            $total_credits = mysqli_query($db,"UPDATE user
                 SET total_credits = '$finalSum'
             WHERE uid =". $_SESSION['uid']);
          }
    ?>

  </body>
</html>
