<?php
session_start();

if($_SESSION['uid'] && ($_SESSION['type'] == 'secr' )){
 //echo $_SESSION['uid'];
}
else{
    echo $_SESSION['uid'].$_SESSION['type'];
    header("Location: http://gwupyterhub.seas.gwu.edu/~selingonal/SJL/public_html/registration/menu.php");
}

$servername = "localhost";
$username = "SJL";
$password = "SJLoss1!";
$dbname = "SJL";


$update=null;
$studentsql=null;
$advisorsql=null;
$student_id= $_SESSION['studentid'];
//echo $student_id;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>

<!DOCTYPE html>

<html>

<title>Graduating Student</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

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


<?php
	//add student as an alum
	$insertAlum = $conn->query("INSERT INTO alumni (university_id, f_name, l_name, address, email, phone_num, program_type, advisor)
				   SELECT university_id, f_name, l_name, address, email, phone_num, program_type, advisor
				   FROM student
				   WHERE university_id=".$student_id);

	//update graduation year and semester for alum
	$gradYear = $conn->query("UPDATE alumni
				  SET grad_year='2019', grad_semester='spring'
				  WHERE university_id=".$student_id);

        //update user table for student->alum
        $alumUser = $conn->query("UPDATE users
                                  SET user_type='alumni'
                                  WHERE university_id=".$student_id);

	//delete student from student table
	$deleteStudent = $conn->query("DELETE FROM student
				       WHERE university_id=".$student_id);



	if($insertAlum === TRUE) {
		echo "<h1>Student successfully graduated</h1>";
		echo "<h2>Student has been transitioned to alumni</h2>";
	} else {
		echo "error";
	}
?>


</div>
</body>
</html>
