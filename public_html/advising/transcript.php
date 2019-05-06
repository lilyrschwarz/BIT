<?php

session_start();

if($_SESSION['uid'] && $_SESSION['type'] == 'MS' || $_SESSION['type'] == 'PHD'){

}
else{
    echo $_SESSION['uid'].$_SESSION['type'];
    header("Location: http://gwupyterhub.seas.gwu.edu/~selingonal/SJL/public_html/registration/menu.php");
}


$servername = "localhost";
$username = "SJL";
$password = "SJLoss1!";
$dbname = "SJL";
$db = new mysqli($servername, $username, $password, $dbname);



$student_id = $_SESSION['login_user'];


  $gpa_update_in_student = null;
  $db = new mysqli($servername, $username, $password, $dbname);

  $program_type = $db->query("SELECT program_type from student where university_id =".$_SESSION['login_user']);

  $thesis_url = $db->query("SELECT FileName, FilePath from thesis where university_id =".$_SESSION['login_user']);
  while ($row2 = mysqli_fetch_array($thesis_url )) {
	$url = $row2['FilePath'].$row2['FileName'];
	//var_dump($url);
  }

//  $query = mysql_query("SELECT subject, course_num, year, semester, credits, final_grade FROM transcript");
?>
<!DOCTYPE html>
<html>
<title>Transcript</title>
<head>
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
<!--below is the name and advisor and program type, this is a different div-->

  <div class="w3-container">
  <div class="w3-responsive">
  <table class="w3-table-all">
  <tr>
    <th>Name</th>
    <th>Program Type</th>
    <th>Advisor</th>

  </tr>

  <?php
    if($db->connect_error){echo "db connect error";}

    $info_array = $db->query("SELECT f_name, l_name, program_type, advisor.name as aname FROM student, advisor where advisor = advisor.university_id and student.university_id =".  $_SESSION['login_user']);
    //echo $_SESSION['username'];



    if (!empty($info_array)) {
    	//foreach($course_array as $key=>$value)
      while($row = $info_array->fetch_assoc())
      {
    ?>
  <tr>
    <td><?php echo $row["f_name"]; ?> <?php echo $row["l_name"]; ?></td>
    <td><?php echo $row["program_type"]; ?></td>
    <td><?php echo $row['aname']; ?></td>

  </tr>

  <?php
                 }
  }
              ?>
  </table>
  </div>

  </div>

<div class="w3-container">
  <h2>Transcript</h2>
<div class="w3-responsive">
<table class="w3-table-all">
<tr>
  <th>Course</th>
  <th>Year</th>
  <th>Semester</th>
  <th>Credit Hours</th>
  <th>Grade</th>
</tr>

<?php
  if($db->connect_error){echo "db connect error";}

  $course_array = $db->query("SELECT subject, course_num, year, semester, credits, final_grade FROM transcript where not(semester = 'spring' and year = '2019') and university_id =".  $_SESSION['login_user']);

  $sum = 0;
  $credits_sum = $db->query("SELECT sum(credits) as sum_of_credits from transcript where not(semester = 'spring' and year = '2019') and university_id =".  $_SESSION['login_user']);
  $credits_sum = $credits_sum->fetch_assoc();
  $credits_sum = $credits_sum['sum_of_credits'];

  if (!empty($course_array)) {
  	//foreach($course_array as $key=>$value)
    while($row = $course_array->fetch_assoc())
    {
      if($row['final_grade'] == 'A'){
        $sum += (4.0 * $row['credits']);
      }
      if($row['final_grade'] == 'A-'){
        $sum += (3.7 * $row['credits']);
      }
      if($row['final_grade'] == 'B+'){
        $sum += (3.3 * $row['credits']);
      }
      if($row['final_grade'] == 'B'){
        $sum += (3.0 * $row['credits']);
      }
      if($row['final_grade'] == 'B-'){
        $sum += (2.7* $row['credits']);

      }
      if($row['final_grade'] == 'C+'){
        $sum += (2.3 * $row['credits']);
      }
      if($row['final_grade'] == 'C'){
        $sum += (2.0 * $row['credits']);
      }
      if($row['final_grade'] == 'C-'){
        $sum += (1.7 * $row['credits']);
      }
      if($row['final_grade'] == 'D'){
        $sum += (1.0 * $row['credits']);
      }
      if($row['final_grade'] == 'F'){
        $sum += (0 * $row['credits']);
      }

    //  echo $credits_sum;
    //  echo $sum;
      $GPA = $sum/$credits_sum;
      $sumCredits = (int) $credits_sum;
      $gpa_update = mysqli_query($db,"UPDATE student
	      				SET GPA = '$GPA'
				       	WHERE university_id =". $_SESSION['login_user']);
      $total_credits = mysqli_query($db,"UPDATE student
	     				   SET total_credits = '$sumCredits'
					   WHERE university_id =". $_SESSION['login_user']);
      //  var_dump($credits_sum);

  ?>
<tr>
  <td><?php echo $row["subject"]; ?> <?php echo $row["course_num"]; ?></td>
  <td><?php echo $row["year"]; ?></td>
  <td><?php echo $row['semester']; ?></td>
  <td><?php echo $row['credits']; ?></td>
  <td><?php echo $row['final_grade']; ?></td>
</tr>



<?php
    }

  }

?>
<tr>
  <td><?php echo "GPA: ". $GPA;
 ?></td>
  <td><?php  echo "Total Credits Completed: ". $credits_sum;
 ?></td>
</tr>
</table>

<?php
/* echo $gpa;
       $gpa_update = mysqli_query($conn,"UPDATE student set GPA ='$GPA' where university_id=".$student_id);
        $credits_update = mysqli_query($conn,"UPDATE student set total_credits ='$credits_sum' where university_id =".$student_id);
  $assoc = $gpa_update->fetch_assoc();
  var_dump($assoc);
*/
?>

</div>

</div>

</body>
</html>
