<?php
session_start();

if($_SESSION['uid'] && $_SESSION['type'] == 'MS' || $_SESSION['type'] == 'PHD'){

}
else{
    echo $_SESSION['uid'].$_SESSION['type'];
    header("Location: http://gwupyterhub.seas.gwu.edu/~selingonal/SJL/public_html/registration/menu.php");
}


if($_POST['applytograduate'] || $_SESSION['type'] == 'MS'){
    header("Location: audit_masters.php");
}

if($_POST['phd']){
    header("Location: audit_phd.php");
}
// if($_POST['phd']){
//     header("Location: audit_phd.php");
// }


    //connect to database
    $servername = "localhost";
    $username = "SJL";
    $password = "SJLoss1!";
    $dbname = "SJL";
    $db = new mysqli($servername, $username, $password, $dbname);



    $program_type = $db->query("SELECT program_type from student where university_id =".$_SESSION['uid']);

    $thesis_url = $db->query("SELECT FileName, FilePath from thesis where university_id =".$_SESSION['uid']);
    while ($row2 = mysqli_fetch_array($thesis_url )) {
    $url = $row2['FilePath'].$row2['FileName'];
  //  var_dump($url);
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<!--  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="style.css" />-->
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
    <li><a class="active" href="student.php">Advising Home</a></li>
    <!-- <li><a href="StudentEnrollmentInfo.php">Current Enrolment</a></li>
    <li><a href="transcript.php">Transcript</a></li>
    <li><a href="studentinfo.php">Update Info</a></li>
    <li><a href="viewStudentPersonalInfo.php">View Info</a></li> -->
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
            <li><a href="http://gwupyterhub.seas.gwu.edu/~lilyrschwarz/SJL/public_html/registration/menu.php">Main Menu</a></li>
            <li><a href="logout.php">Logout</a></li></ul><br/></br>
</ul><br/></br>
<div align="center">
  <h2>Apply to Graduate</h2>
    <form method = "POST">
        <p> Select your degree program.</p>
        <input type = "submit" value = "Masters" name = "masters">
        <input type = "submit" value = "PhD" name = "phd">
    </form>
  </div>
</body>
</html>
