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

        echo "Student Name: ";
        $query = "select fname, lname, type FROM user WHERE uid = '".$_SESSION['studuid']."'";
        $result = mysqli_query($conn, $query) or die("error extracting advisor");
        $row = mysqli_fetch_assoc($result);
        echo $row['fname']. " ";
        echo $row['lname'];
        echo "<br>";
        echo "Program Type: ";

        if($row['type'] == "alum"){
          $query = "select grad_year, program_type, advisor FROM alumni WHERE university_id = '".$_SESSION['studuid']."'";
          $result = mysqli_query($conn, $query) or die("error extracting advisor");
          $row3 = mysqli_fetch_assoc($result);
          if($row3['program_type'] == "Masters"){
            echo "MS";
          }else if($row3['program_type'] == "PhD"){
            echo "PHD";
          }else{
            echo($row3['program_type']);
          }
          echo "<br>";
          echo "Grad Year: " ;
          echo $row3['grad_year'];
          echo "<br>";
        }else{
          echo $row3['type'];
          echo "<br>";
        }



        if($row['type'] == "MS" || $row['type'] == "PHD"){
          echo "Advisor: " ;
          $query = "select a.name FROM student s, advisor a WHERE s.advisor = a.university_id and s.university_id = '".$_SESSION['studuid']."'";
          $result = mysqli_query($conn, $query) or die("error extracting advisor");
          $row2 = mysqli_fetch_assoc($result);
          echo $row2['name'];
        }else{
          $query = "select a.name FROM alumni n, advisor a WHERE n.advisor = a.university_id and n.university_id = '".$_SESSION['studuid']."'";
          $result = mysqli_query($conn, $query) or die("error extracting advisor from alumni");
          $row2 = mysqli_fetch_assoc($result);
          echo $row2['name'];
        }
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
              //  $sum += 0;
              //   $final_sum -= 1;
              // }
            }
            $gpa = ($sum/$final_sum);
            echo "GPA: " .$gpa;
            $gpa_update = mysqli_query($conn,"update student set GPA = '". $gpa . "' where university_id =". $_SESSION['studuid']);
            $total_credits = mysqli_query($conn,"update student set total_credits = '".$finalSum."' where uid =". $_SESSION['studuid']);
          }
    ?>

  </body>
</html>
