<?php


    session_start();
    if($_SESSION['login_user'] && $_SESSION['role'] == 'student'){

    }
    else{
      echo $_SESSION['login_user'].$_SESSION['role'];
      header("Location: login.php");
    }



  $servername = "localhost";
  $username = "BLT";
  $password = "Blt1234!";
  $dbname = "BLT";
  $db = new mysqli($servername, $username, $password, $dbname);

  $credits_sum = $db->query("SELECT sum(credits) as sum_of_credits from courses, form1 where form1.course_num=courses.course_num and university_id =".$_SESSION['login_user']);
  $credits_sum = $credits_sum->fetch_assoc();
  $credits_sum = $credits_sum['sum_of_credits'];

  $program_type = $db->query("SELECT program_type from student where university_id =".$_SESSION['login_user']);

  $thesis_url = $db->query("SELECT FileName, FilePath from thesis where university_id =".$_SESSION['login_user']);
  while ($row2 = mysqli_fetch_array($thesis_url )) {
	$url = $row2['FilePath'].$row2['FileName'];
	var_dump($url);
  }


//  $query = mysql_query("SELECT subject, course_num, year, semester, credits, final_grade FROM transcript");
?>
<!DOCTYPE html>
<html>
<head>
<title>View Info</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
font-family: sans-serif;

}

li a:hover:not(.active) {
background-color: #111;
}

.active {
background-color: #4CAF50;
}
</style>
</head>
<body>
  <ul>
  <li><a class="active" href="student.php">Home</a></li>
  <li><a href="StudentEnrollmentInfo.php">Current Enrolment</a></li>
  <li><a href="transcript.php">Transcript</a></li>
  <li><a href="studentinfo.php">Update Info</a></li>
  <li><a href="viewStudentPersonalInfo.php">View Info</a></li>
  <li><a href="form1.php">Update Form 1</a></li>
  <li><a href="viewform1.php">View Form 1</a></li>
  <li><a href="applytograduate.php">Apply to Graduate</a></li>


  <?php

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
            ?>
  <li><a href="logout.php">Logout</a></li>
</ul><br/></br>

  <div class="w3-container">
  <h2>View Form 1</h2>
  <?php
  if($credits_sum<30){
    echo "<b>ERROR: You need at least 30 credits to graduate.</b></br>";
  }
   ?>
  <div class="w3-responsive">
  <table class="w3-table-all">
  <tr>
    <th>Subject</th>
    <th>Course Number</th>
  </tr>

  <?php
    //if($db->connect_error){echo "db connect error";}

    $course_array = $db->query("SELECT subject, course_num FROM form1 where university_id =".  $_SESSION['login_user']);
    //echo $_SESSION['username'];

    if (!empty($course_array)) {
      //foreach($course_array as $key=>$value)
      while($row = $course_array->fetch_assoc())
      {
    ?>
  <tr>
    <td><?php echo $row["subject"]; ?></td>
    <td><?php echo $row["course_num"]; ?></td>
  </tr>

  <?php
                 }
  }
              ?>
  </table>
  </div>

  </div>

</body>
</html>
