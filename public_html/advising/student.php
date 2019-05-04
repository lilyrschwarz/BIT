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



    $program_type = $db->query("SELECT program_type from student where university_id =".$_SESSION['uid']);
    $thesis_url = $db->query("SELECT FileName, FilePath from thesis where university_id =".$_SESSION['uid']);
    while ($row2 = mysqli_fetch_array($thesis_url )) {
	$url = $row2['FilePath'].$row2['FileName'];
	//var_dump($url);
echo "Sdfasdf";
  echo $program_type;
    }
?>

<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport">
<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
<link rel = "stylesheet" type="text/css" href="style.css"/>
<style>
    input[type=submit] {
        background-color: #990000;
        border: none;
        color: white;
        padding: 16px 32px;
        text-decoration: none;
        margin: 4px 2px;
        width: 70%;
    }
    input[type=submit]:hover {
        background-color: #990000;
        border: none;
        color: white;
        padding: 16px 32px;
        text-decoration: none;
        margin: 4px 2px;
        cursor: pointer;
        width: 80%;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }
</style>
</head>

<body class="gray-bg">
<!-- <body class="w3-content"> -->

<!-- First Grid -->
<!-- <div class="w3-row"> -->
  <!-- <div class="  w3-container w3-center" >
    <div class="w3-padding-64"> -->
<div style="text-align: center"><div style=display: inline-block; width: 80%>
      <h1>Graduate Student Advising</h1>

    <!-- <div class="w3-padding-64"> -->
      <!-- <a href="StudentEnrollmentInfo.php" class="w3-button  w3-block w3-hover-blue-grey w3-padding-16">Current Enrollment</a> -->
      <!-- <a href="http://gwupyterhub.seas.gwu.edu/~lilyrschwarz/SJL/public_html/registration/edit-info-reg.php" class="w3-button  w3-block w3-hover-dark-grey w3-padding-16">Update Personal Information</a> -->

    <!-- <a href="viewStudentPersonalInfo.php" class="w3-button  w3-block w3-hover-dark-grey w3-padding-16">View Personal Information</a> -->
<div>
  <form action="form1.php">
    <input type="submit" value="Update Form 1">
  </form
</div>
<div>
  <form action="viewform1.php">
    <input type="submit" value="View Form 1">
  </form
</div>
<div>
  <form action="applytograduate.php">
    <input type="submit" value="Apply to Graduate">
  </form
</div>

      <!-- <a href="form1.php" class="w3-button  w3-block w3-hover-teal w3-padding-16">Update Form 1</a>
      <a href="viewform1.php" class="w3-button  w3-block w3-hover-teal w3-padding-16">View Form 1</a>
      <a href="applytograduate.php" class="w3-button  w3-block w3-hover-dark-grey w3-padding-16">Apply to Graduate</a> -->

  <?php


      if (!empty($program_type)) {
      	//foreach($course_array as $key=>$value)
        while($row = $program_type->fetch_assoc())  {
          	if($row['program_type'] == 'PhD'){
  ?>
  <div>
    <form action="submitThesisFile.php">
      <input type="submit" value="Submit a Thesis">
    </form
</div>
<div>
    <form action="<?php echo $url;?>">
      <input type="submit" value="View Thesis Submission">
    </form
  </div>


<?php
		}
        }
     }
?>

<div>
  <form action="http://gwupyterhub.seas.gwu.edu/~lilyrschwarz/SJL/public_html/registration/menu.php">
    <input type="submit" value="Main Menu">
  </form
</div>
<div>
  <form action="logout.php">
    <input type="submit" value="Logout">
  </form
</div>

      <!-- <a href="http://gwupyterhub.seas.gwu.edu/~lilyrschwarz/SJL/public_html/registration/menu.php" class="w3-button  w3-block w3-hover-dark-grey w3-padding-16">Main Menu</a>
      <a href="logout.php" class="w3-button  w3-block w3-hover-red w3-padding-16">Logout</a>
 -->


    <!-- </div> -->
  </div>

  </div>
</div>
<!-- Footer -->
<footer class="w3-container  w3-padding-16">
  <p><a href="https://www.w3schools.com/w3css/default.asp" target="_blank"></a></p>
</footer>

</body>
</html>
