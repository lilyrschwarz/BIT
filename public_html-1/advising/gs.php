<?php
/*** LOGIN FUNCTIONALITY BELOW****/
session_start();

if($_SESSION['uid'] && ($_SESSION['type'] == 'secr' )){
 //echo $_SESSION['uid'];
}
else{
    echo $_SESSION['uid'].$_SESSION['type'];
    header("Location: http://gwupyterhub.seas.gwu.edu/~selingonal/SJL/public_html/registration/menu.php");
}
/*** LOGIN FUNCTIONALITY ABOVE****/
  ?>

<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<head>
<meta charset="UTF-8">
<meta name="viewport">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>


</head>

<body>


<!-- First Grid -->
<div class="w3-row">
  <div class=" w3-container w3-center" >
    <div class="w3-padding-64">
        <h1>Graduate Secretary</h1>
    </div>

    <div class="w3-padding-64">
      <a href="AssignAdvisor.php" class="w3-button w3-block w3-hover-dark-grey w3-padding-16">Assign an advisor to a student</a>
      <a href="SearchStudentData.php" class="w3-button w3-block w3-hover-blue-grey w3-padding-16">Access a student's data</a>
            <a href="SearchStudentTranscriptGS.php" class="w3-button w3-block w3-hover-blue-grey w3-padding-16">View transcripts</a>
      <a href="SearchStudentRequirements.php" class="w3-button  w3-block w3-hover-dark-grey w3-padding-16">Graduate a student</a>
      <a href="logout.php" class="w3-button w3-block w3-hover-red w3-padding-16">Logout</a>
    </div>

  </div>
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-16">
  <p><a href="https://www.w3schools.com/w3css/default.asp" target="_blank"></a></p>
</footer>

</body>
</html>
