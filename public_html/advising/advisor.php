<?php
session_start();

//connect to database
$servername = "localhost";
$username = "SJL";
$password = "SJLoss1!";
$dbname = "SJL";
$connection = mysqli_connect($servername, $username, $password, $dbname);

//If they somehow got here without logging in, politely send them away
    if($_SESSION['login_user'] && $_SESSION['role'] == 'advisor'){
    }
    else{
      echo $_SESSION['login_user'].$_SESSION['role'];
      header("Location: login.php");
    }
  ?>

<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<head>
<meta charset="UTF-8">
<meta name="viewport">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>

<body>

<!-- First Grid -->
<div class="w3-row">
  <div class=" w3-container w3-center" >
    <div class="w3-padding-64">
        <h1>Advisor</h1>
    </div>

    <div class="w3-padding-64">
      <a href="SearchForm1.php" class="w3-button  w3-block w3-hover-blue-grey w3-padding-16">Review a student's form1</a>
      <a href="viewThesisFile.php" class="w3-button w3-block w3-hover-dark-grey w3-padding-16">Review a PhD student's thesis</a>
      <a href="SearchTranscript.php" class="w3-button w3-block w3-hover-blue-grey w3-padding-16">View a transcript</a>
      <a href="logout.php" class="w3-button w3-block w3-hover-red w3-padding-16">Logout</a>
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
