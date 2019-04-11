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
</ul><br/></br>
<!--below is the name and advisor and program type, this is a different div-->

  <div class="w3-container">
  <h2> Student Transcript </h2>
  <div class="w3-responsive">
<!--
  <form method="post">
       <label for="university_id">University ID of Student:</label>
       <input type="text" name="university_id" required/><br/>
       <input type="submit" value="Submit"/>
  </form>
-->
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

  <table class="w3-table-all">
  <tr>
    <th>Name</th>
    <th>Program Type</th>
    <th>Advisor</th>
  </tr>

<?php
  if($db->connect_error){echo "db connect error";}
  $student_id = $_POST['student_id'] ?? '';
  
  $info_array = $db->query("SELECT f_name, l_name, program_type, advisor.name as aname 
			    FROM student, advisor
			    WHERE advisor = advisor.university_id and student.university_id =".$student_id);
 
    if (!empty($info_array)) {
    	//foreach($course_array as $key=>$value)
      while($row = $info_array->fetch_assoc())
      {
    ?>
  <tr>
    <td><?php echo $row["f_name"]; ?> <?php echo " ". $row["l_name"]; ?></td>
    <td><?php echo $row["program_type"]; ?></td>
    <td><?php echo $row['aname']; ?></td>
  </tr>

  <?php
                 }
  }
?>
  </table>
  
<table class="w3-table-all">
<tr>
  <th>Course</th>
  <th>Year</th>
  <th>Semester</th>
  <th>Credit Hours</th>
  <th>Grade</th>
</tr>

<?php
  if($db->connect_error){echo "db connect error";}
  $course_array = $db->query("SELECT subject, course_num, year, semester, credits, final_grade 
	  		      FROM transcript 
			      WHERE not(semester = 'spring' and year = '2019') and university_id =".  $student_id.";");
 
  $sum = 0;
  $credits_sum = $db->query("SELECT sum(credits) as sum_of_credits 
	  		     FROM transcript 
			     WHERE not(semester = 'spring' and year = '2019') and university_id =".  $student_id);
  $credits_sum = $credits_sum->fetch_assoc();
  $credits_sum = $credits_sum['sum_of_credits'];
  

  if (!empty($course_array)) {
  	//foreach($course_array as $key=>$value)
    while($row = $course_array->fetch_assoc())
    {
      
      if($row['final_grade'] == 'A'){
        $sum += (4.0 * $row['credits']);
      }
      if($row['final_grade'] == 'A-'){
        $sum += (3.7 * $row['credits']);
      }
      if($row['final_grade'] == 'B+'){
        $sum += (3.3 * $row['credits']);
      }
      if($row['final_grade'] == 'B'){
        $sum += (3.0 * $row['credits']);
      }
      if($row['final_grade'] == 'B-'){
        $sum += (2.7* $row['credits']);
      }
      if($row['final_grade'] == 'C+'){
        $sum += (2.3 * $row['credits']);
      }
      if($row['final_grade'] == 'C'){
        $sum += (2.0 * $row['credits']);
      }
      if($row['final_grade'] == 'C-'){
        $sum += (1.7 * $row['credits']);
      }
      if($row['final_grade'] == 'D'){
        $sum += (1.0 * $row['credits']);
      }
      if($row['final_grade'] == 'F'){
        $sum += (0 * $row['credits']);
      }

      $GPA = $sum/$credits_sum;
      mysqli_query($conn,"update student set GPA = '$GPA' where university_id =". $university_id);
      
?>
<tr>
  <td><?php echo $row["subject"]; ?><?php echo $row["course_num"]; ?></td>
  <td><?php echo $row["year"]; ?></td>
  <td><?php echo $row['semester']; ?></td>
  <td><?php echo $row['credits']; ?></td>
  <td><?php echo $row['final_grade']; ?></td>
</tr>

<?php
}
}
            ?>
<!-- print GPA and total credits -->
<tr>
  <th>GPA</th>
  <th>Total Credits</th>
</tr>

<tr>
  <td><?php echo $GPA; ?></td>
  <td><?php echo $credits_sum;?></td>
</tr>

</table>
</div>

</div>

</body>
</html>
