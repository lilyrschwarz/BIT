<?php
	
  session_start(); 
  
  // connect to mysql
  $conn = mysqli_connect("localhost", "SJL", "SJLoss1!", "SJL");
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

   //update status for all instances of applicant
  $sql = "UPDATE app_review SET status = 10 WHERE uid = " .$_SESSION['id']. "";
  $result = mysqli_query($conn, $sql) or die ("************* UPDATE ALL STATUS'S SQL FAILED************");

  header("Location:home.php"); 
      exit;

?>