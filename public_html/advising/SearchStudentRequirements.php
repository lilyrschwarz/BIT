<?php
session_start();
if($_SESSION['login_user'] && $_SESSION['role'] == 'graduate_secretary'){
}
else{
  echo $_SESSION['login_user'].$_SESSION['role'];
  header("Location: login.php");
}

$servername = "localhost";
$username = "SJL";
$password = "SJLoss1!";
$dbname = "SJL";


$studentsql = null;

//create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

?>

<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<head>
<meta name="viewport" content="width=device_width, initial-scale=1">
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
  <li><a class="active" href="gs.php">Home</a></li>
  <li><a href="SearchStudentData.php">Search Student Information</a></li>
  <li><a href="SearchStudentTranscriptGS.php">Search Student Transcript</a></li>
  <li><a href="AssignAdvisor.php">Assign Advisor to Student</a></li>
  <li><a href="SearchStudentRequirements.php">Graduate a Student</a></li>
  <li><a href="logout.php">Logout</a></li>
  </ul><br/></br>

<div class="w3-container">
  <h1> Graduate a Student </h1>
    <div class="w3-responsive">

    <form method="post">
	<label for"student_id">University ID of Student:</label>
	<input type="text" name="student_id" required/><br/>
	<input type="submit" value="Submit">
    </form>

<!-- check to see if a student has met requirements -->
<?php
$student_id = $_POST['student_id'] ?? '';
$_SESSION['studentid'] = $student_id;

$requirementcheck = $conn->query("SELECT clear_for_grad
       				  FROM student
				  WHERE university_id=".$student_id);

$row = $requirementcheck->fetch_assoc();
$reqcheck = $row["clear_for_grad"];
//echo $reqcheck;

if($reqcheck==1) {
	echo "Student has met requirements";

?>
    <form action="studentGraduate.php" method="post">
	<input type="submit" name="graduate" value="GRADUATE"/>
    </form>

<?php
} else {
	echo "Student has not met requirements";
	$graduate = 'no';
}
?>

    </div>
</div>

</body>
</html>
