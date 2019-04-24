<?php

    if($_SESSION['uid'] && $_SESSION['type'] == 'inst'){
    }
    else{
      echo $_SESSION['uid'].$_SESSION['type'];
      header("Location: http://gwupyterhub.seas.gwu.edu/~selingonal/SJL/public_html/registration/menu.php");
    }

$servername = "localhost";
$username = "SJL";
$password = "SJLoss1!";
$dbname = "SJL";


  $db = mysqli_connect($servername, $username, $password, $dbname);
  if (!$db) {
          die("connection failed" . mysqli_connect_error());
  }

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
  <li><a href="viewThesisFile.php">View Thesis</a></li>  <li><a href="logout.php">Logout</a></li>
</ul><br/><br/>


<div class="w3-container">
<h1> THESIS </h1>

<div class="w3-responsive">

<form method="post">
        <?php
  $result = $db->query("SELECT f_name, l_name,university_id
	  		FROM student
			WHERE program_type = 'PhD' AND advisor =".$_SESSION['login_user']) or die ("cannot retrieve names");
        echo "Advisee: ";
        echo "<select name='student_id'>";
        while ($row = mysqli_fetch_array($result )) {
                echo "<option value =' ".$row['university_id']."'>" .$row['f_name']." ".$row['l_name']. "</option>";
        }
        echo "</select>";
        ?>
        <br><br><input type="submit" name="submit" value="Submit">
</form>

<?php

  $student_id = $_POST['student_id'];
  $_SESSION['student_id'] = $student_id;
  //see if student submitted thesis
  $studentThesis = mysqli_query($db,"SELECT FilePath, FileName FROM thesis where university_id=".$student_id);
  $row = mysqli_fetch_array($studentThesis);

  //var_dump($studentThesis);

  if(isset($_POST['submit'])) {
     if(is_null($row['FileName'])) {
	   echo "Student has not submitted a thesis.";

	   //updates student thesis requirement to 0, unable to graduate
           $updateThesis = $db->query("UPDATE student
                                       SET thesis_approved = 0
                                       WHERE university_id=".$student_id);
     }
     else {

	//opens thesis in another window
	$findFile = mysqli_query($db, "SELECT FilePath, FileName FROM thesis where university_id=".$student_id);
 	while($row = mysqli_fetch_assoc($findFile)) {
             $url = $row['FilePath'].$row['FileName'];
             echo "<script>window.open('$url', '_blank');</script>";
	}

	//allows advisor to approve thesis
	echo "<form action='ThesisApproved.php' method='post'>
                 <input type='submit' name='approve' value='APPROVE'/>
              </form>";

     }
  }
?>
</div>
</div>
</body>
</html>
