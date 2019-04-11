<?php
    session_start();
    if($_SESSION['login_user'] && $_SESSION['role'] == 'advisor'){
    }
    else{
      echo $_SESSION['login_user'].$_SESSION['role'];
      header("Location: login.php");
    }
  $servername = "localhost";
  $username = "BLT";
  $password = "Blt1234!";
  $dbname = "BLT";
  $gpa_update_in_student = null;
  $db = new mysqli($servername, $username, $password, $dbname);
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
  <li><a class="active" href="advisor.php">Home</a></li>
  <li><a href="SearchTranscript.php">Search Transcript</a></li>
  <li><a href="SearchForm1.php">Review Form1</a></li>
  <li><a href="viewThesisFile.php">View Thesis</a></li>  
  <li><a href="logout.php">Logout</a></li>
</ul><br/><br/>

<!-- First Grid -->
<div class="w3-row">
  <div class=" w3-container w3-center" >
    <div class="w3-padding-64">
        <h1>Search for Transcript</h1>
    </div>

    <div class="w3-padding-64">
      <a href="SearchStudentTranscript.php" class="w3-button  w3-block w3-hover-dark-grey w3-padding-16">Access student transcript</a>
      <a href="SearchAlumTranscript.php" class="w3-button  w3-block w3-hover-blue-grey w3-padding-16">Access alumni transcript</a>
      <a href="logout.php" class="w3-button w3-block  w3-hover-red w3-padding-16">Logout</a>
    </div>

  </div>
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-16">
  <p><a href="https://www.w3schools.com/w3css/default.asp" target="_blank"></a></p>
</footer>

</body>
</html>
