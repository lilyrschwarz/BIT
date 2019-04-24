<?php
session_start();
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
$db = new mysqli($servername, $username, $password, $dbname);


//  $query = mysql_query("SELECT subject, course_num, year, semester, credits, final_grade FROM transcript");
?>
<!DOCTYPE html>
<html>
<head>
<title>View Info</title>
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
</ul><br/></br>
  <div class="w3-container">
  <h2>View Form 1</h2>

<!-- Enter university id of student -->
  <div class="w3-responsive">
     <form method="post">
    	<?php
  	$result = $db->query("SELECT f_name, l_name,university_id FROM student WHERE advisor =".$_SESSION['login_user']) or die ("cannot retrieve names");
  	echo "Advisee: ";
    	echo "<select name='student_id'>";
	while ($row = mysqli_fetch_array($result )) {
        	echo "<option value =' ".$row['university_id']."'>" .$row['f_name']." ".$row['l_name']. "</option>";
	}
    	echo "</select>";
    	?>
        <input type="submit"/>
     </form>
<?php
  $student_id = $_POST['student_id'];
  $student_name = $db->query("SELECT f_name, l_name FROM student WHERE university_id=".$student_id);
  $row = mysqli_fetch_array($student_name);
  $fullname = $row['f_name']." ".$row['l_name'];
  echo "<br/>";
  echo $fullname;
  echo "<br/>";
?>

<!-- display form1 info -->
  <table class="w3-table-all">
  <tr>
    <th>Subject</th>
    <th>Course Number</th>
  </tr>

  <?php
    //if($db->connect_error){echo "db connect error";}
    $course_array = $db->query("SELECT subject, course_num FROM form1 where university_id =".$student_id);
    //echo $_SESSION['username'];
    if (!empty($course_array)) {
      //foreach($course_array as $key=>$value)
      while($row = $course_array->fetch_assoc())
      {
    ?>
  <tr>
    <td><?php echo $row["subject"]; ?></td>
    <td><?php echo $row["course_num"]; ?></td>
  </tr>

  <?php
                 }
  }
              ?>
  </table>
  </div>

  </div>
</body>
</html>
