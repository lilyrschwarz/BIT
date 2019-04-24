
<?php
session_start();

$servername = "localhost";
$username = "SJL";
$password = "SJLoss1!";
$dbname = "SJL";
$db = new mysqli($servername, $username, $password, $dbname);

//If they somehow got here without logging in, politely send them away
if(!$_SESSION['loggedin']) {
    header("Location: login.php");
    die();
}
  $student_id = $_SESSION['studuid'];
?>

<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<head>
<meta charset="UTF-8">
<meta name="viewport">
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

<h1> THESIS APPROVED </h1>

<?php

  $updateThesis = $db->query("UPDATE student
	    		      SET thesis_approved = 1
                              WHERE university_id=".$student_id);
  echo "yes."

?>

</body>
</html>
