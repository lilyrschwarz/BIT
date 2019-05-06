<?php
session_start();

if($_SESSION['uid'] && ($_SESSION['type'] == 'secr' )){
 //echo $_SESSION['uid'];
}
else{
    echo $_SESSION['uid'].$_SESSION['type'];
    header("Location: http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/registration/menu.php");
}


//connect to database
$servername = "localhost";
$username = "SJL";
$password = "SJLoss1!";
$dbname = "SJL";
$conn = mysqli_connect($servername, $username, $password, $dbname);



$update=null;
$studentsql=null;
$advisorsql=null;

// Create connection

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

<!DOCTYPE html>

<html>

<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

  <style>
    /*tbody tr:nth-child(odd) {
        background-color: #ff33cc;
    }

    tbody tr:nth-child(even) {
        background-color: #e495e4;
    }

    h2 {
      color: #5689DF;
    }*/

    .center{
      text-align: center;
    }

    .topright {
        position: absolute;
        right: 10px;
        top: 20px;
      }
      .btn {
        background-color: #990000;
        color: white;
        padding: 12px;
        margin: 10px 0;
        border: none;
        width: 40%;
        border-radius: 3px;
        cursor: pointer;
        font-size: 17px;
      }
      .field {
        position: absolute;
        left: 180px;
      }
      /*body{line-height: 1.6;}*/
      .bottomCentered{
         position: fixed;
         text-align: center;
         bottom: 30px;
         width: 100%;
      }
      .error {color: #FF0000;}
      .topright {
        position: absolute;
        right: 10px;
        top: 10px;
      }

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

  <link rel="stylesheet" href="style.css">
  <head>
  <title>View Info</title>
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
  <!-- <style>
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
  font-family: sans-serif;

  }

  li a:hover:not(.active) {
  background-color: #111;
  }

  .active {
  background-color: #4CAF50;
  }
  </style> -->
  </head>
  <body>
    <ul>
    <li><a class="active" href="http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/advising/gs.php">Advising Home</a></li>
    <!-- <li><a href="StudentEnrollmentInfo.php">Current Enrolment</a></li>
    <li><a href="transcript.php">Transcript</a></li>
    <li><a href="studentinfo.php">Update Info</a></li>
    <li><a href="viewStudentPersonalInfo.php">View Info</a></li> -->
    <!-- <li><a href="form1.php">Update Form 1</a></li>
    <li><a href="viewform1.php">View Form 1</a></li>
    <li><a href="applytograduate.php">Apply to Graduate</a></li> -->


    <!-- <?php

    if (!empty($program_type)) {
      //foreach($course_array as $key=>$value)
      while($row = $program_type->fetch_assoc())
      {
        if($row['program_type'] == 'PhD'){
    ?>

    <li><a href="submitThesisFile.php" >Submit Thesis</a><li>
   <li><a href="<?php echo $url;?>" target="_blank">View Thesis</a><li>
  <?php
    }
   }
  }
              ?> -->
    <!-- <li><a href="http://gwupyterhub.seas.gwu.edu/~lilyrschwarz/SJL/public_html/registration/menu.php">Main Menu</a></li> -->
    <li style="float:right"><a href="logout.php">Logout</a></li>

  </ul><br/></br>
<div class="w3-container">
  <h2>Assign an advisor for a student</h2>

<div class="w3-responsive">
<!-- get student ID from input -->
  <form action="AssignAdvisor.php" method="post">
    <label for="university_id">Student ID:</label>
    <input type="text" name="university_id" required/><br></br>

<!-- get advisor name from dropdown list -->
    <?php
    $result = $conn->query("SELECT name FROM advisor") or die ("cannot retrieve names");

    echo "Advisor";
    echo "<select name='advisor_name'>";

    while ($row = mysqli_fetch_array($result )) {
        	echo "<option value ='" . $row['name'] . "'>" .  $row['name'] . "</option>";
    }
    echo "</select></br>";
    ?>
    <br><input type="submit"/>
  </form>

<?php
// update student/advisor
      $university_id = $_POST['university_id'] ?? '';
      $advisor_name = $_POST['advisor_name'] ?? '';

      $results = $conn->query("SELECT university_id
                               FROM advisor
      		               WHERE name='$advisor_name'");
     // $result_int = mysqli_fetch_assoc($results);
     // var_dump($result_int);

      $row = $results->fetch_assoc();
      $rowtest = $row["university_id"];
      $rowint = (int) $rowtest;
      //var_dump($rowint);

      //update query for student
      $update_advisor = mysqli_query($conn,"UPDATE student
			 SET advisor='$rowint'
                         WHERE university_id=".$university_id);

      if(($update_advisor) === TRUE) {
	      echo "Record updated successfully";

      } //else {
        //      echo "Error updating record: " . $conn->error;
     // }
?>

<!-- table for updated student/advisor feedback-->
<div class="w3-container">
  <h2> Updated Advisor for Student </h2>
  <div class="w3-responsive">
      <table class="w3-table-all">
      <tr>
          <th>Student</th>
          <th>Advisor</th>
      </tr>

      <?php


      //get students name and advisor name and give feedback
      $student_array = $conn->query("SELECT s.f_name, s.l_name, a.name
			       FROM student s, advisor a
			       WHERE s.advisor=a.university_id AND s. university_id=".$university_id);


      if (!empty($student_array)) {
            while($row = $student_array->fetch_assoc())
                {
      ?>

      <tr>
        <td><?php echo $row["f_name"]; ?><?php echo " " . $row["l_name"]; ?></td>
	<td><?php echo $row["name"]; ?></td>
      </tr>

      <?php
                }
      }

      mysqli_close($conn);
      ?>
      </table>
  </div>
</div>
</div>

</body>
</html>
