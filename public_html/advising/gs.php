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
<title>Secretary</title>
<head>
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
<meta charset="UTF-8">
<meta name="viewport">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>


</head>
<body class="gray-bg">

<!-- First Grid -->
<!-- <div class="w3-row">
  <div class=" w3-container w3-center" >
    <div class="w3-padding-64"> -->
    <div style="text-align: center"><div style=display: inline-block; width: 80%>

        <h1>Graduate Secretary Advising</h1>
    </div>

    <div>
      <form action="AssignAdvisor.php">
        <input type="submit" value="Assign Advisor to Student">
      </form
    </div>
    <div>
      <form action="SearchStudentRequirements.php">
        <input type="submit" value="Graduate a Student">
      </form
    </div>

    <div>
      <form action="SearchAlumniInfo.php">
        <input type="submit" value="View Alumni">
      </form
    </div>

    <div>
      <form action="AboutToGraduate.php">
        <input type="submit" value="Students About to Graduate">
      </form
    </div>

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


    <!-- <div class="w3-padding-64">
      <a href="AssignAdvisor.php" class="w3-button w3-block w3-hover-dark-grey w3-padding-16">Assign an advisor to a student</a>
      <!-- <a href="SearchStudentData.php" class="w3-button w3-block w3-hover-blue-grey w3-padding-16">Access a student's data</a> -->
            <!-- <a href="SearchStudentTranscriptGS.php" class="w3-button w3-block w3-hover-blue-grey w3-padding-16">View transcripts</a> -->
      <!-- <a href="SearchStudentRequirements.php" class="w3-button  w3-block w3-hover-dark-grey w3-padding-16">Graduate a student</a>
      <a href="logout.php" class="w3-button w3-block w3-hover-red w3-padding-16">Logout</a>
    </div> -->

  </div>
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-16">
  <p><a href="https://www.w3schools.com/w3css/default.asp" target="_blank"></a></p>
</footer>

</body>
</html>
