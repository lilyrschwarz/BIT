<?php
session_start();

if($_SESSION['uid'] && ($_SESSION['type'] == 'secr' )){
 //echo $_SESSION['uid'];
}
else{
    echo $_SESSION['uid'].$_SESSION['type'];
    header("Location: http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/registration/menu.php");
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
<title>Graduate</title>
<head>
<meta name="viewport" content="width=device_width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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

if($reqcheck==1 ) {
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
