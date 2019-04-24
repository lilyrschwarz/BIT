<?php
session_start();

$servername = "localhost";
$username = "SJL";
$password = "SJLoss1!";
$dbname = "SJL";
$db = new mysqli($servername, $username, $password, $dbname);

//If they somehow got here without logging in, politely send them away
if(!$_SESSION['loggedin']) {
    header("Location: login.php");
    die();
}

  $program_type = $db->query("SELECT program_type from student where university_id =".$_SESSION['login_user']);

  ?>

<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<head>
<meta charset="UTF-8">
<meta name="viewport">
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

  <li><a href="submitthesis.php" >Submit Thesis</a><li>
  <li><a href="viewthesissubmission.php">View Thesis</a><li>
<?php
  }
 }
}
            ?>
  <li><a href="logout.php">Logout</a></li>
</ul><br/></br>

<div align="center" class="w3-container">
<h1> Thesis </h1>
<div class="w3-responsive">

<?php
        $student_id = $_SESSION['login_user'];
        $studentThesis = $db->query("SELECT thesis
                                     FROM student
                                     WHERE university_id=".$student_id);
//	var_dump($studentThesis);
	$row = mysqli_fetch_array($studentThesis);
        $studentName = $row['f_name']." ".$row['l_name'];
        if(is_null($row['thesis'])) {
            echo "Student has not submitted a thesis.";

	    //updates student thesis requirement to 0, unable to graduate
            $updateThesis = $db->query("UPDATE student
                                        SET thesis_approved = 0
                                        WHERE university_id=".$studient_id);
        }
        else {
            echo "<br/><br>";
            echo $row['thesis'];
            echo "<br/><br/>";
	}
?>


</div>
</div>

</body>
</html>
