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



    $program_type = $db->query("SELECT program_type from student where university_id =".$_SESSION['login_user']);
    $thesis_url = $db->query("SELECT FileName, FilePath from thesis where university_id =".$_SESSION['login_user']);
    while ($row2 = mysqli_fetch_array($thesis_url )) {
	$url = $row2['FilePath'].$row2['FileName'];
	//var_dump($url);
    }
?>

<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body class="w3-content">

<!-- First Grid -->
<div class="w3-row">
  <div class="  w3-container w3-center" >
    <div class="w3-padding-64">
      <h1>Graduate Students</h1>
    </div>
    <div class="w3-padding-64">
      <a href="StudentEnrollmentInfo.php" class="w3-button  w3-block w3-hover-blue-grey w3-padding-16">Current Enrollment</a>
      <a href="transcript.php" class="w3-button  w3-block w3-hover-blue-grey w3-padding-16">View Transcript</a>
      <a href="studentinfo.php" class="w3-button  w3-block w3-hover-dark-grey w3-padding-16">Update Personal Information</a>
      <a href="viewStudentPersonalInfo.php" class="w3-button  w3-block w3-hover-dark-grey w3-padding-16">View Personal Information</a>
      <a href="form1.php" class="w3-button  w3-block w3-hover-teal w3-padding-16">Update Form 1</a>
      <a href="viewform1.php" class="w3-button  w3-block w3-hover-teal w3-padding-16">View Form 1</a>
      <a href="applytograduate.php" class="w3-button  w3-block w3-hover-dark-grey w3-padding-16">Apply to Graduate</a>

  <?php

      if (!empty($program_type)) {
      	//foreach($course_array as $key=>$value)
        while($row = $program_type->fetch_assoc())  {
          	if($row['program_type'] == 'PhD'){
  ?>

         	 <a href="submitThesisFile.php" class="w3-button  w3-block w3-hover-red w3-padding-16">Submit a Thesis</a>

		 <a href="<?php echo $url;?>" target='_blank' class='w3-button w3-block w3-hover-red w3-padding-16'>View Thesis Submission</a>

<?php
		}
        }
     }
?>

      <a href="logout.php" class="w3-button  w3-block w3-hover-red w3-padding-16">Logout</a>


    </div>
  </div>

  </div>
</div>
<!-- Footer -->
<footer class="w3-container  w3-padding-16">
  <p><a href="https://www.w3schools.com/w3css/default.asp" target="_blank"></a></p>
</footer>

</body>
</html>
